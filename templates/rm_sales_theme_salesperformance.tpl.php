<?php //var_dump($vars['createdProfiles'], $vars['createdCustomerProfiles'], $vars['createdSellerProfiles'], $vars['createdTraderProfiles']); ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Sales Performance</h1>
    </div>
                <!-- /.col-lg-12 -->
</div>

<div class="row"> 
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                  <?php print t('Profiles'); ?>          
            </div>
            <div class="panel-body">
                <div id="profiles" style="width:100%; height:300px"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                  <?php print t('Ordered Items'); ?>          
            </div>
            <div class="panel-body">
                <div id="orderitems" style="width:100%; height:300px"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                  <?php print t('Order sales'); ?>          
            </div>
            <div class="panel-body">
                <div id="ordersales" style="width:100%; height:300px"></div>
            </div>
        </div>
    </div>
</div>
<div class="row"> 
    
    <div class="col-lg-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                  <?php print t('Registrations'); ?> / <?php print t('Invites'); ?><br>
                  <?php print t('(Sellers, Customers, Traders)'); ?>
            </div>
            <div class="panel-body">
                <h3 class="text-center">
                <?php if(!empty($vars['registrations']['seller_profile'])): ?>
                    <?php print $vars['registrations']['seller_profile']; ?>
                <?php else: ?>
                    <?php print 0; ?>
                <?php endif; ?>
                /
                <?php if(!empty($vars['invites']['seller_profile'])): ?>
                    <?php print $vars['invites']['seller_profile']; ?>
                <?php else: ?>
                    <?php print 0; ?>
                <?php endif; ?>
                <br>
                <?php if(!empty($vars['registrations']['customer_profile'])): ?>
                    <?php print $vars['registrations']['customer_profile']; ?>
                <?php else: ?>
                    <?php print 0; ?>
                <?php endif; ?>
                /
                <?php if(!empty($vars['invites']['customer_profile'])): ?>
                    <?php print $vars['invites']['customer_profile']; ?>
                <?php else: ?>
                    <?php print 0; ?>
                <?php endif; ?>
                <br>
                <?php if(!empty($vars['registrations']['trader_profile'])): ?>
                    <?php print $vars['registrations']['trader_profile']; ?>
                <?php else: ?>
                    <?php print 0; ?>
                <?php endif; ?>
                /
                <?php if(!empty($vars['invites']['trader_profile'])): ?>
                    <?php print $vars['invites']['trader_profile']; ?>
                <?php else: ?>
                    <?php print 0; ?>
                <?php endif; ?>
                </h3>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                  <?php print t('Imported profiles'); ?>          <br>
                  <?php print t('(Sellers, Customers, Traders)'); ?>
            </div>
            <div class="panel-body">
                   <h3 class="text-center">
                    <?php print $vars['profilecounts']['seller_profile']; ?> / <?php print $vars['profilecounts']['customer_profile']; ?> / <?php print $vars['profilecounts']['trader_profile']; ?></h3>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                  <?php print t('Purchases by'); ?>          <br>
                  <?php print t('(Sellers, Customers, Traders)'); ?>
            </div>
            <div class="panel-body">
                   <h3 class="text-center">
                    <?php print $vars['purchasecounts']['seller_profile']['count']; ?> / <?php print $vars['purchasecounts']['customer_profile']['count']; ?> / <?php print $vars['purchasecounts']['trader_profile']['count']; ?></h3>
                 
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                  <?php print t('Purchasing'); ?>          <br>
                  <?php print t('(Sellers, Customers, Traders)'); ?>
            </div>
            <div class="panel-body">
                   <h3 class="text-center">
                    <?php print (!empty($vars['purchasingcounts']['seller_profile']['users'])) ? count($vars['purchasingcounts']['seller_profile']['users']) : 0; ?>
                    /
                    <?php print (!empty($vars['purchasingcounts']['customer_profile']['users'])) ? count($vars['purchasingcounts']['customer_profile']['users']) : 0; ?>
                    /
                    <?php print (!empty($vars['purchasingcounts']['trader_profile']['users'])) ? count($vars['purchasingcounts']['trader_profile']['users']) : 0; ?></h3>
                 
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                  <?php print t('Offers'); ?>          
            </div>
            <div class="panel-body">
                   <h3 class="text-center"><?php print t('@offercount offers by @sellercount sellers', array('@offercount' => $vars['offers']['total'], '@sellercount' => $vars['offers']['sellers'])); ?></h3>
                 
            </div>
        </div>
    </div>
</div>
 
 
 
