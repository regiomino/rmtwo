<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 06.08.14
 * Time: 16:16
 */
?>
<div class="col-md-12">
    <?php if(!empty($vars['jobs'])): ?>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Position</th>
                <th>Standort</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($vars['jobs'] as $nid => $job): ?>
                <tr>
                    <td><?php print l($job->title, 'node/' . $nid); ?></td>
                    <td><?php print drupal_render(addressfield_generate($job->field_jobaddress[LANGUAGE_NONE][0], array('address' => 'address'), array('mode' => 'render'))); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>Derzeit sind bei uns keine Stellen offen</p>
    <?php endif; ?>
</div>