 

<div id="cart" class="cart-wrapper">
   <div class="cart-header">
        <h1> Warenkorb</h1>
   </div>
    <div class="cart-content">
          <ul class="list-unstyled"> 
        <?php if(!empty($vars['cart'])): foreach($vars['cart'] as $cart_item): ?>
         <li> 
                <div class="input-group">
                    <select>
                        <?php
                            $variation = node_load($cart_item->field_offer_variation_reference[LANGUAGE_NONE][0]['target_id']);
                            $options = rm_cart_get_quantity_options($cart_item->field_offer_variation_reference[LANGUAGE_NONE][0]['target_id']);
                        ?>
                        <?php if(!empty($options)): foreach($options as $option): ?>
                            <option value="<?php print $option;?>"<?php if($option == $cart_item->field_quantity[LANGUAGE_NONE][0]['value']): ?> selected<?php endif; ?>><?php print $option;?> &times; <?php print $variation->field_productunit[LANGUAGE_NONE][0]['first']; ?><?php print t($variation->field_productunit[LANGUAGE_NONE][0]['second']); ?></option>
                        <?php endforeach; endif; ?>
                    </select> 
                    <?php print l(t('delete'), 'removefromcart/' . $cart_item->nid, array('query' => drupal_get_destination(), 'attributes' => array('class' => array('cart-remove-link')))); ?>
                </div>
             
                <?php print node_load($cart_item->field_offer_variation_reference[LANGUAGE_NONE][0]['target_id'])->title; ?>
           
            
                <?php print number_format(rm_cart_get_item_total($cart_item->nid), 2, ",", "."); ?>€
            
        </li>
        <?php endforeach; endif; ?>
    </ul>
    </div>
     <div class="cart-summary">
       <p> Gesamt<?php print number_format(rm_cart_get_cart_total(), 2, ",", "."); ?>€</p>
       <p><?php print number_format(rm_cart_get_cart_vat(), 2, ",", "."); ?>€</p>
        <?php print l(t('Purchase now'), 'checkout', array('external' => TRUE, 'attributes' => array('class' => array('btn', 'btn-primary', 'btn-lg', 'pull-right')))); ?>
     </div>
</div>
 
