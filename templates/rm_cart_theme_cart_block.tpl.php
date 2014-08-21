 

<div id="cart" class="cart-wrapper">
   <div class="cart-header">
        <h3><span class="glyphicon glyphicon-shopping-cart"> </span> Warenkorb</h3>
   </div>
    <div class="cart-content">
        <div class="cart-item">
            <div class="row">
                <div class="col-xs-5">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class=" btn  btn-default"><span class="glyphicon glyphicon-plus"></span></button>
                        </span>
                        <input type="number" class="form-control">
                        <span class="input-group-btn">
                            <button class=" btn  btn-default"><span class="glyphicon glyphicon-minus"></span></button>
                        </span>
                    </div>
                </div>
                <div class="col-xs-7">
                    <p class="product-title"> <small> Fleischwurst für Currywurst extra lecker, schmeckt nicht wirklich lecker.
                    </small>
                    </p>
                    <p class="price text-right">
                        <strong><small>20,34 € </small> </strong>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="cart-item">
            <div class="row">
                <div class="col-xs-5">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class=" btn  btn-default"><span class="glyphicon glyphicon-plus"></span></button>
                        </span>
                        <input type="number" class="form-control">
                        <span class="input-group-btn">
                            <button class=" btn  btn-default"><span class="glyphicon glyphicon-minus"></span></button>
                        </span>
                    </div>
                </div>
                <div class="col-xs-7">
                    <p class="product-title"> <small> Truthahn, gefüllt mir Würstchen
                    </small>
                    </p>
                    <p class="price text-right">
                        <strong><small>2000,34 € </small> </strong>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="cart-item">
            <div class="row">
                <div class="col-xs-5">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class=" btn  btn-default"><span class="glyphicon glyphicon-plus"></span></button>
                        </span>
                        <input type="number" class="form-control">
                        <span class="input-group-btn">
                            <button class=" btn  btn-default"><span class="glyphicon glyphicon-minus"></span></button>
                        </span>
                    </div>
                </div>
                <div class="col-xs-7">
                    <p class="product-title"> <small> Truthahn, gefüllt mir Würstchen
                    </small>
                    </p>
                    <p class="price text-right">
                        <strong><small>2000,34 € </small> </strong>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="cart-item">
            <div class="row">
                <div class="col-xs-5">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class=" btn  btn-default"><span class="glyphicon glyphicon-plus"></span></button>
                        </span>
                        <input type="number" class="form-control">
                        <span class="input-group-btn">
                            <button class=" btn  btn-default"><span class="glyphicon glyphicon-minus"></span></button>
                        </span>
                    </div>
                </div>
                <div class="col-xs-7">
                    <p class="product-title"> <small> Truthahn, gefüllt mir Würstchen
                    </small>
                    </p>
                    <p class="price text-right">
                        <strong><small>2000,34 € </small> </strong>
                    </p>
                </div>
            </div>
        </div>
        
        <!--
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
    </ul>-->
    </div>
     <div class="cart-summary">
        <p class="pre-sum text-muted">Zwischensumme  <span class="pull-right"><?php print number_format(rm_cart_get_cart_total(), 2, ",", "."); ?>€ </span></p>
       <p class="sum"><strong>Gesamtbetrag</strong> <span class="pull-right"><strong> <?php print number_format(rm_cart_get_cart_total(), 2, ",", "."); ?>€</strong> </p>
        
        <?php print l(t('Purchase now'), 'checkout', array('external' => TRUE, 'attributes' => array('class' => array('btn', 'btn-primary', 'btn-lg', 'center-block')))); ?>
     </div>
</div>
 
