 <?php

/**
 *  Alle spannenden Sachen in $node
 */
 
    /* //Titel
    print $node->title;
     
    //Kategorien für den Verkäufer (nicht für die Produkte!)
    foreach($node->field_sellercategories[LANGUAGE_NONE] as $category) {
        print $category['taxonomy_term']->name;
    }
     
    //URLs für Verkäuferbilder
    foreach($node->field_image[LANGUAGE_NONE] as $sellerimage) {
        print image_style_url('image_style', $sellerimage['uri']);
    }

    //Beschreibung
    print $node->body[LANGUAGE_NONE][0]['value'];

    //Produkte
    foreach($node->offers as $offer) {
        //Übergeordneter Titel
        print $offer->title;
        //Produktherkunft Firma
        print $offer->field_origin[LANGUAGE_NONE][0]['organisation_name'];
        //Produktherkunft PLZ
        print $offer->field_origin[LANGUAGE_NONE][0]['postal_code'];
        //Produktherkunft Ort
        print $offer->field_origin[LANGUAGE_NONE][0]['locality'];
        //Produktherkunft Land
        print $offer->field_origin[LANGUAGE_NONE][0]['country'];
        
        foreach($offer->offer_variations as $variation) {
            //Titel der Produktvariante
            print $variation->title;
            //Produkteinheit (Menge)
            print $variation->field_productunit[LANGUAGE_NONE][0]['first'];
            //Produkteinheit (Einheit)
            print $variation->field_productunit[LANGUAGE_NONE][0]['second'];
            //URLs für Produktbilder
            foreach($variation->field_image[LANGUAGE_NONE] as $productimage) {
                print image_style_url('image_style', $productimage['uri']);
            }
            //Produktbeschreibung
            print $variation->body[LANGUAGE_NONE][0]['value'];
            
            foreach($variation->trading_units as $tradingunits) {
                //Gebindemenge
                print $tradingunits->field_tu_amount[LANGUAGE_NONE][0]['value'];
                //Gebinde-Nettopreis
                print number_format($tradingunits->field_tu_price[LANGUAGE_NONE][0]['value'], 2, ",", ".") . ' €';
                //Gebinde-Pfand
                print number_format($tradingunits->field_tu_deposit[LANGUAGE_NONE][0]['value'], 2, ",", ".") . ' €';
            }
        }
    } */ ?>
