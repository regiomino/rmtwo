<div class="row">

    <h1 class="page-header"><?php print t('Your orders'); ?></h1>
    
    <?php if(empty($vars['orders'])): ?>
    
        <div class="alert alert-danger" role="alert"><?php print t('You currently have no orders.'); ?></div>
        
    <?php else: ?>
        <?php
            $orders = $vars['orders'];
        ?>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th><?php print t('Date'); ?></th>
                    <th><?php print t('Order number'); ?></th>
                    <th><?php print t('Customer'); ?></th>
                    <th><?php print t('Products'); ?></th>
                    <th><?php print t('Delivery type'); ?></th>
                    <th><?php print t('Payment type'); ?></th>
                    <th><?php print t('Status'); ?></th>
                    <th><?php print t('Actions'); ?></th>
                </tr>
                <?php $order_number = NULL; ?>
                <?php foreach($orders as $order_number => $order): ?>
                    <tr>
                        <td><?php print $order['date']; ?></td>
                        <td><?php print $order_number; ?></td>
                        <td><?php print (!empty($order['customerprofile'])) ? $order['customerprofile']->title : $order['userobject']->field_first_name[LANGUAGE_NONE][0]['value'] . ' ' . $order['userobject']->field_last_name[LANGUAGE_NONE][0]['value']; ?></td>
                        <td><?php foreach($order['products'] as $product): ?><?php print $product['title']; ?>, <?php endforeach; ?></td>
                        <td><?php print $order['deliverytype']; ?><br><?php print $order['deliveryrange']; ?></td>
                        <td><?php print $order['paymenttype']; ?></td>
                        <td><?php print $order['status']; ?></td>
                        <td>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#orderModal<?php print $order_number; ?>">
                                <span class="fa fa-search"></span> Details
                            </button>
                                            
                            <div class="modal fade" id="orderModal<?php print $order_number; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h3 class="modal-title text-center" id="suggestModalLabel"><?php print t('Order @number', array('@number' => $order_number)); ?></h3>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <table class="table">
                                                <?php if(!empty($order['order_items'])): ?>
                                                    <?php $netto = 0; ?>
                                                    <?php $nettoaddup = 0; ?>
                                                    <?php $vataddup = 0; ?>
                                                    <?php $depositaddup = 0; ?>
                                                    <?php foreach($order['order_items'] as $order_item): ?>
                                                        <?php $vars['payment_type'] = $order_item->field_paymenttype[LANGUAGE_NONE][0]['value']; ?>
                                                        <?php $vars['billing_address'] = $order_item->field_billingaddress[LANGUAGE_NONE][0]; ?>
                                                        <?php $vars['shipping_address'] = $order_item->field_address[LANGUAGE_NONE][0]; ?>
                                                        <?php $vars['delivery_type'] = $order_item->field_deliverytype[LANGUAGE_NONE][0]['value']; ?>
                                                        <?php $vars['delivery_range_from'] = $order_item->field_delivery_range_from[LANGUAGE_NONE][0]['value']; ?>
                                                        <?php $vars['delivery_range_to'] = $order_item->field_delivery_range_to[LANGUAGE_NONE][0]['value']; ?>
                                                        <?php $vars['pickup_agreement'] = node_load($order_item->field_pickup_agreement_ref[LANGUAGE_NONE][0]['target_id']); ?>
                                                        <?php if($order_item->field_item_type[LANGUAGE_NONE][0]['value'] == 'product'): ?>
                                                            <?php $netto = $order_item->field_order_amount[LANGUAGE_NONE][0]['value'] * $order_item->field_tu_price[LANGUAGE_NONE][0]['value']; ?>
                                                            <?php $nettoaddup += $netto; ?>
                                                            <?php $vat = $netto / 100 * $order_item->field_tu_vat[LANGUAGE_NONE][0]['value']; ?>
                                                            <?php $vataddup += $vat; ?>
                                                            <?php $depositaddup += $order_item->field_tu_deposit[LANGUAGE_NONE][0]['value']; ?>
                                                            <tr>
                                                                <td align="left" border valign="top" style="padding-top:7px; padding-bottom:3px;">
                                                                    <?php print $order_item->field_order_amount[LANGUAGE_NONE][0]['value']; ?>
                                                                </td>
                                                                
                                                                <td align="left" valign="top"  style="padding-top:7px; padding-bottom:3px;">
                                                                    <?php print $order_item->title; ?><br>
                                                                    <em style="font-style:italic; font-size: 12px; "> <?php $packaging_allowed_values = list_allowed_values(field_info_field('field_tu_packaging')); print $packaging_allowed_values[$order_item->field_tu_packaging[LANGUAGE_NONE][0]['value']]; ?> (<?php print $order_item->field_tu_amount[LANGUAGE_NONE][0]['value']; ?> x <?php print $order_item->field_productunit[LANGUAGE_NONE][0]['first']; ?> <?php print t($order_item->field_productunit[LANGUAGE_NONE][0]['second']); ?>)</em>
                                                                </td>
                                                                <td align="right" valign="top" style="padding-top:5px; padding-bottom:5px;">
                                                                    <?php print number_format($netto, 2, ",", "."); ?>€
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                    
                                                    <?php $payablesurcharge = FALSE; ?>
                                                    <?php foreach($order['order_items'] as $order_item): ?>
                                                        <?php if($order_item->field_item_type[LANGUAGE_NONE][0]['value'] == 'surcharge'): ?>
                                                            <?php $payablesurcharge = TRUE; ?>
                                                            <?php $netto = $order_item->field_order_amount[LANGUAGE_NONE][0]['value'] * $order_item->field_tu_price[LANGUAGE_NONE][0]['value']; ?>
                                                            <?php $nettoaddup += $netto; ?>
                                                            <?php $vat = $netto / 100 * $order_item->field_tu_vat[LANGUAGE_NONE][0]['value']; ?>
                                                            <?php $vataddup += $vat; ?>
                                                            <tr>
                                                                <td align="left" colspan="2" valign="top" style="border-top: 1px solid #ddd;padding-top:5px; padding-bottom:5px;">
                                                                    Lieferart: <strong> <?php $deliverytype_allowed_values = list_allowed_values(field_info_field('field_deliverytype')); print $deliverytype_allowed_values[$vars['delivery_type']]; ?></strong><br>
                                                                    <?php print t(date('l', $vars['delivery_range_from'])); ?>, <?php print date('d.m.Y H:i', $vars['delivery_range_from']); ?> - <?php print date('H:i', $vars['delivery_range_to']); ?>
                                                                    <?php if($vars['delivery_type'] == 'pickup_agreement'): ?>
                                                                        <br>
                                                                        <?php print $vars['pickup_agreement']->field_address[LANGUAGE_NONE][0]['thoroughfare']; ?><br>
                                                                        <?php print $vars['pickup_agreement']->field_address[LANGUAGE_NONE][0]['postal_code']; ?>
                                                                        <?php print $vars['pickup_agreement']->field_address[LANGUAGE_NONE][0]['locality']; ?>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td align="right" valign="top" style="padding-top:5px; border-top: 1px solid #ddd; padding-bottom:5px;"  >
                                                                    <?php print number_format($netto, 2, ",", "."); ?>€
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                    <?php if(!$payablesurcharge): ?>
                                                        <tr>
                                                            <td align="left" colspan="2" valign="top" style="border-top: 1px solid #ddd;padding-top:5px; padding-bottom:5px;">
                                                                Lieferart: <strong> <?php $deliverytype_allowed_values = list_allowed_values(field_info_field('field_deliverytype')); print $deliverytype_allowed_values[$vars['delivery_type']]; ?></strong><br>
                                                                <?php print t(date('l', $vars['delivery_range_from'])); ?>, <?php print date('d.m.Y H:i', $vars['delivery_range_from']); ?> - <?php print date('H:i', $vars['delivery_range_to']); ?>
                                                                <?php if($vars['delivery_type'] == 'pickup_agreement'): ?>
                                                                    <br>
                                                                    <?php print $vars['pickup_agreement']->field_address[LANGUAGE_NONE][0]['thoroughfare']; ?><br>
                                                                    <?php print $vars['pickup_agreement']->field_address[LANGUAGE_NONE][0]['postal_code']; ?>
                                                                    <?php print $vars['pickup_agreement']->field_address[LANGUAGE_NONE][0]['locality']; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td align="right" valign="top" style="padding-top:5px; border-top: 1px solid #ddd; padding-bottom:5px;"  >
                                                                <?php print number_format(0, 2, ",", "."); ?>€
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                
                                                
                                                 
                                                 <!--breakdown -->
                                                <tr>
                                                    <td align="right" colspan="2" valign="top" style="border-top: 1px solid #000; background-color: #F3F3F3; padding-top:3px; padding-bottom:3px;">
                                                        Summe<br>
                                                    </td>
                                                    <td align="right" width="80" valign="top" style="padding-top:3px; background-color: #F3F3F3; border-top: 1px solid #000; padding-bottom:3px;">
                                                        <?php print number_format($nettoaddup, 2, ",", "."); ?>€
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="right" colspan="2" valign="top" style="padding-top:3px; background-color: #F3F3F3; padding-bottom:3px;">
                                                       zzgl. MwSt.<br>
                                                    </td>
                                                    <td align="right" width="80" valign="top" style="padding-top:3px; background-color: #F3F3F3;  padding-bottom:3px;">
                                                       <?php print number_format($vataddup, 2, ",", "."); ?>€
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <td align="right" colspan="2" valign="top" style="padding-top:3px; background-color: #F3F3F3; padding-bottom:3px;">
                                                       Pfand<br>
                                                    </td>
                                                    <td align="right" width="80" valign="top" style="padding-top:3px; background-color: #F3F3F3; padding-bottom:3px;">
                                                       <?php print number_format($depositaddup, 2, ",", "."); ?>€
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <td align="right" colspan="2" valign="top" style="padding-top:3px; border-bottom: 1px solid #000; background-color: #F3F3F3; padding-bottom:3px;">
                                                       <strong> Gesamtsumme </strong><br>
                                                    </td>
                                                    <td align="right" width="80" valign="top" style="padding-top:3px; border-bottom: 1px solid #000; background-color: #F3F3F3;  padding-bottom:3px;">
                                                      <strong><?php print number_format($nettoaddup + $vataddup + $depositaddup, 2, ",", "."); ?>€</strong>
                                                    </td>
                                                </tr>
                                            </table>

                                            <div style="padding-top:15px">  <strong>Gewählte Zahlungsart:</strong></div>
                                            
                                            <?php $paymenttype_allowed_values = list_allowed_values(field_info_field('field_paymenttype')); print $paymenttype_allowed_values[$vars['payment_type']]; ?>
                                            
                                            <br>
                                            <br>
                                               
                                            <strong>Rechnungsanschrift:</strong> 
                                            <br>
                                                <?php print $vars['billing_address']['name_line']; ?> <br>
                                                <?php print $vars['billing_address']['thoroughfare']; ?> <br>
                                                <?php print $vars['billing_address']['postal_code']; ?>  <?php print $vars['billing_address']['locality']; ?>
                                            <br>
                                            <br>
                                                
                                            <?php if($vars['delivery_type'] == 'shipping_agreement'): ?>
                                                <strong>Lieferanschrift:</strong> 
                                                <br>
                                                    <?php print $vars['shipping_address']['name_line']; ?> <br>
                                                    <?php print $vars['shipping_address']['thoroughfare']; ?> <br>
                                                    <?php print $vars['shipping_address']['postal_code']; ?>  <?php print $vars['shipping_address']['locality']; ?>
                                                <br>
                                                <br>
                                            <?php endif;?>
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endif; ?>
</div>