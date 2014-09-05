 <?php

 
  ?>
<?php
$tupackaging = list_allowed_values(field_info_field('field_tu_packaging'));
$packaging_field = field_info_field('field_tu_packaging');
$packaging_instance = field_info_instance('node', 'field_tu_packaging', 'trading_unit');
$shop = array();
if(isset($_SESSION['regionselect']['zip'])) {
    $shops = rm_shop_get_shop_agreements($user->uid, $_SESSION['regionselect']['zip'], $node->uid);
    $shopkeys = array_keys($shops);
    $shop = $shops[$shopkeys[0]];
}
?>
<div class="flexfix-wrapper clearfix"> 
    <div class="flexfix-content">
        <div class="flexfix-content-inner">
        <div class="row">
            <div class="info-wrapper clearfix"> 
                <div class="col-md-9"> 
                    <div class="seller-infos"> 
                        <h1><strong> <?php print $node->title; ?></strong></h1>
                        <ul class="list-inline">
                            <li>
                                <span class="fa fa-cutlery" ></span>
                                <?php
                                    $all_tids = array();
                                    foreach($node->field_sellercategories[LANGUAGE_NONE] as $index => $tid) {
                                        $all_tids[] = (int)$tid['tid'];
                                    }
                        
                                    $allterms = taxonomy_term_load_multiple($all_tids);
                                    foreach($allterms as $term) {
                                        print $term->name . ' ';
                                    }
                                ?>
                            </li>
                            <li>
                                <span class="fa fa-map-marker"></span>
                                <?php print $node->field_address[LANGUAGE_NONE][0]['thoroughfare']; ?>, <?php print $node->field_address[LANGUAGE_NONE][0]['postal_code'] ?> <?php print $node->field_address[LANGUAGE_NONE][0]['locality']; ?></li>
                            </li>
                        </ul>
                        <div class="seller-description"> 
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="<?php print image_style_url('thumbnail', $node->field_image[LANGUAGE_NONE][0]['uri']); ?>" alt="<?php print $node->title; ?>">
                                </a>
                                <div class="media-body">
                                   <?php
                                    $length = 280;
                                    $body = strip_tags($node->body[LANGUAGE_NONE][0]['value']);
                                    if(mb_strlen($body) > $length) {
                                        print '<div class="description" id="long-desc" style="display:none; height:auto"><p>'.$body.'</p>';
                                            print '<div class="more-toggle"><a href="#" id="read-less"> <span class="fa fa-chevron-up"></span> weniger lesen </a></div></div>';
                                        
                                        print '<div class="description" id="short-desc"><p>';
                                        print mb_substr($body, 0, mb_strpos($body, " ", $length)) . '<span class="elipsis"> ...</span></p><div class="more-toggle"><a href="#" id="read-more"> <span class="fa fa-chevron-down"></span> mehr lesen </a></div></div>';
                                        
                                    }
                                    else {
                                        print $body;
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 seller-meta">
                    
                    <div class="delivery-meta">
                        <h5>Lieferoptionen</h5>
                        <ul class="list-unstyled">
                            <li>
                                <span class="sprite sprite-delivery-pickup"></span><small class="text-muted">Selbstabholung<br>
                                ab</small> <strong>0€</strong>
                            </li>
                            <li><span class="sprite sprite-delivery-truck"></span><small class="text-muted">Lieferung<br>
                                ab</small> <strong>20€</strong></li>
                            
                            <li><span class="sprite sprite-delivery-mail"></span><small class="text-muted">Postversand<br>
                                ab</small> <strong>0€</strong></li>
                        </ul>
                    </div>
                    
                    <div class="payment-meta">
                         <h5>Zahlungsarten</h5>
                         <small class="text-muted">Rechnung, </small><small class="text-muted">Bar, </small><small class="text-muted">Online-Zahlung, </small><small>Nachnahme </small>
                    </div>
                </div>
        </div>
    </div>
       
            <ul class="product-grid clearfix"> 
                <?php foreach($node->offers as $offer): ?>
                    <?php foreach($offer->offer_variations as $variation): ?>
                        <li class="grid-item">
                            <div class="product-item"> 
                                <div class="product-image">
                                    <a href="#" data-toggle="modal" data-target="#variationModal<?php print $variation->nid; ?>">
                                    <?php if(!empty($variation->field_image[LANGUAGE_NONE][0]['uri'])): ?>
                                       <img src="<?php print image_style_url('product_grid', $variation->field_image[LANGUAGE_NONE][0]['uri']); ?>">
                                     
                                     <?php else: ?>
                                        <img src="<?php echo base_path() . path_to_theme();?>/images/no-image.gif">
    
                                    <?php  endif; ?>
                                    </a> 
                                </div>
                                 
                                <div class="product-infos">  
                                    <div class="product-title"> 
                                        <a href="#" class="title" data-toggle="modal" data-target="#variationModal<?php print $variation->nid; ?>">
                                                 <strong><?php print $variation->title; ?></strong>  
                                           <!-- <span class="details text-muted">
                                                <span class="glyphicon glyphicon-eye-open"></span> <small> Details</small>
                                            </span> -->
                                        </a>
                                    </div>
                                    <div class="product-price">
                                        
                                    <?php
                                        $tradingunits = count($variation->trading_units);
                                        $onlyone = ($tradingunits > 1)?false:true;
                                     ?>
                                     
                                     <?php
                                        if(isset($variation->trading_units[0]->field_tu_packaging[LANGUAGE_NONE][0]['value']) && !empty($tupackaging[$variation->trading_units[0]->field_tu_packaging[LANGUAGE_NONE][0]['value']])) {
                                                $packaging = $tupackaging[$variation->trading_units[0]->field_tu_packaging[LANGUAGE_NONE][0]['value']];
                                        }
                                        else {
                                                $default = field_get_default_value('node', $variation->trading_units[0], $packaging_field, $packaging_instance, $variation->trading_units[0]->language);
                                                $packaging = $tupackaging[$default[0]['value']];
                                        }
                                    ?>
                                     
                                    <?php if($onlyone): ?>
                                    
                                    
                                     
                                        <div class="tradingunit-single clearfix">
                                            <div class="label-area">
                                                <div class="price" data-tradingunit="<?php print $variation->trading_units[0]->nid;?>">
                                                    <div class="price-unit"> 
                                                        <strong><?php print number_format($variation->trading_units[0]->field_tu_price[LANGUAGE_NONE][0]['value'], 2, ",", "."); ?>€</strong><br>
                                                        <span class="unit-name"><strong><?php print $packaging; ?></strong> </span>
                                                        <span class="unit-amount text-muted"><?php print $variation->trading_units[0]->field_tu_amount[LANGUAGE_NONE][0]['value']; ?>&times;<?php print $variation->field_productunit[LANGUAGE_NONE][0]['first']; ?> <?php print t($variation->field_productunit[LANGUAGE_NONE][0]['second']); ?> </span>
                                                    </div>
                                                    <div class="price-info text-muted">
                                                        <span class="fa fa-info-circle"></span> zzgl. <?php print $variation->trading_units[0]->field_tu_vat[LANGUAGE_NONE][0]['value']; ?>% MwSt.<br>
                                                        <?php if(!empty($variation->trading_units[0]->field_tu_deposit[LANGUAGE_NONE][0]['value'])): ?>
                                                            <span class="fa fa-info-circle"></span> zzgl. <?php print number_format($variation->trading_units[0]->field_tu_deposit[LANGUAGE_NONE][0]['value'], 2, ",", "."); ?>€ Pfand
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                     
                                    <?php else: ?>
                                    
                                        <div class="btn-group btn-input clearfix">
                                            <button type="button" class="btn btn-default dropdown-toggle multiple" data-toggle="dropdown">
                                                <div class="label-area" data-bind="label"> 
                                                    <div class="price" data-tradingunit="<?php print $variation->trading_units[0]->nid;?>">
                                                        <div class="price-unit"> 
                                                            <strong> <?php print number_format($variation->trading_units[0]->field_tu_price[LANGUAGE_NONE][0]['value'], 2, ",", "."); ?>€</strong><br>
                                                            <span class="unit-name"><strong><?php print $packaging; ?></strong> </span>
                                                            <span class="unit-amount text-muted"><?php print $variation->trading_units[0]->field_tu_amount[LANGUAGE_NONE][0]['value']; ?>&times;<?php print $variation->field_productunit[LANGUAGE_NONE][0]['first']; ?> <?php print t($variation->field_productunit[LANGUAGE_NONE][0]['second']); ?> </span>
                                                        </div>
                                                        <div class="price-info text-muted">
                                                            <span class="fa fa-info-circle"></span> zzgl. <?php print $variation->trading_units[0]->field_tu_vat[LANGUAGE_NONE][0]['value']; ?>% Mwst.   <br>
                                                            <span class="fa fa-info-circle"></span> zzgl. <?php print number_format($variation->trading_units[0]->field_tu_deposit[LANGUAGE_NONE][0]['value'], 2, ",", "."); ?>€ Pfand<br>
                                                            <span class="indicator"><span class="fa fa-chevron-down"></span><strong> weitere Gebinde</strong></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                    
                                        <?php $first = TRUE;?>
                                        <?php foreach($variation->trading_units as $delta => $tradingunit): ?>
                                        
                                            <?php
                                                if(isset($tradingunit->field_tu_packaging[LANGUAGE_NONE][0]['value']) && !empty($tupackaging[$tradingunit->field_tu_packaging[LANGUAGE_NONE][0]['value']])) {
                                                        $packaging = $tupackaging[$tradingunit->field_tu_packaging[LANGUAGE_NONE][0]['value']];
                                                }
                                                else {
                                                        $default = field_get_default_value('node', $tradingunit, $packaging_field, $packaging_instance, $tradingunit->language);
                                                        $packaging = $tupackaging[$default[0]['value']];
                                                }
                                            ?>
                                            
                                            
                                                <li<?php print ($first == TRUE) ? ' class="hidden"' : ''; ?>>
                                                    <a href="#" class="clearfix"> 
                                                        <div class="price" data-tradingunit="<?php print $tradingunit->nid; ?>">
                                                            <div class="price-unit"> 
                                                                <strong> <?php print number_format($tradingunit->field_tu_price[LANGUAGE_NONE][0]['value'], 2, ",", "."); ?>€</strong><br>
                                                                <span class="unit-name"><strong><?php print $packaging; ?></strong> </span>
                                                                <span class="unit-amount text-muted"><?php print $tradingunit->field_tu_amount[LANGUAGE_NONE][0]['value']; ?>&times;<?php print $variation->field_productunit[LANGUAGE_NONE][0]['first']; ?> <?php print t($variation->field_productunit[LANGUAGE_NONE][0]['second']); ?> </span>
                                                            </div>
                                                            <div class="price-info text-muted">
                                                                <span class="fa fa-info-circle"></span> zzgl. <?php print $tradingunit->field_tu_vat[LANGUAGE_NONE][0]['value']; ?>% Mwst.   <br>
                                                                <span class="fa fa-info-circle"></span> zzgl. <?php print number_format($tradingunit->field_tu_deposit[LANGUAGE_NONE][0]['value'], 2, ",", "."); ?>€ Pfand<br>
                                                                <span class="indicator"><span class="fa fa-chevron-down"></span><strong> weitere Gebinde</strong></span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                
                                        <?php $first = FALSE; ?>
                                        <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                    </div> 
                                </div>
                                   
                                <div class="add-to-cart-area">
                                    <button data-offerid ="<?php print $offer->nid;  ?>" data-variation ="<?php print $variation->nid;  ?>" type="button" class="btn add2Cart btn-default btn-lg"><span class="fa fa-shopping-cart"></span> in den Warenkorb</button>
                                     
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="flexfix-sidebar">
        <div class="cart-container"> 
            <?php
            $block = module_invoke('rm_cart', 'block_view', 'rm_cart_block');
                print render($block['content']);
            ?>
        </div>
    </div>
</div>
<?php foreach($node->offers as $offer): ?>
    <?php foreach($offer->offer_variations as $variation): ?>
        <div class="modal fade" id="variationModal<?php print $variation->nid;?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="variationModalLabel"><?php print $variation->title; ?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12"> 
                            <?php if(!empty($variation->field_image[LANGUAGE_NONE][0]['uri'])): ?>
                                <img class="media-object pull-left" src="<?php print image_style_url('product_grid', $variation->field_image[LANGUAGE_NONE][0]['uri']); ?>" alt="<?php print $variation->title; ?>" class="img-thumbnail pull-left">
                            <?php endif; ?>
                                <div class="media-body">
                                <?php print $variation->body[LANGUAGE_NONE][0]['value']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                       <!-- <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart"></span> in den Warenkorb</button>-->
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    <?php endforeach; ?>
<?php endforeach; ?>