<?php
$tupackaging = list_allowed_values(field_info_field('field_tu_packaging'));
$packaging_field = field_info_field('field_tu_packaging');
$packaging_instance = field_info_instance('node', 'field_tu_packaging', 'trading_unit');
?>
<div class="wrapper-m">
    <div class="wrapper-m-inner">
        <div class="seller-infos"> 
            <h1 class="h2"><strong> <?php print $node->title; ?></strong></h1>
            <ul class="list-inline">
                <li>
                    <span class="glyphicon glyphicon-cutlery" ></span>
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
                    <span class="glyphicon glyphicon-road"></span>
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
                        $length = 390;
                        $body = strip_tags($node->body[LANGUAGE_NONE][0]['value']);
                        if(mb_strlen($body) > $length) {
                            print '<div class="description" id="long-desc" style="display:none; height:auto"><p>'.$body.'</p>';
                                print '<div class="more-toggle"><a href="#" id="read-less"> <span class="glyphicon glyphicon-chevron-up"></span> weniger lesen </a></div></div>';
                            
                            print '<div class="description" id="short-desc"><p>';
                            print mb_substr($body, 0, mb_strpos($body, " ", $length)) . '<span class="elipsis"> ...</span></p><div class="more-toggle"><a href="#" id="read-more"> <span class="glyphicon glyphicon-chevron-down"></span> mehr lesen </a></div></div>';
                            
                        }
                        else {
                            print $body;
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
   
        <ul class="product-grid clearfix"> 
            <?php foreach($node->offers as $offer): ?>
                <?php foreach($offer->offer_variations as $variation): ?>
                    <li>
                        <div class="product-item"> 
                            <div class="image-wrapper">
                                <div class="image">
                                   <img class="img-responsive" src="<?php print image_style_url('thumbnail', $variation->field_image[LANGUAGE_NONE][0]['uri']); ?>">
                                    
                                </div>
                                
                            </div>
                             
                            <div class="product-title"> 
                                <a href="#" data-toggle="modal" data-target="#variationModal<?php print $variation->nid; ?>">
                                    <span class=" title">
                                         <strong><?php print $variation->title; ?></strong>  
                                    </span>
                                    <span class="details text-muted">
                                        <span class="glyphicon glyphicon-eye-open"></span> <small> Details</small>
                                    </span> 
                                </a>
                            </div>
                            
                            <div class="product-data">
                                <div class="price-unit">
                                    <div class="items btn-group" data-toggle="buttons">
                                        <?php $first = TRUE; foreach($variation->trading_units as $delta => $tradingunit): ?>
                                            <?php
                                                if(isset($tradingunit->field_tu_packaging[LANGUAGE_NONE][0]['value']) && !empty($tupackaging[$tradingunit->field_tu_packaging[LANGUAGE_NONE][0]['value']])) {
                                                    $packaging = $tupackaging[$tradingunit->field_tu_packaging[LANGUAGE_NONE][0]['value']];
                                                }
                                                else {
                                                    $default = field_get_default_value('node', $tradingunit, $packaging_field, $packaging_instance, $tradingunit->language);
                                                    $packaging = $tupackaging[$default[0]['value']];
                                                }
                                            ?>
                                            <label class="item btn <?php if($first): ?>active<?php endif; ?>">
                                                <input type="radio" name="options" data-tradingunit="<?php print $tradingunit->nid; ?>" id="option<?php print $tradingunit->nid; ?>" <?php if($first): ?> checked <?php endif; $first=FALSE;  ?>>
                                                <span  class="price"><strong><?php print number_format($tradingunit->field_tu_price[LANGUAGE_NONE][0]['value'], 2, ",", "."); ?>€</strong></span>
                                                <span  class="unit text-mute"><strong><?php print $packaging; ?></strong> <br>(<?php print $tradingunit->field_tu_amount[LANGUAGE_NONE][0]['value']; ?> &times; <?php print $variation->field_productunit[LANGUAGE_NONE][0]['first']; ?><?php print t($variation->field_productunit[LANGUAGE_NONE][0]['second']); ?>) <br><small><span class="glyphicon glyphicon-info-sign"></span> zzgl. <?php print $tradingunit->field_tu_vat[LANGUAGE_NONE][0]['value']; ?>% MwSt.<?php if(!empty($tradingunit->field_tu_deposit[LANGUAGE_NONE][0]['value'])): ?><br><span class="glyphicon glyphicon-info-sign"></span> zzgl. <?php print number_format($tradingunit->field_tu_deposit[LANGUAGE_NONE][0]['value'], 2, ",", "."); ?>€ Pfand<?php endif; ?></small></span>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                               
                            
                           
                            <div class="add-to-cart-area" >
                                <div class="text-center button-display add2Cart" data-offerid ="<?php print $offer->nid;  ?>" data-variation ="<?php print $variation->nid;  ?>">
                                    <span class="glyphicon glyphicon-shopping-cart"></span> in den Warenkorb
                                </div>
                            </div>
                               
                      
                        </div>
                    </li>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<div class= "grid-l">
<?php
$block = module_invoke('rm_cart', 'block_view', 'rm_cart_block');
    print render($block['content']);
?>
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
                        <?php if(!empty($variation->field_image[LANGUAGE_NONE][0]['uri'])): ?>
                            <img src="<?php print image_style_url('thumbnail', $variation->field_image[LANGUAGE_NONE][0]['uri']); ?>" alt="<?php print $variation->title; ?>" class="img-thumbnail pull-left">
                        <?php endif; ?>
                        <?php print $variation->body[LANGUAGE_NONE][0]['value']; ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                        <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart"></span> in den Warenkorb</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    <?php endforeach; ?>
<?php endforeach; ?>


