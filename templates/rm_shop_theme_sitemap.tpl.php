<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 06.08.14
 * Time: 16:16
 */
?>
<div class="row">
<div class="col-md-12">
    <?php if(!empty($vars['sitemap'])): ?>
        <?php foreach($vars['sitemap'] as $type => $values): ?>
            <h4><?php print node_type_get_name($type); ?></h4>
            <ul class="list-unstyled">
            <?php foreach($values as $value): ?>
                <li><?php print l($value['title'], 'node/' . $value['nid']); ?></li>
            <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
 </div>