<?php
$form = $variables['form'];
$order_items = rm_cart_get_order($form['order']['order_number']['#value']);
$netto_total = 0;
$vat_total = 0;
$deposit_total = 0;
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