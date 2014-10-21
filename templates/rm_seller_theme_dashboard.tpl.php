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
                        <th><?php print t('Customer'); ?></th>
                        <th><?php print t('Products'); ?></th>
                        <th><?php print t('Delivery type'); ?></th>
                        <th><?php print t('Payment type'); ?></th>
                        <th><?php print t('Status'); ?></th>
                        <th><?php print t('Actions'); ?></th>
                    </tr>
                    <?php $order_number = NULL; ?>
                    <?php foreach($orders as $order_number => $order): ?>
                        <tr>
                            <td><?php print $order['date']; ?></td>
                            <td><?php print $order_number; ?></td>
                            <td><?php print (!empty($order['customerprofile'])) ? $order['customerprofile']->title : $order['userobject']->field_first_name[LANGUAGE_NONE][0]['value'] . ' ' . $order['userobject']->field_last_name[LANGUAGE_NONE][0]['value']; ?></td>
                            <td><?php foreach($order['products'] as $product): ?><?php print $product['title']; ?>, <?php endforeach; ?></td>
                            <td><?php print $order['deliverytype']; ?><br><?php print $order['deliveryrange']; ?></td>
                            <td><?php print $order['paymenttype']; ?></td>
                            <td><?php print $order['status']; ?></td>
                            <td>
                                <?php print l(t('Set to delivered'),
                                                'changeorderstatus/' . $order_number . '/delivered',
                                                array(
                                                    'attributes' => array(
                                                        'class' => array('btn', 'btn-sm', 'btn-success'),
                                                    ),
                                                )); ?>
                                <?php print l(t('Set to billed'),
                                                'changeorderstatus/' . $order_number . '/billed',
                                                array(
                                                    'attributes' => array(
                                                        'class' => array('btn', 'btn-sm', 'btn-success'),
                                                    ),
                                                )); ?>
                            </td>
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

    <!-- Offer management -->
    <?php
        $offers = $vars['offers'];
        $offercount = $vars['offercount'];
        $inactive = 0;
    ?>
    <div class="col-sm-4">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title"><strong><?php print t('You have @amount offers', array('@amount' => $offercount)); ?></strong></h3>
            </div>
            <div class="panel-body">
                <!--<ul>-->
                <?php foreach($offers as $offer): ?>
                    <!--<li><?php print $offer->title; ?></li>-->
                    <?php if($offer->status == 0) $inactive++; ?>
                <?php endforeach; ?>
                <!--</ul>-->
                <?php if($inactive > 0): ?>
                    <div class="alert alert-warning" role="alert"><?php print t('You have @active active offers out of @total. Activate the other offers now.', array('@active' => $offercount - $inactive, '@total' => $offercount)); ?></div>
                <?php elseif(!$offercount): ?>
                    <div class="alert alert-danger" role="alert"><?php print t('You have no active offers. Create some now.'); ?></div>
                <?php else: ?>
                    <div class="alert alert-success" role="alert"><?php print t('Congratulations. All of your offers are active.'); ?></div>
                <?php endif; ?>
                <div class="progress">
                    <div class="progress-bar progress-bar-<?php print ($inactive > 0) ? 'warning' : 'success' ?>" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php print ($offercount > 0) ? 100 * ($offercount - $inactive) / $offercount : 0; ?>%;"><?php print t('@active out of @total', array('@active' => $offercount - $inactive, '@total' => $offercount)); ?></div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row"><div class="col-sm-12 col-md-12">
                <?php print l(t('Go to offer management'),
                                'manage/seller/' . $user->uid . '/offers',
                                array(
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

    <div class="col-sm-4">
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
                                'manage/seller/' . $user->uid . '/profile',
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
    
    
    <!-- Account management -->
    <?php
        $accountcompleteness = $vars['accountcompleteness'];
    ?>

    <div class="col-sm-4">
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
    
    
</div>

<div class="row">

    <!-- Payment agreements -->
    <?php
        $agreements = $vars['paymentagreements'];
    ?>
    <div class="col-sm-4">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title"><strong><?php print t('Your payment agreements'); ?></strong></h3>
            </div>
            <div class="panel-body">
            <?php if(count($agreements)): ?>
                <div class="alert alert-success" role="alert"><?php print format_plural(count($agreements), 'Great! You have entered one payment agreement.', 'Great you have entered @count payment agreements'); ?></div>
            <?php else: ?>
                <div class="alert alert-danger" role="alert"><?php print t('You have not set any payment agreements. Your products cannot be purchased unless you do so.'); ?></div>
            <?php endif; ?>
            </div>
            <div class="panel-footer">
                <div class="row"><div class="col-sm-12 col-md-12">
                <?php print l(t('Go to payment agreements'),
                                'manage/seller/' . $user->uid . '/paymentagreements',
                                array(
                                    'attributes' => array(
                                        'class' => array('btn', 'btn-sm', 'btn-success', 'pull-right'),
                                    ),
                                )); ?>
                </div></div>
            </div>
        </div>
    </div>
    
    
    <!-- Shipping agreements -->
    <?php
        $agreements = $vars['shippingagreements'];
    ?>
    <div class="col-sm-4">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title"><strong><?php print t('Your shipping agreements'); ?></strong></h3>
            </div>
            <div class="panel-body">
            <?php if(count($agreements)): ?>
                <div class="alert alert-success" role="alert"><?php print format_plural(count($agreements), 'Great! You have entered one shipping agreement.', 'Great you have entered @count shipping agreements'); ?></div>
            <?php else: ?>
                <div class="alert alert-danger" role="alert"><?php print t('You have not set any shipping agreements. Your products cannot be shipped unless you do so.'); ?></div>
            <?php endif; ?>
            </div>
            <div class="panel-footer">
                <div class="row"><div class="col-sm-12 col-md-12">
                <?php print l(t('Go to shipping agreements'),
                                'manage/seller/' . $user->uid . '/shippingagreements',
                                array(
                                    'attributes' => array(
                                        'class' => array('btn', 'btn-sm', 'btn-success', 'pull-right'),
                                    ),
                                )); ?>
                </div></div>
            </div>
        </div>
    </div>
    
    
    <!-- Pickup agreements -->
    <?php
        $agreements = $vars['pickupagreements'];
    ?>
    <div class="col-sm-4">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title"><strong><?php print t('Your pickup agreements'); ?></strong></h3>
            </div>
            <div class="panel-body">
            <?php if(count($agreements)): ?>
                <div class="alert alert-success" role="alert"><?php print format_plural(count($agreements), 'Great! You have entered one pickup agreement.', 'Great you have entered @count pickup agreements'); ?></div>
            <?php else: ?>
                <div class="alert alert-danger" role="alert"><?php print t('You have not set any pickup agreements. Your products cannot be picked up unless you do so.'); ?></div>
            <?php endif; ?>
            </div>
            <div class="panel-footer">
                <div class="row"><div class="col-sm-12 col-md-12">
                <?php print l(t('Go to pickup agreements'),
                                'manage/seller/' . $user->uid . '/pickupagreements',
                                array(
                                    'attributes' => array(
                                        'class' => array('btn', 'btn-sm', 'btn-success', 'pull-right'),
                                    ),
                                )); ?>
                </div></div>
            </div>
        </div>
    </div>
    
</div>
