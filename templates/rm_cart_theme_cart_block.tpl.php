<?php
    $tupackaging = list_allowed_values(field_info_field('field_tu_packaging'));
    $packaging_field = field_info_field('field_tu_packaging');
    $packaging_instance = field_info_instance('node', 'field_tu_packaging', 'trading_unit');
?>

<div id="cart" class="cart-wrapper">
   <div class="cart-header">
        <h3><span class="glyphicon glyphicon-shopping-cart"> </span> Warenkorb</h3>
   </div>
    <div class="cart-content">

        <?php if(!empty($vars['cart'])): foreach($vars['cart'] as $cart_item): ?>
        <?php
       
            $tupackaging = list_allowed_values(field_info_field('field_tu_packaging'));
            $packaging_field = field_info_field('field_tu_packaging');
            $packaging_instance = field_info_instance('node', 'field_tu_packaging', 'trading_unit');
            $variation = node_load($cart_item->field_offer_variation_reference[LANGUAGE_NONE][0]['target_id']);
            $tradingunit = node_load($cart_item->field_trading_unit_reference[LANGUAGE_NONE][0]['target_id']);
            $options = rm_cart_get_quantity_options($cart_item->field_offer_variation_reference[LANGUAGE_NONE][0]['target_id']);
            $item_total = number_format(rm_cart_get_item_total($cart_item->nid), 2, ",", ".");
            $unit_description = $tradingunit->field_tu_amount[LANGUAGE_NONE][0]['value'] . ' &times; ' . $variation->field_productunit[LANGUAGE_NONE][0]['first'] . t($variation->field_productunit[LANGUAGE_NONE][0]['second']);
            if(isset($tradingunit->field_tu_packaging[LANGUAGE_NONE][0]['value']) && !empty($tupackaging[$tradingunit->field_tu_packaging[LANGUAGE_NONE][0]['value']])) {
                $packaging = $tupackaging[$tradingunit->field_tu_packaging[LANGUAGE_NONE][0]['value']];
            }
            else {
                $default = field_get_default_value('node', $tradingunit, $packaging_field, $packaging_instance, $tradingunit->language);
                $packaging = $tupackaging[$default[0]['value']];
            }
            
        ?>
        <div class="cart-item" data-offerid="<?php print $cart_item->nid; ?>" data-variation="<?php print $variation->vid; ?>" data-tradingunit="<?php print $cart_item->field_trading_unit_reference[LANGUAGE_NONE][0]['target_id'];   ?>" >
            <div class="row">
                <div class="col-xs-5">
                    <div class="input-group stepper ">
                        <span class="input-group-btn">
                            <button class="btn btn-default stepper-control stepper-minus" data-operation = "-1" ><span class="glyphicon glyphicon-minus"></span></button>
                        </span>
                        <input  type="number" value="<?php print $variation->field_productunit[LANGUAGE_NONE][0]['first'] ?>" class="form-control stepper-qty">
                        <span class="input-group-btn">
                            <button class="btn btn-default stepper-control stepper-plus" data-operation = "1" ><span class="glyphicon glyphicon-plus"></span></button>
                        </span>
                    </div>
                    <a href="<?php print $cart_item->nid ?>" class="delete-item text-muted"><small> <span class="glyphicon glyphicon-trash"></span> Löschen</small> </a>
                </div>
                <div class="col-xs-7">
                    <p class="product-title">  <?php print $variation->title; ?><br><span class="tradingunit text-muted"><small><?php print $packaging; ?> (<?php print $unit_description; ?>)</small></span>
                    
                    </p>
                    <p class="price text-right">
                        <strong><small><?php print $item_total; ?>€ </small> </strong>
                    </p>
                </div>
            </div>
        </div>
        <?php endforeach; endif; ?>
        
        
    </div>
     <div class="cart-summary">
        <p class="pre-sum text-muted">Summe  <span class="pull-right"><?php print number_format(rm_cart_get_cart_total(), 2, ",", "."); ?>€ </span></p>
        <p class="pre-sum text-muted">zzgl. MwSt.  <span class="pull-right"><?php print number_format(rm_cart_get_cart_vat(), 2, ",", "."); ?>€ </span></p>
       <p class="sum"><strong>Gesamtbetrag</strong> <span class="pull-right"><strong> <?php print number_format(rm_cart_get_cart_total() + rm_cart_get_cart_vat(), 2, ",", "."); ?>€</strong> </p>
        
        <?php print l(t('Purchase now'), 'checkout', array('external' => TRUE, 'attributes' => array('class' => array('btn', 'btn-primary', 'btn-lg', 'center-block')))); ?>
     </div>
</div>
 
