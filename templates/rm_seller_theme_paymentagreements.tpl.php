<div class="col-sm-12 col-md-12">

    <h1 class="page-header"><?php print t('Your payment agreements'); ?></h1>
    
    <p><?php print l(t('Add new payment agreement'), 'manage/seller/addagreement/payment_agreement/' . $user->uid, array('query' => drupal_get_destination(), 'attributes' => array('class' => array('btn', 'btn-primary')))); ?></p>
    
    <?php if(empty($vars['agreements'])): ?>
    
        <div class="alert alert-danger" role="alert"><?php print t('You have not set any payment agreements. Your products cannot be purchased unless you do so.'); ?></div>
        
    <?php else: ?>
        <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Für wen?</th>
                    <th>Welche Zahlungsarten?</th>
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
                            <?php
                                $paymenttypes = array();
                                if(isset($agreement->field_payment_types[LANGUAGE_NONE])) {
                                    foreach($agreement->field_payment_types[LANGUAGE_NONE] as $payment_type) {
                                        $paymenttypes[] = $vars['paymenttypes'][$payment_type['value']];
                                    }
                                }
                                print implode(', ', $paymenttypes);
                            ?>
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