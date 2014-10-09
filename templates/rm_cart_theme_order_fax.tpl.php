<p style="font-size: xx-large;"><strong>Bestellung <?php print $vars['order_number'] ; ?> bei <?php print $vars['shop']->title ; ?></strong></p>

<p style="font-size: x-large;"><?php print ($vars['delivery_type'] == 'pickup_agreement') ? 'Abholung' : 'Lieferung'; ?>: <?php print t(date('l', $vars['delivery_range_from'])) ; ?>, <?php print date('d.m.Y', $vars['delivery_range_from']) ; ?>, <?php print date('H:i', $vars['delivery_range_from']) ; ?> - <?php print date('H:i', $vars['delivery_range_to']) ; ?></p>

<p style="font-size: large;">Kunde: <?php print ($vars['user_gender'] == 'f') ? 'Frau' : 'Herr'; ?> <?php print $vars['user_first_name']; ?> <?php print $vars['user_last_name']; ?> (Kundennr.: <?php print $vars['user_number']; ?>)</p>

<?php if($vars['delivery_type'] == 'shipping_agreement'): ?><p style="font-size: large;">Lieferadresse: <br>
<?php print $vars['shipping_address']['name_line']; ?><br>
<?php print $vars['shipping_address']['thoroughfare']; ?><br>
<?php print $vars['shipping_address']['postal_code']; ?><?php print $vars['shipping_address']['locality']; ?></p><?php endif; ?>

<style>
    tr.rechnungsposheader th {
        border-bottom: 0.5px solid #000000;
        font-weight: bold;
        font-size: large;
    }
    tr.taxes th {
        border-top: 0.5px solid #92BF20;
        font-weight: bold;
    }
    tr.lastrow td {
        border-bottom: 0.5px solid #000000;
    }
    tr.summary td {
        font-weight: bold;
    }
    table.taxcalc {
        font-size: small;
    }
    td {
        font-size: large;
    }
    td.amountrow {
        width: 50px;
    }
    td.descrow {
        width: 350px;
    }
    th.amountrow {
        width: 50px;
    }
    th.descrow {
        width: 350px;
    }
</style>
<table cellpadding="4">
    <tr class="rechnungsposheader">
        <th class="amountrow">Anzahl</th><th class="descrow">Angebot</th>
    </tr>
               
               
    <?php if(!empty($vars['order_items'])): ?>
        <?php foreach($vars['order_items'] as $order_item): ?>
            <?php if($order_item->field_item_type[LANGUAGE_NONE][0]['value'] == 'product'): ?>
                <?php $netto = $order_item->field_order_amount[LANGUAGE_NONE][0]['value'] * $order_item->field_tu_price[LANGUAGE_NONE][0]['value']; ?>
                <tr>
                    <td class="amountrow">
                        <strong><?php print $order_item->field_order_amount[LANGUAGE_NONE][0]['value']; ?></strong>
                    </td>
                    
                    <td class="descrow">
                        <?php print $order_item->title; ?><br>
                        <em style="font-style:italic; font-size: 12px; "> <?php $packaging_allowed_values = list_allowed_values(field_info_field('field_tu_packaging')); print $packaging_allowed_values[$order_item->field_tu_packaging[LANGUAGE_NONE][0]['value']]; ?> (<?php print $order_item->field_tu_amount[LANGUAGE_NONE][0]['value']; ?> x <?php print $order_item->field_productunit[LANGUAGE_NONE][0]['first']; ?> <?php print t($order_item->field_productunit[LANGUAGE_NONE][0]['second']); ?>)</em>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
         
</table>