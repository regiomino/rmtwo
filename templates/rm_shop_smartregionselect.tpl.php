
<div class="region-select form-inline"> 
<?php
$form = $variables['form'];
?>

   <span class="label"> PLZ: </span>
    <?php print render($form['address']); ?>
    <?php print render($form['submit']); ?>
   
   
</div>

<?php
print drupal_render_children($form);
?>