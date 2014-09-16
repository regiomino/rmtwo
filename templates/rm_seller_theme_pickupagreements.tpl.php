<div class="row">

    <h1 class="page-header"><?php print t('Your pickup agreements'); ?></h1>
    
    <p><?php print l(t('Add new pickup agreement'), 'manage/seller/addagreement/pickup_agreement/' . $user->uid, array('query' => drupal_get_destination(), 'attributes' => array('class' => array('btn', 'btn-primary')))); ?></p>
    
    <?php if(empty($vars['agreements'])): ?>
    
        <div class="alert alert-danger" role="alert"><?php print t('You have not set any pickup agreements. Your products cannot be picked up unless you do so.'); ?></div>
        
    <?php else: ?>
        <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Für wen?</th>
                    <th>Mindestbestellwert</th>
                    <th>Aufpreis</th>
                    <th>Abholadresse</th>
                    <th>Konditionen</th>
                    <th>Datum der Erstellung</th>
                    <th>Letzte Aktualisierung</th>
                    <th>Aktionen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($vars['agreements'] as $agreement): ?>
                    <tr>
                        <td>
                            <?php
                                print ($agreement->field_user_reference[LANGUAGE_NONE][0]['target_id'] == 0) ? t('for all') : t('for @user', array('@user' => format_username(user_load($agreement->field_user_reference[LANGUAGE_NONE][0]['target_id']))));
                            ?>
                        </td>
                        <td>
                            <?php print number_format($agreement->field_minimum_order_value[LANGUAGE_NONE][0]['value'], 2, ",", "."); ?>€
                        </td>
                        <td>
                            <?php print number_format($agreement->field_surcharge[LANGUAGE_NONE][0]['value'], 2, ",", "."); ?>€
                        </td>
                        <td>
                            <?php print render(addressfield_generate($agreement->field_address[LANGUAGE_NONE][0], array('address' => 'address'), array('mode' => 'render'))); ?>
                        </td>
                        <td>
                            <?php echo render(field_view_field('node', $agreement, 'field_regular_times')); ?>
                        </td>
                        <td><?php print date('d.m.Y', $agreement->created); ?></td>
                        <td><?php print date('d.m.Y', $agreement->changed); ?></td>
                        <td>
                            <?php print l(t('edit'), 'manage/seller/editagreement/' . $agreement->nid, array('query' => drupal_get_destination(), 'attributes' => array('class' => array('btn', 'btn-sm', 'btn-info')))); ?>
                            <?php print l(t('delete'), 'manage/seller/deleteagreement/' . $agreement->nid, array('query' => drupal_get_destination(), 'attributes' => array('class' => array('btn', 'btn-sm', 'btn-danger')))); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    <?php endif; ?>
</div>