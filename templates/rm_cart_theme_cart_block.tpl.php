<table class="table">
    <thead>
        <tr>
            <th>Anzahl</th>
            <th>Produkt</th>
            <th>Preis</th>
        </tr>
    </thead>
    <tbody style="font-size: smaller;">
        <?php if(!empty($vars['cart'])): foreach($vars['cart'] as $cart_item): ?>
        <tr>
            <td>
                <div class="input-group">
                    <select>
                        <?php
                            $variation = node_load($cart_item->field_offer_variation_reference[LANGUAGE_NONE][0]['target_id']);
                            $options = rm_cart_get_quantity_options($cart_item->field_offer_variation_reference[LANGUAGE_NONE][0]['target_id']);
                        ?>
                        <?php if(!empty($options)): foreach($options as $option): ?>
                            <option value="<?php print $option;?>"<?php if($option == $cart_item->field_quantity[LANGUAGE_NONE][0]['value']): ?> selected<?php endif; ?>><?php print $option;?> &times; <?php print $variation->field_productunit[LANGUAGE_NONE][0]['first']; ?><?php print t($variation->field_productunit[LANGUAGE_NONE][0]['second']); ?></option>
                        <?php endforeach; endif; ?>
                    </select><br />
                    <?php print l(t('delete'), 'removefromcart/' . $cart_item->nid, array('query' => drupal_get_destination(), 'attributes' => array('class' => array('cart-remove-link')))); ?>
                </div>
            </td>
            <td>
                <?php print node_load($cart_item->field_offer_variation_reference[LANGUAGE_NONE][0]['target_id'])->title; ?>
            </td>
            <td>
                <?php print number_format(rm_cart_get_item_total($cart_item->nid), 2, ",", "."); ?>€
            </td>
        </tr>
        <?php endforeach; endif; ?>
        <tr>
            <td></td>
            <td><strong><em>Gesamt</em></strong></td>
            <td><?php print number_format(rm_cart_get_cart_total(), 2, ",", "."); ?>€</td>
        </tr>
        <tr>
            <td></td>
            <td><em>zzgl. MwSt.</em></td>
            <td><?php print number_format(rm_cart_get_cart_vat(), 2, ",", "."); ?>€</td>
        </tr>
    </tbody>
</table>
<?php print l(t('Purchase now'), 'checkout', array('external' => TRUE, 'attributes' => array('class' => array('btn', 'btn-primary', 'btn-lg', 'pull-right')))); ?>