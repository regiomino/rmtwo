<?php
$form = $variables['form'];
?>
<div class="flexfix-wrapper clearfix"> 
    <div class="flexfix-content">
        <div class="flexfix-content-inner">
        
            <h2>Lieferung</h2>
            
            <!--Lieferart-->
            <?php print render($form['checkout']['delivery_fs']['delivery']); ?>
            
            <!--Abholspots-->
            <?php print render($form['checkout']['delivery_fs']['pickup_spots']); ?>
            
            <!--Abholtage-->
            <?php if(!empty($form['checkout']['delivery_fs']['pickup_days'])): ?>
                <?php foreach($form['checkout']['delivery_fs']['pickup_days'] as $pickupdaykey => $pickupdays): ?>
                    <?php $tmp = explode('pickup_day_', $pickupdaykey); ?>
                    <?php if(isset($tmp[1])): ?>
                        <?php print render($form['checkout']['delivery_fs']['pickup_days'][$pickupdaykey]); ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            
            <!--Abholzeiten-->
            <?php if(!empty($form['checkout']['delivery_fs']['pickup_times'])): ?>
                <?php foreach($form['checkout']['delivery_fs']['pickup_times'] as $pickupdaykey => $pickupdays): ?>
                    <?php $tmp = explode('pickup_time_', $pickupdaykey); ?>
                    <?php if(isset($tmp[1])): ?>
                        <?php print render($form['checkout']['delivery_fs']['pickup_times'][$pickupdaykey]); ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            
            <!--Liefertage-->
            <?php print render($form['checkout']['delivery_fs']['shipping_days']['shipping_day']); ?>
            
            <!--Lieferzeiten-->
            <?php if(!empty($form['checkout']['delivery_fs']['shipping_times'])): ?>
                <?php foreach($form['checkout']['delivery_fs']['shipping_times'] as $shippingdaykey => $shippingdays): ?>
                    <?php $tmp = explode('shipping_time_', $shippingdaykey); ?>
                    <?php if(isset($tmp[1])): ?>
                        <?php print render($form['checkout']['delivery_fs']['shipping_times'][$shippingdaykey]); ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            
            <!--Lieferadresse: Name-->
            <?php print render($form['checkout']['delivery_fs']['shipping_address_name']); ?>
            
            <!--Lieferadresse: Straße-->
            <?php print render($form['checkout']['delivery_fs']['shipping_address_street']); ?>
            
            <!--Lieferadresse: PLZ-->
            <?php print render($form['checkout']['delivery_fs']['shipping_address_zip']); ?>
            
            <!--Lieferadresse: Ort-->
            <?php print render($form['checkout']['delivery_fs']['shipping_address_city']); ?>
            
            <h2>Zahlung</h2>
            
            <!--Zahlarten-->
            <?php print render($form['checkout']['payment_fs']['paymenttypes']); ?>
            
            <!--IBAN-->
            <?php print render($form['checkout']['payment_fs']['iban']); ?>
            
            <!--Rechnungsadresse: Name-->
            <?php print render($form['checkout']['payment_fs']['billing_address_name']); ?>
            
            <!--Rechnungsadresse: Straße-->
            <?php print render($form['checkout']['payment_fs']['billing_address_street']); ?>
            
            <!--Rechnungsadresse: PLZ-->
            <?php print render($form['checkout']['payment_fs']['billing_address_zip']); ?>
            
            <!--Rechnungsadresse: Ort-->
            <?php print render($form['checkout']['payment_fs']['billing_address_city']); ?>
            
            <?php print render($form['submit']); ?>
        </div>
    </div>
    
    <div class="flexfix-sidebar">
        <div class="cart-container"> 
            <?php 
            $block = module_invoke('rm_cart', 'block_view', 'rm_checkout_block');
                print render($block['content']);
            ?>
        </div>
    </div>
</div>

<?php
print drupal_render_children($form);
?>

