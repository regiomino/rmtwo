<?php
$form = $variables['form'];
?>
<div class="flexfix-wrapper clearfix"> 
    <div class="flexfix-content">
        <div class="flexfix-content-inner">
            <?php print render($form['checkout']); ?>
            
            
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

