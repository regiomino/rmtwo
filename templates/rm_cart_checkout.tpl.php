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
            
            <!--Abholzeiten-->
            <?php if(!empty($form['checkout']['delivery_fs']['pickup_times'])): ?>
                <?php foreach($form['checkout']['delivery_fs']['pickup_times'] as $pickuptimekey => $pickuptimes): ?>
                    <?php $tmp = explode('pickup_time_', $pickuptimekey); ?>
                    <?php if(isset($tmp[1])): ?>
                        <?php print render($form['checkout']['delivery_fs']['pickup_times'][$pickuptimekey]); ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            
            <!--Lieferzeiten-->
            <?php print render($form['checkout']['delivery_fs']['shipping_time']); ?>
            
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

