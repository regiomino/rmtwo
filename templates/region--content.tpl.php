<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 04.08.14
 * Time: 08:44
 */
?>
<!-- Example row of columns -->
    <?php if('user/register' == current_path()): ?>
        <div class="col-md-4">
            <h3><?php print t('Please sign in...'); ?></h3>
            <?php print render(drupal_get_form('user_login_block')); ?>
        </div>
    <?php endif; ?>
    <?php print $content; ?>