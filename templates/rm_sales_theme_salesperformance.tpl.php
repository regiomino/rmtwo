<?php //var_dump($vars['createdProfiles'], $vars['createdCustomerProfiles'], $vars['createdSellerProfiles'], $vars['createdTraderProfiles']); ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Sales Performance</h1>
    </div>
                <!-- /.col-lg-12 -->
</div>

<div class="row"> 
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                  <?php print t('Profiles'); ?>          
            </div>
            <div class="panel-body">
                <div id="profiles" style="width:100%; height:300px"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                  <?php print t('Ordered Items'); ?>          
            </div>
            <div class="panel-body">
                <div id="orderitems" style="width:100%; height:300px"></div>
            </div>
        </div>
    </div>
</div>
<div class="row"> 
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                  <?php print t('Order sales'); ?>          
            </div>
            <div class="panel-body">
                <div id="ordersales" style="width:100%; height:300px"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                  <?php print t('Registrations'); ?>          
            </div>
            <div class="panel-body">
                <h3 class="text-center"> <?php  print $vars['registrations']; ?></h3>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                  <?php print t('Invites'); ?>          
            </div>
            <div class="panel-body">
                   <h3 class="text-center"> <?php   print $vars['invites'];; ?></h3>
                 
            </div>
        </div>
    </div>
</div>
 
 
 
