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
 <div class="row toparea"> 
<ul class="breadcrumbs">            
    <li>
        <?php 
           print l(
              '<span class="fa fa-home fa-lg""></span>',
              '',
              array(
                'html' => true,
                'attributes' => array(
                  'class' => 'home',
                )
              )
            );
        ?>
    </li>
    <li>
        <?php if(!empty($_SESSION['regionselect']['zip'])): ?>
            <?php print l($_SESSION['regionselect']['zip'], 'lieferanten/' . $_SESSION['regionselect']['zip']); ?>
        <?php else: ?>
           <!--  <?php print render(drupal_get_form('rm_shop_smartregionselect')); ?> --> 
            <a href="#"> <?php print $node->title; ?> </a>
        <?php endif; ?>
    </li>
    <!-- <li>
        <a href="#"> <?php print $node->title; ?></a>
    </li> -->
</ul>

<div class="tabarea hidden-sm hidden-xs">
        <a href="#" class="tab-item"><span class="fa fa-shopping-cart"> </span> Warenkorb </a>
</div>  

</div>     

<div class="flexfix-wrapper clearfix"> 
    <div class="flexfix-content">
        <div class="flexfix-content-inner">
            <div class="row seller-title">
                <div class="col-md-12">
                    <h1 class="h2"><strong> <?php print $node->title; ?></strong></h1> 
                </div>
            </div>
            <div class="row seller-info">
                <div class="col-sm-7 hidden-xs lpr"> 
                    <a href="#" data-toggle='modal' data-target='#detailModal'>
                    <?php $hasImage = (empty($node->field_image[LANGUAGE_NONE][0]['uri'])) ? false : true; ?>

                    <?php if($hasImage): ?>
                      <img class="img-responsive img-rounded seller-image" src="<?php print image_style_url('seller_large', $node->field_image[LANGUAGE_NONE][0]['uri']); ?>" alt="<?php print $node->title; ?>">
                     
                     <?php else: ?>
                        <img src="<?php echo base_path() . path_to_theme();?>/images/no-image.png">
                    
                    <?php  endif; ?>

                    </a>
                </div> 
                <div class="col-sm-5  lpl">       
                    <ul class="list-unstyled seller-meta">
                        <li>
                            <span class="fa fa-cutlery fa-fw" ></span>
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
                            <span class="fa fa-map-marker fa-fw"></span>
                            <?php print $node->field_company_name[LANGUAGE_NONE][0]['value']; ?><br> <?php print $node->field_address[LANGUAGE_NONE][0]['thoroughfare']; ?><br> <?php print $node->field_address[LANGUAGE_NONE][0]['postal_code'] ?> <?php print $node->field_address[LANGUAGE_NONE][0]['locality']; ?> </li>
                        </li>
                        <li> 
                            <span class="fa fa-phone fa-fw"></span>
                            <?php print rm_api_format_phone($node->field_publicphone[LANGUAGE_NONE][0]['number']); ?>
                        </li>
                        <li>
                            <?php if(!empty($shop->agreements)) : ?>
                            <span class="fa fa-money fa-fw"></span>
                            <?php
                                foreach($shop->agreements as $type => $user_reference) {
                                    foreach($user_reference as $target_id => $index) {
                                        foreach($index as $indexid => $agreement) {
                                            switch($type) {
                                                case 'payment_agreement':
                                                    foreach($agreement->field_payment_types[LANGUAGE_NONE] as $payment_type) {
                                                        switch($payment_type['value']) {
                                                            case 'prepaid':
                                                                print '<span data-toggle="popover" data-content="' . t('Pay online during checkout via one of our payment providers') . '">Sofortüberweisung, PayPal, </span>';
                                                                break;
                                                            case 'cash':
                                                                print '<span  data-toggle="popover" data-content="' . t('Pay cash when your order is delivered') . '">Barzahlung, </span> ';
                                                                break;
                                                            case 'invoice':
                                                                print '<span  data-toggle="popover" data-content="' . t('The vendor will send you an invoice after your order is complete') . '">Rechnung,</span> ';
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
                        </li>
                    </ul>
                    <button class="btn hidden-md btn-default" data-toggle='modal' data-target='#detailModal'> Details zum Betrieb <span class="fa fa-chevron-right"></span></button>
                   <div class="modal fade" id="detailModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" ><span aria-hidden="true">&times;</span><span class="sr-only">Close</span> </button>
                                 <!--  <img class="img-responsive" src="<?php print image_style_url('seller_large', $node->field_image[LANGUAGE_NONE][0]['uri']); ?>" alt="<?php print $node->title; ?>"> -->

                                    <h3 class="modal-title" id="variationModalLabel"><?php print $node->title; ?></strong></h3>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12"> 
                                        <?php $body = strip_tags($node->body[LANGUAGE_NONE][0]['value']); ?>
                                        <p><em><?php print $body;  ?> </em></p>
                                     </div>
                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                   </div><!-- /.modal -->
                   
                </div>
            </div>
            <div class="row delivery-options">
                <div class="col-sm-12"> 
                    <div class="delivery-options-container">

                    <?php if(!empty($shop->agreements['pickup_agreement'])) : ?>
                        <?php
                        $lowestmov = 9999999;
                        foreach($shop->agreements['pickup_agreement'] as $target_id => $agreements) {
                            foreach($agreements as $agreement) {
                                if($agreement->field_minimum_order_value[LANGUAGE_NONE][0]['value'] < $lowestmov) {
                                    $lowestmov = $agreement->field_minimum_order_value[LANGUAGE_NONE][0]['value'];
                                }
                            }
                        }
                        print '<div class="delivery-option">';
                        print  '<a href="#" id="pickupModalToggle">';
                        print '<span class="sprite sprite-delivery-pickup"></span>';
                        print '<small class="text-muted"> Selbstabholung ';
                        print '<strong> ab ' . number_format($lowestmov, 2, ",", ".") . '€ <br>  </strong>';
                        print '<span class="indicator"> <strong>  Orte anzeigen <span class="fa fa-chevron-right"></span> </strong></span>';
                        print '</small> ';
                        print '</a>';
                        print "</div>";
                        ?>
                    <?php else: ?>
                        <?php  
                            print '<div class="delivery-option inactive">';
                            print '<span class="sprite sprite-delivery-pickup"></span>';
                            print '<small class="text-muted"> Lieferung <br>';
                            print '<strong> derzeit nicht möglich </strong>';
                            print '</small> ';
                            print "</div>";
                         ?>
                    <?php endif; ?>

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
                    
                    <?php if(!empty($shop->agreements['shipping_agreement'])) : ?>
                        <?php
                        $zipcodes = '';
                        foreach($shop->agreements['shipping_agreement'] as $target_id => $agreements) {
                            if(count($agreements) > 1) {
                                usort($agreements, "rm_shop_sort_agreements_by_mov");
                            }   
                            foreach($agreements as $agreement) {
                                foreach($agreement->field_shipping_zipcodes[LANGUAGE_NONE] as $zipcode) {
                                    $zipcodes .= $zipcode['value'] . ' ';
                                }
                                print '<div class="delivery-option">';

                                print  "<a href='#' data-toggle='modal' data-target='#shippingModal'>";
                                print '<span class="sprite sprite-delivery-truck"></span>';
                                print '<small class="text-muted">' . node_type_get_name('shipping_agreement') . '<strong> ab ' . number_format($agreement->field_minimum_order_value[LANGUAGE_NONE][0]['value'], 2, ",", ".").'€'.' <br>';
                                print '<span class="indicator"> Lieferzeiten anzeigen <span class="fa fa-chevron-right"></span> </span> </strong>';
                                print '</small>';
                                print '</a>';

                                print '
                                <div class="modal fade" id="shippingModal">
                                 <div class="modal-dialog">
                                     <div class="modal-content">
                                         <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                 <h3 class="modal-title" id="variationModalLabel">Lieferung von <strong>' . $node->title . '</strong></h3>
                                         </div>
                                         <div class="modal-body">
                                             <div class="row">
                                                 <div class="col-md-12"> 
                                                     <p>Lieferung möglich in die folgenden deutschen PLZ-Gebiete an den bezeichneten Wochentagen und Uhrzeiten unter Berücksichtigung der produktspezifischen Bestellfristen. Die Fristen entnehmen Sie bitte den jeweiligen Produktbeschreibungen durch Klick auf Produktbild oder -namen.</p><br>
                                                 </div>
                                             </div>
                                             <div class="row">
                                                 <div class="col-md-6"> 
                                                     ' . render(field_view_field('node', $agreement, 'field_regular_times')) . '
                                                 </div>
                                                 <div class="col-md-6"> 
                                                     <p><strong>PLZ-Gebiete:</strong><br>' . $zipcodes . '</p>
                                                 </div>
                                             </div>
                                         </div>
                                     </div><!-- /.modal-content -->
                                 </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                ';


                                print "</div> ";
                            }
                        }
                        ?>
                    <?php else: ?>
                        <?php  
                            print '<div class="delivery-option inactive">';
                            print '<span class="sprite sprite-delivery-truck"></span>';
                            print '<small class="text-muted"> Lieferung <br>';
                            print '<strong> derzeit nicht möglich </strong>';
                            print '</small> ';
                            print "</div>";
                         ?>
                    <?php endif; ?>
                    
                    
                    <?php if(!empty($shop->agreements['dispatch_agreement'])) : ?>
                        <?php
                        $zipcodes = '';
                        foreach($shop->agreements['dispatch_agreement'] as $target_id => $agreements) {
                            if(count($agreements) > 1) {
                                usort($agreements, "rm_shop_sort_agreements_by_mov");
                            }   
                            foreach($agreements as $agreement) {
                            print '<div class="delivery-option">';
                            print  "<a href='#' data-toggle='popover' data-content='" . t('Have your order delivered to you by @provider', array('@provider' => $agreement->field_dispatch_provider[LANGUAGE_NONE][0]['value']))."'>";
                            print '<span class="sprite sprite-delivery-mail"></span>';
                            print '<small class="text-muted">' . node_type_get_name('dispatch_agreement') . ' <span class="fa fa-info-circle"></span><br>ab</small> ';
                            print '<strong>' . number_format($agreement->field_minimum_order_value[LANGUAGE_NONE][0]['value'], 2, ",", ".").'€'.'</strong>';
                            print '</a>';
                            print "</div>";
                            }
                        }
                        ?>
                    <?php else: ?>
                        <?php  
                            print '<div class="delivery-option inactive">';
                            print '<span class="sprite sprite-delivery-mail"></span>';
                            print '<small class="text-muted"> Postversand <br>';
                            print '<strong> derzeit nicht möglich</strong>';
                            print '</small> ';
                            print "</div>";
                         ?>
                    <?php endif; ?>

                        
                    </div>
                </div>
                
                


            </div>
            <div class="row product-grid-row">
            <div class="product-grid-container">
            <h3>Produkte </h3>
                <ul class="product-grid clearfix"> 
                    <?php foreach($node->offers as $offer): ?>
                        <?php foreach($offer->offer_variations as $variation): ?>
                        <?php $hasImage = (empty($variation->field_image[LANGUAGE_NONE][0]['uri'])) ? false : true; ?>
                            <li class="grid-item">
                                <div class="product-item"> 
                                    <!-- <div class="product-image <?php if(!$hasImage) { print "no-image";} ?>">
                                        <a href="#" data-toggle="modal" data-target="#variationModal<?php print $variation->nid; ?>">
                                        <?php if($hasImage): ?>
                                           <img src="<?php print image_style_url('product_grid', $variation->field_image[LANGUAGE_NONE][0]['uri']); ?>">
                                         
                                         <?php else: ?>
                                            <img src="<?php echo base_path() . path_to_theme();?>/images/no-image.png">
                
                                        <?php  endif; ?>
                                        </a> 
                                    </div> -->
                                     
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
        </div>
    </div>  

    <div id="flexfix-sidebar" class="flexfix-sidebar">
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
                                <br>
                                <br>
                                <small>
                                <strong>Bestellfrist:</strong> Bitte bestellen Sie bis
                                <?php
                                    $next_possible_delivery_dates = rm_shop_get_next_possible_deliverydate($variation->nid, $zipcode, $node->uid, $user->uid);
                                    $npddkeys = array_keys($next_possible_delivery_dates);
                                    $deliverytomorrow = FALSE;
                                ?>
                                <?php if(date('Ymd') == date('Ymd', $next_possible_delivery_dates[$npddkeys[0]]['deadline'])): ?>
                                    <strong>heute
                                <?php elseif(date('Ymd', $next_possible_delivery_dates[$npddkeys[0]]['deadline']) - date('Ymd') == 1): ?>
                                    </strong>morgen
                                <?php else: ?>
                                    <strong>zum <?php print t(date('l', $next_possible_delivery_dates[$npddkeys[0]]['deadline'])); ?>, <?php print date('d.m.Y', $next_possible_delivery_dates[$npddkeys[0]]['deadline']); ?>
                                <?php endif; ?>
                                <?php print date('H:i', $next_possible_delivery_dates[$npddkeys[0]]['deadline']); ?></strong>
                                <?php $npddcount = count($next_possible_delivery_dates); ?>
                                <?php $counter = 1; ?>
                                <?php if($npddcount > 1): ?>
                                    <?php foreach($next_possible_delivery_dates as $npddtype => $next_possible_delivery_date): ?>
                                        für eine <?php print node_type_get_name($npddtype); ?> am
                                        
                                        <?php print t(date('l', $next_possible_delivery_date['begin_time'])); ?> den <?php print date('d.m.Y', $next_possible_delivery_date['begin_time']); ?> zwischen <?php print date('H:i', $next_possible_delivery_date['begin_time']); ?> und <?php print date('H:i', $next_possible_delivery_date['end_time']); ?> Uhr
                                        
                                        <?php if($counter < $npddcount): ?> oder <?php endif; ?>
                                        <?php $counter++; ?>
                                    <?php endforeach; ?>.
                                    
                                <?php else: ?>
                                    <?php $next_possible_delivery_date = $next_possible_delivery_dates[$npddkeys[0]]; ?>
                                    für eine <?php print node_type_get_name($npddkeys[0]); ?> am
                                    
                                    <?php print t(date('l', $next_possible_delivery_date['begin_time'])); ?> den <?php print date('d.m.Y', $next_possible_delivery_date['begin_time']); ?> zwischen <?php print date('H:i', $next_possible_delivery_date['begin_time']); ?> und <?php print date('H:i', $next_possible_delivery_date['end_time']); ?> Uhr.
                                    
                                <?php endif; ?>
                                <br>                                
                                <br>
                                Bitte entnehmen Sie weitere Informationen zu den genauen Zeiten und Gebieten der Informationsleiste direkt unterhalb der Anbieterbeschreibung.
                                </small>                     
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
                      
    
    
 


