<div class="col-sm-12 col-md-12 main">
    <br>
    <h1 class="page-header">Willkommen in Ihrem Dashboard</h1>
    <div class="row">
    
        <!-- Offer management -->
        <?php
            $offers = rm_shop_get_structured_seller_offers($user->uid, array(0,1));
            $offercount = count($offers);
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
                    <?php else: ?>
                        <div class="alert alert-success" role="alert"><?php print t('Congratulations. All of your offers are active.'); ?></div>
                    <?php endif; ?>
                    <div class="progress">
                        <div class="progress-bar progress-bar-<?php print ($inactive > 0) ? 'warning' : 'success' ?>" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php print 100 * ($offercount - $inactive) / $offercount; ?>%;"><?php print t('@active out of @total', array('@active' => $offercount - $inactive, '@total' => $offercount)); ?></div>
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
            $profile = rm_api_get_nodes_by_properties(array('seller_profile'), 1, -1, -1, -1, -1, $user->uid);
            $profilekeys = array_keys($profile);
            $profile = $profile[$profilekeys[0]];
            $profilecompleteness = rm_user_get_profile_completeness($profile->nid);
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
            $accountcompleteness = rm_user_get_account_completeness($user->uid);
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
</div>