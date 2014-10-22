<?php foreach($vars['shops'] as $shop): ?>
<div class="col-xs-12 col-lg-6 col-seller-item" data-title="<?php print $shop->title; ?>"> 
        <a class="seller-item clearfix" data-id="<?php print $shop->nid; ?>" href="<?php print url('node/' . $shop->nid); ?>"> 
            <div class="media">
                <h4 class="title"> <?php print $shop->title; ?></h4>
                <img class="media-object pull-left img-circle" src="<?php print image_style_url('seller_thumb', $shop->field_image[LANGUAGE_NONE][0]['uri']); ?>" alt="<?php print $shop->                                  title; ?>">
                
                <div class="media-body">
                    <ul class="list-unstyled">
                        <li><span class="fa fa-cutlery" ></span>
                            <?php
                            $all_tids = array();
                            foreach($shop->field_sellercategories[LANGUAGE_NONE] as $index => $tid) {
                                $all_tids[] = (int)$tid['tid'];
                            }
    
                            $allterms = taxonomy_term_load_multiple($all_tids);
                            foreach($allterms as $term) {
                                print $term->name . ' ';
                            }
                            ?>
                        </li>
                        <li>
                            <span class="fa fa-map-marker"></span> <?php print $shop->field_address[LANGUAGE_NONE][0]['thoroughfare']; ?>, <?php print $shop->                                              field_address[LANGUAGE_NONE][0]['postal_code'] ?> <?php print $shop->field_address[LANGUAGE_NONE][0]['locality']; ?>
                        </li>
                    </ul>
                    
                    <div class="separator"> </div>
                    
                    <ul class="list-unstyled">
                    <?php if(!empty($shop->agreements)) {
                        print "<li><small class='text-muted'>  <span class='fa fa-truck'> </span> ";
                        foreach($shop->agreements as $type => $user_reference) {
                            foreach($user_reference as $target_id => $agreements) {
                                //if theres two variantes for the same agreement, then choose the one with less minimum order value
                                if(count($agreements) > 1) {
                                    usort($agreements, "rm_shop_sort_agreements_by_mov");
                                }
                                $agreement = $agreements[0];
                                switch($type) {
                                    case 'shipping_agreement':
                                        print "<span>" . node_type_get_name('shipping_agreement') . "</span> ";
                                        //print "<span data-toggle='popover' data-content='" . render(field_view_field('node', $agreement, 'field_regular_times')) . "'>" . t('Shipping from @mov', array('@mov' => number_format($agreement->field_minimum_order_value[LANGUAGE_NONE][0]['value'], 2, ",", ".") . ' €')) . "</span> ";
                                        break;
                                    case 'pickup_agreement':
                                        print "<span>" . node_type_get_name('pickup_agreement') . "</span> ";
                                        //print "<span data-toggle='popover' data-content='" . render(field_view_field('node', $agreement, 'field_regular_times')) . "'>" . t('Pickup from @mov', array('@mov' => number_format($agreement->field_minimum_order_value[LANGUAGE_NONE][0]['value'], 2, ",", ".") . ' €')) . "</span> ";
                                        break;
                                    case 'dispatch_agreement':
                                        print '<span>' . node_type_get_name('dispatch_agreement') . '</span> ';
                                        //print '<span data-toggle="popover" data-content="' . t('Have your order delivered to you by @provider', array('@provider' => $agreement->field_dispatch_provider[LANGUAGE_NONE][0]['value'])) . '">' . t('Dispatch from @mov', array('@mov' => number_format($agreement->field_minimum_order_value[LANGUAGE_NONE][0]['value'], 2, ",", ".") . ' €')) . '</span> ';
                                        break;
                                }
                            }
                    }
            
                    print "</small></li>";
                    print "<li>  <small class='text-muted'> <span class='fa fa-money'> </span>  ";
                    foreach($shop->agreements as $type => $user_reference) {
                        foreach($user_reference as $target_id => $index) {
                            foreach($index as $indexid => $agreement) {
                                switch($type) {
                                    case 'payment_agreement':
                                        foreach($agreement->field_payment_types[LANGUAGE_NONE] as $payment_type) {
                                            switch($payment_type['value']) {
                                                case 'prepaid':
                                                    print '<span>Vorkasse</span> ';
                                                    //print '<span   data-toggle="popover" data-content="' . t('Pay online during checkout via one of our payment providers') . '">Vorkasse</span> ';
                                                    break;
                                                case 'cash':
                                                    print '<span>Barzahlung</span> ';
                                                    //print '<span   data-toggle="popover" data-content="' . t('Pay cash when your order is delivered') . '">Barzahlung</span> ';
                                                    break;
                                                case 'invoice':
                                                    print '<span>Rechnung</span> ';
                                                    //print '<span data-toggle="popover" data-content="' . t('The vendor will send you an invoice after your order is complete') . '">Rechnung</span> ';
                                                    break;
                                            }
                                        }
                                        break;
                                }
                            }
                        }
                    }
                    print "</small></li>";
}
?>
                    </ul>
                </div><!-- end media body -->
            </div><!-- end media -->
            <span class="fa fa-chevron-right text-muted"> </span>
        </a>  <!-- end seller-item -->
</div> <!--end col-item-wrapper -->
<?php endforeach; ?>