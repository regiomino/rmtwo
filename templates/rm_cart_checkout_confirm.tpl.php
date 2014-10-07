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

$deliverytime = t(date('l', $order_item->field_delivery_range_from[LANGUAGE_NONE][0]['value'])) . ', ' . date('d.m.Y H:i', $order_item->field_delivery_range_from[LANGUAGE_NONE][0]['value']) . ' - ' . date('H:i', $order_item->field_delivery_range_to[LANGUAGE_NONE][0]['value']);

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
<div class="flexfix-wrapper clearfix"> 
    <div class="flexfix-content">
        <div class="flexfix-content-inner">
            <?php if(!empty($order_items)): ?>
                <table class="table">
                    <tr>
                        <th>Produkt</th>
                        <th>Anzahl</th>
                        <th>Gesamt</th>
                    </tr>
                    <?php foreach($order_items as $order_item): ?>
                        <?php
                            $order_item_title = $order_item->title;
                            $order_item_amount = $order_item->field_order_amount[LANGUAGE_NONE][0]['value'];
                            $order_item_total = $order_item_amount * $order_item->field_tu_price[LANGUAGE_NONE][0]['value'];
                            $order_item_deposit =
                            $order_item_vat = $order_item_amount * $order_item->field_tu_price[LANGUAGE_NONE][0]['value'] * $order_item->field_tu_vat[LANGUAGE_NONE][0]['value'] / 100;
                            $order_item_deposit = 0;
                            if(!empty($order_item->field_tu_deposit[LANGUAGE_NONE][0]['value'])) {
                                $order_item_deposit = $order_item->field_tu_deposit[LANGUAGE_NONE][0]['value'];
                            }
                        ?>
                        <tr>
                            <td><?php print $order_item_title; ?></td>
                            <td><?php print $order_item_amount; ?></td>
                            <td><?php print number_format($order_item_total, 2, ",", "."); ?>€</td>
                        </tr>
                        <?php
                            //Addups
                            $netto_total += $order_item_total;
                            $vat_total += $order_item_vat;
                            $deposit_total += $order_item_deposit;
                        ?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="2">Summe</td><td><?php print number_format($netto_total, 2, ",", "."); ?>€</td>
                    </tr>
                    <tr>
                        <td colspan="2">zzgl. MwSt.</td><td><?php print number_format($vat_total, 2, ",", "."); ?>€</td>
                    </tr>
                    <tr>
                        <td colspan="2">Pfand</td><td><?php print number_format($deposit_total, 2, ",", "."); ?>€</td>
                    </tr>
                    <tr>
                        <td colspan="2">zu bezahlender Gesamtbetrag</td><td><?php print number_format($netto_total + $vat_total + $deposit_total, 2, ",", "."); ?>€</td>
                    </tr>
                </table>
            <?php endif; ?>
            <?php print render($form['submit']); ?>
        </div>
    </div>
</div>

<?php
print drupal_render_children($form);
?>


<?php /*($order_number, $order_status, $order_amount, $tu_price, $tu_vat, $billing_name, $billing_street, $billing_zip, $billing_city, $shipping_name, $shipping_street, $shipping_zip, $shipping_city, $payment_type, $iban, $description, $seller_reference, $uid = NULL)*/ ?>