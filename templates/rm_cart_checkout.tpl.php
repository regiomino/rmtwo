<?php
$form = $variables['form'];
?>
<div class="wrapper-m">
    <div class="wrapper-m-inner">
        <?php print render($form['checkout']); ?>
        
        
        <?php print render($form['submit']); ?>
    </div>
</div>

<div class= "grid-l">
<?php
$block = module_invoke('rm_cart', 'block_view', 'rm_checkout_block');
    print render($block['content']);
?>
</div>

<?php
print drupal_render_children($form);
?>

