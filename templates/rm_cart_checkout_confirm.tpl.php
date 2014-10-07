<?php
$form = $variables['form'];
$order_items = rm_cart_get_order($form['order']['order_number']['#value']);
$netto_total = 0;
$vat_total = 0;
$deposit_total = 0;

$order_items_keys = array_keys($order_items);
$order_item = $order_items[$order_items_keys[0]];

$deliverytype_field = field_info_field('field_deliverytype');
$deliverytype_allowed_values = list_allowed_values($deliverytype_field);
$delivery_type = $deliverytype_allowed_values[$order_item->field_deliverytype[LANGUAGE_NONE][0]['value']];

if($order_item->field_deliverytype[LANGUAGE_NONE][0]['value'] == 'pickup_agreement') {
    $pickup_agreement = node_load($order_item->field_pickup_agreement_ref[LANGUAGE_NONE][0]['target_id']);
    $pickup_spot_street = $pickup_agreement->field_address[LANGUAGE_NONE][0]['thoroughfare'];
    $pickup_spot_zip = $pickup_agreement->field_address[LANGUAGE_NONE][0]['postal_code'];
    $pickup_spot_locality = $pickup_agreement->field_address[LANGUAGE_NONE][0]['locality'];
}

$deliverydate = t(date('l', $order_item->field_delivery_range_from[LANGUAGE_NONE][0]['value'])).' '.date('d.m.Y', $order_item->field_delivery_range_from[LANGUAGE_NONE][0]['value']);
$deliverytime = date('H:i', $order_item->field_delivery_range_from[LANGUAGE_NONE][0]['value']) . ' - ' . date('H:i', $order_item->field_delivery_range_to[LANGUAGE_NONE][0]['value']);


$billing_address_name = $order_item->field_billingaddress[LANGUAGE_NONE][0]['name_line'];
$billing_address_street = $order_item->field_billingaddress[LANGUAGE_NONE][0]['thoroughfare'];
$billing_address_zip = $order_item->field_billingaddress[LANGUAGE_NONE][0]['postal_code'];
$billing_address_city = $order_item->field_billingaddress[LANGUAGE_NONE][0]['locality'];

$shipping_address_name = $order_item->field_address[LANGUAGE_NONE][0]['name_line'];
$shipping_address_street = $order_item->field_address[LANGUAGE_NONE][0]['thoroughfare'];
$shipping_address_zip = $order_item->field_address[LANGUAGE_NONE][0]['postal_code'];
$shipping_address_city = $order_item->field_address[LANGUAGE_NONE][0]['locality'];

$paymenttype_field = field_info_field('field_paymenttype');
$paymenttype_allowed_values = list_allowed_values($paymenttype_field);
$payment_type = $paymenttype_allowed_values[$order_item->field_paymenttype[LANGUAGE_NONE][0]['value']];

/*
Lieferart: $delivery_type
Liefer-/Abholzeit: $deliverytime
Bezahlart: $payment_type

NUR WENN Lieferart = Selbstabholung
Straße Abholspot: $pickup_spot_street
PLZ Abholspot: $pickup_spot_zip
Ort Abholspot: $pickup_spot_locality

Rechnungsadresse Name: $billing_address_name
Rechnungsadresse Straße: $billing_address_street
Rechnungsadresse PLZ: $billing_address_zip
Rechnungsadresse Ort: $billing_address_city

NUR WENN Lieferart = Lieferung
Lieferadresse Name: $shipping_address_name
Lieferadresse Straße: $shipping_address_street
Lieferadresse PLZ: $shipping_address_zip
Lieferadresse Ort: $shipping_address_city

*/

