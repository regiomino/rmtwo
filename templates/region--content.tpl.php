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
    <div class="row"> 
        <div class="col-md-4">
            <h3><?php print t('Please sign in...'); ?></h3>
            <?php
            /*$block = module_invoke('rm_user', 'block_view', 'regiomino_user_login');
            print render($block['content']);*/
            print $variables['elements']['regiominouserlogin'];
            ?>
        </div>
   
    <?php endif; ?>
    <?php print $content; ?>