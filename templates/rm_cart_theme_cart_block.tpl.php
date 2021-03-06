<?php
    $tupackaging = list_allowed_values(field_info_field('field_tu_packaging'));
    $packaging_field = field_info_field('field_tu_packaging');
    $packaging_instance = field_info_instance('node', 'field_tu_packaging', 'trading_unit');
    $suid = $vars['suid'];
    $zipcode = NULL;
    if(isset($_SESSION['regionselect']['zip'])) $zipcode = $_SESSION['regionselect']['zip'];
    $minimum_order_values = array();
    $minimum_order_values = rm_cart_get_minimum_order_values($suid, $zipcode);
    if(empty($vars['cart'])):
        $emptycart = true;
    else :
        $emptycart = false;
    endif;
    
?>

<div id="cart" class="cart-wrapper">

   <!-- <div class="cart-header" id="cart-header">
        <h3><span class="fa fa-shopping-cart"> </span> Warenkorb</h3>
   </div> -->
    <div class="cart-content" id="cart-content">
 <h3 class="hidden-md hidden-lg"> Ihr Warenkorb </h3>
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

            $id = $offer->nid.$variation->vid;
        ?>
        <div class="cart-item" data-id= "<? print $id;?>" data-offerid="<?php print $offer->nid; ?>" data-variation="<?php print $variation->vid; ?>" data-tradingunit="<?php print $cart_item->field_trading_unit_reference[LANGUAGE_NONE][0]['target_id'];   ?>" >
            <div class="row">
                <div class="col-md-5 col-sm-3 col-xs-5">
                    <div class="input-group stepper">
                        <span class="input-group-btn">
                            <button class="btn btn-default stepper-control stepper-minus" data-operation = "-1" ><span class="fa fa-minus"></span></button>
                        </span>
                        <?php if ($cart_item->field_quantity[LANGUAGE_NONE][0]['value'] ==  $cart_item_max) :
                            $max_items = true;
                            endif;?>
                            
                        <input  type="number" value="<?php print $cart_item->field_quantity[LANGUAGE_NONE][0]['value'] ?>" class="form-control stepper-qty" max="<?php print $cart_item_max; ?>">
                        <span class="input-group-btn">
                            <button <?php if ($max_items): print 'disabled="true"'; endif; ?> class="btn btn-default stepper-control stepper-plus" data-operation = "1" ><span class="fa fa-plus"></span></button>
                        </span>
                    </div>
                    <a href="<?php print $cart_item->nid ?>" class="delete-item text-muted"><small> <span class="fa fa-trash"></span> Löschen</small> </a>
                </div>
                <div class="col-md-7 col-sm-9 col-xs-7">
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
            <div class="center-block cart-animation empty-cart-icon"> <span class="fa fa-shopping-cart"></span> </div>
            <p class="text-center">Ihr Warenkorb ist leer. </p>
        </div>
        
        <?php endif; ?>
    </div><!--end cart-content-->
    
    <div class="cart-summary <?php if($emptycart): print "empty"; endif; ?>" id="cart-summary">
        <p class="pre-sum text-muted"><small>Summe  <span class="pull-right"><?php print number_format(rm_cart_get_cart_total($suid), 2, ",", "."); ?>€ </span></small></p>
        <p class="pre-sum text-muted"><small>zzgl. MwSt.  <span class="pull-right"><?php print number_format(rm_cart_get_cart_vat($suid), 2, ",", "."); ?>€ </span></small></p>
        <p class="pre-sum last text-muted"><small>Pfand  <span class="pull-right"><?php print number_format(rm_cart_get_cart_deposit($suid), 2, ",", "."); ?>€ </span></small></p>
        <p class="sum"><strong>Gesamtbetrag</strong> <span class="pull-right"><strong> <?php print number_format(rm_cart_get_cart_total($suid) + rm_cart_get_cart_vat($suid) + rm_cart_get_cart_deposit($suid), 2, ",", "."); ?>€</strong> </p>
        
        <div class="minimum-order-values">
            <?php foreach($minimum_order_values as $type => $minimum_order_value): ?>
                <?php foreach($minimum_order_value as $movid => $value): ?>
                    <div class="alert <?php $cart_total = rm_cart_get_cart_total($suid); print ($cart_total >= $value) ? 'alert-success' : 'alert-danger'; ?>" role="alert"><span class="fa fa fa-<?php $cart_total = rm_cart_get_cart_total($suid); print ($cart_total >= $value) ? 'check' : 'remove'; ?>"></span> <?php print node_type_get_name($type); ?> <?php if($type == 'pickup_agreement') print node_load($movid)->field_address[LANGUAGE_NONE][0]['locality']; ?> ab <?php print number_format($value, 2, ",", "."); ?> € <strong class="pull-right"> <?php if($value - $cart_total> 0): ?>noch <?php print number_format($value - $cart_total, 2, ",", "."); ?>€<?php endif; ?></strong>
                    </div>
                <?php endforeach; ?> 
            <?php endforeach; ?> 
        </div>
      
       <?php print l(t('Go to checkout'), '/checkout/' . $suid, array('external' => TRUE, 'attributes' => array('class' => array('btn','btn-primary', 'btn-lg', 'center-block', 'disabled' => ($emptycart) ? 'disabled' : 'enabled')))); ?>
        
    </div>
   
</div>
 
