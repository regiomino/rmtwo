<?php
$form = $variables['form'];
?>
<div class="input-group">
    <?php print render($form['address']); ?>
    <div class="submit-wrapper"> 
        <?php print render($form['submit']); ?>
    </div>
   
</div>

<?php
print drupal_render_children($form);
?>