?>

 
<div class="row">
    <div class="col-md-3 sidebar">
        <div class="row ">
            <div class="col-md-12">
                <div class="wrapper"> 
                <h5> <strong>  Ihre Rechnungsadresse </strong></h5> 
                   <?php print $billing_address_name; ?><br>
                    <?php print $billing_address_street; ?> <br>
                    <?php print $billing_address_zip; ?> <?php print $billing_address_city; ?>
                </div>
            </div>
        </div>
        
        
        <?php if ($delivery_type == 'Lieferung'): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="wrapper"> 
                    <h5> <strong>  Ihre Lieferadresse </strong></h5> 
                       <?php print $shipping_address_name; ?><br>
                        <?php print $shipping_address_street; ?> <br>
                        <?php print $shipping_address_zip; ?> <?php print $shipping_address_city; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="row">
            <div class="col-md-12">
                <div class="wrapper"> 
                     <h5> <strong>  Zahlungsart </strong></h5> 
                    <?php print $payment_type; ?> 
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <table class="table products">
            <thead>
                <tr>
                    <th>Produkt</th>
                    <th>Anzahl</th>
                    <th class="text-right">Gesamt</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($order_items as $order_item): ?>
                    <?php
                        $order_item_title = $order_item->title;
                        $order_item_amount = $order_item->field_order_amount[LANGUAGE_NONE][0]['value'];
                        $order_item_total = $order_item_amount * $order_item->field_tu_price[LANGUAGE_NONE][0]['value'];
                        $order_item_vat = $order_item_amount * $order_item->field_tu_price[LANGUAGE_NONE][0]['value'] * $order_item->field_tu_vat[LANGUAGE_NONE][0]['value'] / 100;
                        $order_item_deposit = 0;
                        if(!empty($order_item->field_tu_deposit[LANGUAGE_NONE][0]['value'])) {
                            $order_item_deposit = $order_item->field_tu_deposit[LANGUAGE_NONE][0]['value'];
                        }
                    ?>
                    <tr>
                        <td><?php print $order_item_title; ?></td>
                        <td><?php print $order_item_amount; ?></td>
                        <td class="text-right"><?php print number_format($order_item_total, 2, ",", "."); ?>€</td>
                    </tr>
                    <?php
                        //Addups
                        $netto_total += $order_item_total;
                        $vat_total += $order_item_vat;
                        $deposit_total += $order_item_deposit;
                    ?>
                    <?php endforeach; ?>
                    
            </tbody>
        </table>
        
        <div class="delivery-breakdown">  
            <!--<div class="delivery-option">
                <?php if ($delivery_type == 'Selbstabholung'): ?>
                    <div class="row">
                        <div class="col-xs-3">
                              <strong>Selbstabholung</strong>
                        </div>
                        <div class="col-xs-3">
                            <?php print $pickup_spot_street;?><br>
                            <?php print $pickup_spot_zip;?>
                            <?php print $pickup_spot_locality;?>
                        </div>
                        <div class="col-xs-3">
                            <span class="fa fa-calendar fa-fw"></span> <?php print $deliverydate; ?> <br>
                            <span class="fa fa-clock-o fa-fw"></span> <?php print $deliverytime; ?>
                        </div>
                        <div class="col-xs-3 text-right">
                            10,45 €
                        </div>
                    </div>
                <?php elseif ($delivery_type == 'Lieferung'): ?>
                    <div class="row">
                        <div class="col-xs-3">
                              <strong>Lieferung</strong>
                        </div>
                         
                        <div class="col-xs-3">
                            <span class="fa fa-calendar fa-fw"></span> <?php print $deliverydate; ?> <br>
                            <span class="fa fa-clock-o fa-fw"></span> <?php print $deliverytime; ?>
                        </div>
                        <div class="col-xs-6 text-right">
                            10,45 €
                        </div>
                    </div>
                <?php endif;?>
            </div>-->
            <div class="order-breakdown">
                <ul class="breakdown-items list-unstyled">
                    <li class="clearfix">
                        <span class="item-name">Summe</span>
                        <span class="item-amount"><?php print number_format($netto_total, 2, ",", "."); ?>€</span>
                    </li>
                    <li class="clearfix">
                        <span class="item-name">zzgl. MwSt.</span>
                        <span class="item-amount"><?php print number_format($vat_total, 2, ",", "."); ?>€</span>
                    </li>
                    <li class="clearfix">
                        <span class="item-name">Pfand</span>
                        <span class="item-amount"><?php print number_format($deposit_total, 2, ",", "."); ?>€</span>
                    </li>
                    <li class="clearfix">
                        <span class="item-name total">zu bezahlender Gesamtbetrag</span>
                        <span class="item-amount total"><?php print number_format($netto_total + $vat_total + $deposit_total, 2, ",", "."); ?>€</span>
                    </li>
                </ul>
            </div><!--end order breakdown-->
        </div><!--end delivery breakdown-->
                    
          
    </div><!-- end col-md-12 -->
</div> <!-- end row -->
          
<?php
print drupal_render_children($form);
?>


<?php /*($order_number, $order_status, $order_amount, $tu_price, $tu_vat, $billing_name, $billing_street, $billing_zip, $billing_city, $shipping_name, $shipping_street, $shipping_zip, $shipping_city, $payment_type, $iban, $description, $seller_reference, $uid = NULL)*/ ?>