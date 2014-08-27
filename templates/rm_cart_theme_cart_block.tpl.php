<?php
    $tupackaging = list_allowed_values(field_info_field('field_tu_packaging'));
    $packaging_field = field_info_field('field_tu_packaging');
    $packaging_instance = field_info_instance('node', 'field_tu_packaging', 'trading_unit');
    $sellerprofile_id = arg(1);
    $minimum_order_values = array();
    if(isset($_SESSION['regionselect']['zip'])) $minimum_order_values = rm_cart_get_minimum_order_values(node_load($sellerprofile_id)->uid, $_SESSION['regionselect']['zip']);
    if(empty($vars['cart'])):
        $emptycart = true;
    else :
        $emptycart = false;
    endif;
    
?>

<div id="cart" class="cart-wrapper">
   <div class="cart-header" id="cart-header">
        <h3><span class="glyphicon glyphicon-shopping-cart"> </span> Warenkorb</h3>
   </div>
    <div class="cart-content" id="cart-content">

        <?php if(!empty($vars['cart'])): foreach($vars['cart'] as $cart_item): ?>
        <?php
            $offer = node_load($cart_item->field_offer_desc_reference[LANGUAGE_NONE][0]['target_id']);
            $variation = node_load($cart_item->field_offer_variation_reference[LANGUAGE_NONE][0]['target_id']);
            $tradingunit = node_load($cart_item->field_trading_unit_reference[LANGUAGE_NONE][0]['target_id']);
            $cart_item_max = rm_cart_item_get_max_amount($cart_item->nid);
            $item_total = number_format(rm_cart_get_item_total($cart_item->nid), 2, ",", ".");
            $unit_description = $tradingunit->field_tu_amount[LANGUAGE_NONE][0]['value'] . ' &times; ' . $variation->field_productunit[LANGUAGE_NONE][0]['first'] . t($variation->field_productunit[LANGUAGE_NONE][0]['second']);
            if(isset($tradingunit->field_tu_packaging[LANGUAGE_NONE][0]['value']) && !empty($tupackaging[$tradingunit->field_tu_packaging[LANGUAGE_NONE][0]['value']])) {
                $packaging = $tupackaging[$tradingunit->field_tu_packaging[LANGUAGE_NONE][0]['value']];
            }
            else {
                $default = field_get_default_value('node', $tradingunit, $packaging_field, $packaging_instance, $tradingunit->language);
                $packaging = $tupackaging[$default[0]['value']];
            }
            $max_items = false;
            
        ?>
        <div class="cart-item" data-offerid="<?php print $offer->nid; ?>" data-variation="<?php print $variation->vid; ?>" data-tradingunit="<?php print $cart_item->field_trading_unit_reference[LANGUAGE_NONE][0]['target_id'];   ?>" >
            <div class="row">
                <div class="col-xs-5">
                    <div class="input-group stepper ">
                        <span class="input-group-btn">
                            <button class="btn btn-default stepper-control stepper-minus" data-operation = "-1" ><span class="glyphicon glyphicon-minus"></span></button>
                        </span>
                        <?php if ($cart_item->field_quantity[LANGUAGE_NONE][0]['value'] ==  $cart_item_max) :
                            $max_items = true;
                            endif;
                        ?>
                        <input  type="number" value="<?php print $cart_item->field_quantity[LANGUAGE_NONE][0]['value'] ?>" class="form-control stepper-qty" max="<?php print $cart_item_max; ?>">
                        <span class="input-group-btn">
                            <button <?php if ($max_items): print 'disabled="true"'; endif; ?> class="btn btn-default stepper-control stepper-plus" data-operation = "1" ><span class="glyphicon glyphicon-plus"></span></button>
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
        <?php endforeach;
        
        else: ?>
        
        <div class="empty-cart ">
            <div class="center-block animation-target empty-cart-icon"> <span class="glyphicon glyphicon-shopping-cart"></span> </div>
            <p class="text-center">Ihr Warenkorb ist leer. </p>
        </div>
        
        <?php endif; ?>
        
        
    </div>
    <div class="cart-summary <?php if($emptycart): print "empty"; endif; ?>" id="cart-summary">
       <p class="pre-sum text-muted"><small>Summe  <span class="pull-right"><?php print number_format(rm_cart_get_cart_total(), 2, ",", "."); ?>€ </span></small></p>
       <p class="pre-sum last text-muted"><small>zzgl. MwSt.  <span class="pull-right"><?php print number_format(rm_cart_get_cart_vat(), 2, ",", "."); ?>€ </span></small></p>
      <p class="sum"><strong>Gesamtbetrag</strong> <span class="pull-right"><strong> <?php print number_format(rm_cart_get_cart_total() + rm_cart_get_cart_vat(), 2, ",", "."); ?>€</strong> </p>
      <div class="minimum-order-values">
          <div class="alert alert-success" role="alert"><span class="glyphicon glyphicon glyphicon-ok"></span> Selbstabholung ab 0,00 €</div>
          <div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-remove"></span> Lieferung ab 13,50 € <strong class="pull-right"> noch 2€</strong></div>
           <div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-remove"></span> Versand ab 13,50 € <strong class="pull-right"> noch 3,46€</strong></div>
      
        <!--<?php foreach($minimum_order_values as $type => $value): ?>
           <tr class="<?php $cart_total = rm_cart_get_cart_total(); print ($cart_total >= $value) ? 'mov_reached' : 'mov_not_reached'; ?>">
               <td><?php print node_type_get_name($type); ?></td>
               <td><?php print number_format($value, 2, ",", "."); ?>€</td>
           </tr>
        <?php endforeach; ?>-->
       
    </div>
      
       <?php if(!$emptycart):  
             print l(t('Purchase now'), 'checkout', array('external' => TRUE, 'attributes' => array('class' => array('btn','btn-primary', 'btn-lg', 'center-block'))));  
        
        else:
            print l(t('Purchase now'), 'checkout', array('external' => TRUE, 'attributes' => array('class' => array('btn','btn-primary', 'btn-lg', 'center-block'), 'disabled' => array('true'))));  
        endif; ?>
        
         
        
    </div>
   
</div>
 
