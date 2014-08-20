<<<<<<< HEAD
<?php // var_dump($vars['cart']); ?>

<div id="cart" class="cart-wrapper">
   <div class="cart-header">
        <h1> Warenkorb</h1>
   </div>
    <div class="cart-content">
        e you feeling lucky punk this is my gun, clyde! you want a guarantee, buy a toaster. when a naked man's chasing a woman through an alley with a butcher knife and a hard-on, i figure he's not out collecting for the red cross. man's gotta know his limitations. ever notice how sometimes you come across somebody you shouldn't have f**ked with? well, i'm that guy. dyin' ain't much of a livin', boy. here. put that in your report!" and "i may have found a way out of here. what you have to ask yourself is, do i feel lucky. well do ya' punk? this is the ak-47 assault rifle, the preferred weapon of your enemy; and it makes a distinctive sound when fired at you, so remember it.
        what you have to ask yourself is, do i feel lucky. well do ya' punk? don't p!ss down my back and tell me it's raining.
    </div>
     <div class="cart-summary">
       <p>e you feeling lucky punk this is my gun, clyde! </p> 
        <button class="btn btn-success"> Bezahlen</button>
     </div>
</div>
=======
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
>>>>>>> a7e1443a9372c24561e10292ea5464d96756f244
