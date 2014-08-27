<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 03.08.14
 * Time: 16:38
 */
?>
<div class="col-md-8">
    <h3><?php print t('... or apply for a new account'); ?></h3>
    <?php print drupal_render_children(drupal_get_form('rm_sales_suggest_form')); ?>
</div>