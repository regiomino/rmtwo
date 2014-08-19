<table class="table">
    <thead>
        <tr>
            <th>Anzahl</th>
            <th>Produkt</th>
            <th>Preis</th>
        </tr>
    </thead>
    <tbody style="font-size: smaller;">
        <?php foreach($vars['cart'] as $cart_item): ?>
        <tr>
            <td>
                <div class="input-group">
                    <select>
                        <option>6 x 7,5kg</option>
                        <option>12 x 7,5kg</option>
                        <option>18 x 7,5kg</option>
                        <option>24 x 7,5kg</option>
                        <option>30 x 7,5kg</option>
                    </select>
                    <?php print l(t('delete'), 'removefromcart/' . $cart_item->nid, array('query' => drupal_get_destination(), 'attributes' => array('class' => array('cart-remove-link')))); ?>
                </div>
            </td>
            <td>
                <?php print node_load($cart_item->field_offer_variation[LANGUAGE_NONE][0]['target_id'])->title; ?>
            </td>
            <td>
                <?php print number_format(node_load($cart_item->field_trading_unit[LANGUAGE_NONE][0]['target_id'])->field_tu_price[LANGUAGE_NONE][0]['value'], 2, ",", "."); ?>€
            </td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td></td>
            <td><em>zzgl. MwSt.</em></td>
            <td>101,34€</td>
        </tr>
        <tr>
            <td></td>
            <td><strong><em>Gesamt</em></strong></td>
            <td>250,00€</td>
        </tr>
    </tbody>
</table>
<?php print l(t('Purchase now'), 'checkout', array('external' => TRUE, 'attributes' => array('class' => array('btn', 'btn-primary', 'btn-lg', 'pull-right')))); ?>