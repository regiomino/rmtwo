<?php
$tupackaging = list_allowed_values(field_info_field('field_tu_packaging'));
$packaging_field = field_info_field('field_tu_packaging');
$packaging_instance = field_info_instance('node', 'field_tu_packaging', 'trading_unit');
$shop = array();
$zipcode = NULL;
if(isset($_SESSION['regionselect']['zip'])) $zipcode = $_SESSION['regionselect']['zip'];
$shops = rm_shop_get_shop_agreements($user->uid, $zipcode, $node->uid);
$shopkeys = array_keys($shops);
$shop = $shops[$shopkeys[0]];

?>
<div class="flexfix-wrapper clearfix"> 
    <div class="flexfix-content">
        <div class="flexfix-content-inner">
            <div class="row">
                <div class="info-wrapper clearfix"> 
                    <div class="col-md-12"> 
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
                                    <?php print $node->field_company_name[LANGUAGE_NONE][0]['value']; ?>, <?php print $node->field_address[LANGUAGE_NONE][0]['thoroughfare']; ?>, <?php print $node->field_address[LANGUAGE_NONE][0]['postal_code'] ?> <?php print $node->field_address[LANGUAGE_NONE][0]['locality']; ?>, Tel.: <?php print rm_api_format_phone($node->field_publicphone[LANGUAGE_NONE][0]['number']); ?></li>
                                </li>
                            </ul>
                            <div class="seller-description"> 
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object img-circle" src="<?php print image_style_url('seller_thumb', $node->field_image[LANGUAGE_NONE][0]['uri']); ?>" alt="<?php print $node->title; ?>">
                                    </a>
                                    <div class="media-body">
                                       <?php
                                        $length = 410;
                                        $body = strip_tags($node->body[LANGUAGE_NONE][0]['value']);
                                        if(mb_strlen($body) > $length) {
                                            print '<div class="description" id="long-desc" style="display:none; height:auto"><p>'.$body.'</p>';
                                            print '<div class="more-toggle"><a href="#" id="read-less"> <span class="fa fa-chevron-up"></span> weniger Informationen </a></div></div>';
                                            
                                            print '<div class="description" id="short-desc"><p>';
                                            print mb_substr($body, 0, mb_strpos($body, " ", $length)) . '<span class="elipsis"> ...</span></p><div class="more-toggle"><a href="#" id="read-more"> <span class="fa fa-chevron-down"></span> mehr Informationen </a></div></div>';
                                        }
                                        else {
                                            print $body;
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end seller-infos-->
                    </div><!-- end col-md-12-->
                     
                    <div class="col-md-12 seller-meta">
                        <div class="row">
                            <div class="delivery-meta col-md-8">
                                <?php if(!empty($shop->agreements)) : ?>
                                <!--<h5>Lieferoptionen</h5>-->
                                <ul class="list-inline">
                                <?php
                                
                             if(!empty($shop->agreements['pickup_agreement'])) {
                             
                                    $lowestmov = 9999999;
                                    foreach($shop->agreements['pickup_agreement'] as $target_id => $agreements) {
                                        foreach($agreements as $agreement) {
                                            if($agreement->field_minimum_order_value[LANGUAGE_NONE][0]['value'] < $lowestmov) {
                                                $lowestmov = $agreement->field_minimum_order_value[LANGUAGE_NONE][0]['value'];
                                            }
                                        }
                                    }
                                    print "<li>";
                                        print  '<a href="#" id="pickupModalToggle">';
                                        print '<span class="sprite sprite-delivery-pickup"></span>';
                                        print '<small class="text-muted"> Selbstabholung <br> ';
                                        print '<strong> ab ' . number_format($lowestmov, 2, ",", ".") . '€ | <span class="indicator"> Orte anzeigen </span> </strong>';
                                        print '</small> ';
                                        print '</a>';
                                    print "</li>";
                            }
                             
                             foreach($shop->agreements as $type => $user_reference) {
                                        foreach($user_reference as $target_id => $agreements) {
                                            //if theres two variantes for the same agreement, then choose the one with less minimum order value
                                            if(count($agreements) > 1) {
                                                usort($agreements, "rm_shop_sort_agreements_by_mov");
                                            }
                                            
                                            foreach($agreements as $agreement) {
                                               
                                                
                                                switch($type) {
                                                    
                                                    case 'shipping_agreement':
                                                         print "<li>";
                                                        print  "<a href='#' data-toggle='popover' data-content='" . render(field_view_field('node', $agreement, 'field_regular_times')) . "'>";
                                                            print '<span class="sprite sprite-delivery-truck"></span>';
                                                            print '<small class="text-muted">' . node_type_get_name('shipping_agreement') . ' <br>';
                                                            print '<strong> ab ' . number_format($agreement->field_minimum_order_value[LANGUAGE_NONE][0]['value'], 2, ",", ".").'€'.' | <span class="indicator"> Lieferzeiten anzeigen </span></strong>';
                                                            print '</small>';
                                                        print '</a>';
                                                         print "</li>";
                                                    break;
                                                
                                                    case 'dispatch_agreement':
                                                         print "<li>";
                                                        print  "<a href='#' data-toggle='popover' data-content='" . t('Have your order delivered to you by @provider', array('@provider' => $agreement->field_dispatch_provider[LANGUAGE_NONE][0]['value']))."'>";
                                                            print '<span class="sprite sprite-delivery-mail"></span>';
                                                            print '<small class="text-muted">' . node_type_get_name('dispatch_agreement') . ' <span class="fa fa-info-circle"></span><br>ab</small> ';
                                                            print '<strong>' . number_format($agreement->field_minimum_order_value[LANGUAGE_NONE][0]['value'], 2, ",", ".").'€'.'</strong>';
                                                        print '</a>';
                                                          print "</li>";
                                                    break;
                                                }
                                               
                                            } 
                                        }
                                    }
                             
                             
                             
                             
                             
                                  /*  foreach($shop->agreements as $type => $user_reference) {
                                        foreach($user_reference as $target_id => $agreements) {
                                            //if theres two variantes for the same agreement, then choose the one with less minimum order value
                                            if(count($agreements) > 1) {
                                                usort($agreements, "rm_shop_sort_agreements_by_mov");
                                            }
                                           
                                             foreach($agreements as $agreement) {
                                                print "<li>";
                                                
                                                switch($type) {
                                                    
                                                    case 'pickup_agreement':
                                                        print  "<a href='#' data-toggle='popover' data-content='" . render(field_view_field('node', $agreement, 'field_regular_times')) . "'>";
                                                            print '<span class="sprite sprite-delivery-pickup"></span>';
                                                            print '<small class="text-muted">' . t('@pickup in @loc', array('@pickup' => node_type_get_name('pickup_agreement'), '@loc' => $agreement->field_address[LANGUAGE_NONE][0]['locality'] . ' (' . $agreement->field_address[LANGUAGE_NONE][0]['thoroughfare'] . ')')) . ' <span class="fa fa-info-circle"></span><br>ab</small> ';
                                                            print '<strong>' . number_format($agreement->field_minimum_order_value[LANGUAGE_NONE][0]['value'], 2, ",", ".").'€'.'</strong>';
                                                        print '</a>';
                                                    break;
                                                
                                                    case 'shipping_agreement':
                                                        print  "<a href='#' data-toggle='popover' data-content='" . render(field_view_field('node', $agreement, 'field_regular_times')) . "'>";
                                                            print '<span class="sprite sprite-delivery-truck"></span>';
                                                            print '<small class="text-muted">' . node_type_get_name('shipping_agreement') .' <span class="fa fa-info-circle"></span><br>ab</small> ';
                                                            print '<strong>' . number_format($agreement->field_minimum_order_value[LANGUAGE_NONE][0]['value'], 2, ",", ".").'€'.'</strong>';
                                                        print '</a>';
                                                    break;
                                                
                                                    case 'dispatch_agreement':
                                                        print  "<a href='#' data-toggle='popover' data-content='" . t('Have your order delivered to you by @provider', array('@provider' => $agreement->field_dispatch_provider[LANGUAGE_NONE][0]['value']))."'>";
                                                            print '<span class="sprite sprite-delivery-mail"></span>';
                                                            print '<small class="text-muted">' . node_type_get_name('dispatch_agreement') . ' <span class="fa fa-info-circle"></span><br>ab</small> ';
                                                            print '<strong>' . number_format($agreement->field_minimum_order_value[LANGUAGE_NONE][0]['value'], 2, ",", ".").'€'.'</strong>';
                                                        print '</a>';
                                                    break;
                                                }
                                                print "</li>";
                                            } 
                                        }
                                    }*/
                                ?>
                                </ul>
                                    
                            <?php endif; ?>
                            </div><!-- end delivery-meta-->
                       
                            <div class="payment-meta col-md-4">
                                <?php if(!empty($shop->agreements)) : ?>
                                
                                <?php
                                    foreach($shop->agreements as $type => $user_reference) {
                                        foreach($user_reference as $target_id => $index) {
                                            foreach($index as $indexid => $agreement) {
                                                switch($type) {
                                                    case 'payment_agreement':
                                                        foreach($agreement->field_payment_types[LANGUAGE_NONE] as $payment_type) {
                                                            switch($payment_type['value']) {
                                                                case 'prepaid':
                                                                    print '<small class="text-muted" data-toggle="popover" data-content="' . t('Pay online during checkout via one of our payment providers') . '">Sofortüberweisung, PayPal, </small> ';
                                                                    break;
                                                                case 'cash':
                                                                    print '<small class="text-muted" data-toggle="popover" data-content="' . t('Pay cash when your order is delivered') . '">Barzahlung, </small> ';
                                                                    break;
                                                                case 'invoice':
                                                                    print '<small class="text-muted" data-toggle="popover" data-content="' . t('The vendor will send you an invoice after your order is complete') . '">Rechnung, </small> ';
                                                                    break;
                                                            }
                                                        }
                                                        break;
                                                }
                                            }
                                        }
                                    }
                                ?>
                                <?php endif; ?>
                            </div> <!-- end payment-meta-->
                        </div> <!-- end row-->
                    </div><!-- end seller-meta -->
                </div> <!-- end info-wrapper -->
            </div> <!-- end row -->
       
            <ul class="product-grid clearfix"> 
                <?php foreach($node->offers as $offer): ?>
                    <?php foreach($offer->offer_variations as $variation): ?>
                    <?php $hasImage = (empty($variation->field_image[LANGUAGE_NONE][0]['uri'])) ? false : true; ?>
                        <li class="grid-item">
                            <div class="product-item"> 
                                <div class="product-image <?php if(!$hasImage) { print "no-image";} ?>">
                                    <a href="#" data-toggle="modal" data-target="#variationModal<?php print $variation->nid; ?>">
                                    <?php if($hasImage): ?>
                                       <img src="<?php print image_style_url('product_grid', $variation->field_image[LANGUAGE_NONE][0]['uri']); ?>">
                                     
                                     <?php else: ?>
                                        <img src="<?php echo base_path() . path_to_theme();?>/images/no-image.png">
    
                                    <?php  endif; ?>
                                    </a> 
                                </div>
                                 
                                <div class="product-infos">  
                                    <div class="product-title"> 
                                        <a href="#" class="title" data-toggle="modal" data-target="#variationModal<?php print $variation->nid; ?>">
                                            <strong><?php print $variation->title; ?></strong>  
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
                                                         zzgl. <?php print $variation->trading_units[0]->field_tu_vat[LANGUAGE_NONE][0]['value']; ?>% MwSt.<br>
                                                        <?php if(!empty($variation->trading_units[0]->field_tu_deposit[LANGUAGE_NONE][0]['value'])): ?>
                                                             zzgl. <?php print number_format($variation->trading_units[0]->field_tu_deposit[LANGUAGE_NONE][0]['value'], 2, ",", "."); ?>€ Pfand
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
                                                           zzgl. <?php print $variation->trading_units[0]->field_tu_vat[LANGUAGE_NONE][0]['value']; ?>% Mwst.   <br>
                                                             zzgl. <?php print number_format($variation->trading_units[0]->field_tu_deposit[LANGUAGE_NONE][0]['value'], 2, ",", "."); ?>€ Pfand<br>
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
                                                                 zzgl. <?php print $tradingunit->field_tu_vat[LANGUAGE_NONE][0]['value']; ?>% Mwst.   <br>
                                                                 zzgl. <?php print number_format($tradingunit->field_tu_deposit[LANGUAGE_NONE][0]['value'], 2, ",", "."); ?>€ Pfand<br>
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
                                    <button data-offerid ="<?php print $offer->nid;  ?>" data-variation ="<?php print $variation->nid;  ?>" type="button" class="btn add2Cart  btn-default btn-lg">
                                        <span class="fa fa-shopping-cart"></span>
                                        <span class="fa add2cart-animation fa-check-circle hidden"></span> in den Warenkorb
                                    </button>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </ul><!-- end product-grid -->
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
    
    <div class="modal fade" tabindex="-1" id="pickupModal" role="dialog" aria-labelledby="Selbstabholung" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="variationModalLabel">Selbstabholung bei <strong><?php print $node->title; ?></strong></h3>
        </div>
        <div class="modal-body clearfix">
            <div id="pickupMap" class="pickupMap">
                
            </div>
            
            <div class="pickupInfo">
                 <?php
                    if(!empty($shop->agreements)) {
                        foreach($shop->agreements as $type => $user_reference) {
                            if($type == 'pickup_agreement') {
                                $count = 1;
                                foreach($user_reference as $target_id => $agreements) {
                                   
                                    foreach($agreements as $agreement) {
                                        //funky shit mit pickup_agreements machen
                                        //$agreement->nid
                                        //$agreement->type
                                        //$agreement->field_address[LANGUAGE_NONE][0]['postal_code']
                                        //usw.
                                         if($count % 2 == 0) {
                                            $striped = true;
                                        } else {
                                            $striped = false;
                                        }
                                    ?>
                                    
                                    <div class="pickup-spot <?php if($striped){print 'striped';};?>"> 
                                        <div class="pickup-description"> 
                                            <h4 class="spot-title"><span class="fa fa-map-marker fa-fw"></span> <?php print $agreement->field_address[LANGUAGE_NONE][0]['thoroughfare'];?>, <?php print $agreement->field_address[LANGUAGE_NONE][0]['postal_code']?> <?php print $agreement->field_address[LANGUAGE_NONE][0]['locality']?> </h4>
                                        </div>
                                       
                                       <?php
                                        $weekdays = array(
                                            1 => t('Monday'),
                                            2 => t('Tuesday'),
                                            3 => t('Wednesday'),
                                            4 => t('Thursday'),
                                            5 => t('Friday'),
                                            6 => t('Saturday'),
                                            7 => t('Sunday'),
                                        );
                                        $agreementtimes = array();
                                        if(!empty($agreement->field_regular_times[LANGUAGE_NONE])) {
                                            foreach($agreement->field_regular_times[LANGUAGE_NONE] as $key => $values) {
                                                $agreementtimes[$values['day']][] = array(
                                                    'starthours' => substr($values['starthours'], 0, -2) . ':' . substr($values['starthours'], -2),
                                                    'endhours' => substr($values['endhours'], 0, -2) . ':' . substr($values['endhours'], -2),
                                                );
                                            }
                                        }
                                        ?>
                                        <table class="table pickup-times  table-condensed">
                                        <thead>
                                        <?php foreach($weekdays as $weekday): ?>
                                            <th><?php echo $weekday; ?></th>
                                        <?php endforeach; ?>
                                        </thead>
                                        <tbody>
                                        <?php foreach($weekdays as $weekiso => $weekday): ?>
                                            <td>
                                                <?php if(isset($agreementtimes[$weekiso])): ?>
                                                    <?php foreach($agreementtimes[$weekiso] as $agreementtime): ?>
                                                        <?php echo $agreementtime['starthours']; ?>
                                                        -
                                                        <?php echo $agreementtime['endhours']; ?>
                                                        <br>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    geschlossen
                                                <?php endif; ?>
                                            </td>
                                        <?php endforeach; ?>
                                        </tbody>
                                        </table>
                                       
                                    </div> <!-- end spickup-spot-->
                      
                                   <?php  $count++;}
                                }
                            }
                        }
                    }
                ?>
                   
                
            </div><!-- end pickup-info-->
        </div><!-- end modal-body-->
    </div>
  </div>
</div>
    
    
    
<?php endforeach; ?>


