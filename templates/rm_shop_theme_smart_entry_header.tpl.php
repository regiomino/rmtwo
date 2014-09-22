 

<div class="input-group">
    <?php echo render($vars['regionselect']['address']); ?>
    <div class="submit-wrapper"> 
        <?php echo render($vars['regionselect']['submit']); ?>
    </div>
   
</div>


<?php echo drupal_render_children($vars['regionselect']); ?>