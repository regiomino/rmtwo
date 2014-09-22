 

<div class="input-group">
             
            <?php echo render($vars['regionselect']['address']); ?>
            <span class="input-group-btn">
               <?php echo render($vars['regionselect']['submit']); ?>
            </span>
        </div>


<?php echo drupal_render_children($vars['regionselect']); ?>