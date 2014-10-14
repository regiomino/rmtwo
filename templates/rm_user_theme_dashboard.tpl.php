<div class="row">
    <h1 class="page-header">Willkommen in Ihrem Dashboard</h1>

    <!-- Order overview -->
    <?php
        $orders = $vars['orders'];
    ?>
    
    <?php if($vars['ordercount'] > 0): ?>
    <div class="col-sm-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title"><strong><?php print format_plural($vars['ordercount'], 'You have 1 undelivered order', 'You have @count undelivered orders'); ?></strong></h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <th><?php print t('Date'); ?></th>
                        <th><?php print t('Order number'); ?></th>
                        <th><?php print t('Products'); ?></th>
                        <th><?php print t('Delivery type'); ?></th>
                        <th><?php print t('Payment type'); ?></th>
                        <th><?php print t('Status'); ?></th>
                    </tr>
                    <?php $order_number = NULL; ?>
                    <?php foreach($orders as $order_number => $order): ?>
                        <tr>
                            <td><?php print $order['date']; ?></td>
                            <td><?php print $order_number; ?></td>
                            <td><?php foreach($order['products'] as $product): ?><?php print $product['title']; ?>, <?php endforeach; ?></td>
                            <td><?php print $order['deliverytype']; ?><br><?php print $order['deliveryrange']; ?></td>
                            <td><?php print $order['paymenttype']; ?></td>
                            <td><?php print $order['status']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="panel-footer">
                <div class="row"><div class="col-sm-12 col-md-12">
                <?php print l(t('View the complete order table'),
                                'manage/seller/' . $user->uid . '/orders',
                                array(
                                    'attributes' => array(
                                        'class' => array('btn', 'btn-sm', 'btn-success', 'pull-left'),
                                    ),
                                )); ?>
                </div></div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Account management -->
    <?php
        $accountcompleteness = $vars['accountcompleteness'];
    ?>

    <div class="col-sm-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title"><strong><?php print t('Your user account: @account', array('@account' => format_username($user))); ?></strong></h3>
            </div>
            <div class="panel-body">
                <?php if($accountcompleteness < 0.5): ?>
                    <div class="alert alert-danger" role="alert"><?php print t('Your account is @perc% complete. Fill in the missing fields now.', array('@perc' => $accountcompleteness * 100)); ?></div>
                <?php elseif($accountcompleteness < 1): ?>
                    <div class="alert alert-warning" role="alert"><?php print t('Your account is @perc% complete. Fill in the missing fields now.', array('@perc' => $accountcompleteness * 100)); ?></div>
                <?php else: ?>
                    <div class="alert alert-success" role="alert"><?php print t('Congratulations. Your account is @perc% complete.', array('@perc' => $accountcompleteness * 100)); ?></div>
                <?php endif; ?>
                <div class="progress">
                    <div class="progress-bar progress-bar-<?php print ($accountcompleteness < 1) ? 'warning' : 'success' ?>" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php print $accountcompleteness * 100; ?>%;"><?php print $accountcompleteness * 100; ?>%</div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row"><div class="col-sm-12 col-md-12">
                <?php print l(t('Go to account management'),
                                'manage/seller/' . $user->uid . '/account',
                                array(
                                    'query' => drupal_get_destination(),
                                    'attributes' => array(
                                        'class' => array('btn', 'btn-sm', 'btn-success', 'pull-right'),
                                    ),
                                )); ?>
                </div></div>
            </div>
        </div>
    </div>
    
    <!-- Profile management -->
    <?php
        $profile = $vars['profile'];
        $profilecompleteness = $vars['profilecompleteness'];
    ?>

    <?php if(!empty($profile)): ?>
    <div class="col-sm-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title"><strong><?php print $profile->title; ?></strong></h3>
            </div>
            <div class="panel-body">
                <?php if($profilecompleteness < 1): ?>
                    <div class="alert alert-warning" role="alert"><?php print t('Your profile is @perc% complete. Fill in the missing fields now.', array('@perc' => $profilecompleteness * 100)); ?></div>
                <?php else: ?>
                    <div class="alert alert-success" role="alert"><?php print t('Congratulations. Your profile is @perc% complete.', array('@perc' => $profilecompleteness * 100)); ?></div>
                <?php endif; ?>
                <div class="progress">
                    <div class="progress-bar progress-bar-<?php print ($profilecompleteness < 1) ? 'warning' : 'success' ?>" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php print $profilecompleteness * 100; ?>%;"><?php print $profilecompleteness * 100; ?>%</div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row"><div class="col-sm-12 col-md-12">
                <?php print l(t('Go to profile management'),
                                'manage/customer/' . $user->uid . '/profile',
                                array(
                                    'query' => drupal_get_destination(),
                                    'attributes' => array(
                                        'class' => array('btn', 'btn-sm', 'btn-success', 'pull-right'),
                                    ),
                                )); ?>
                </div></div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    
    
    
</div>

