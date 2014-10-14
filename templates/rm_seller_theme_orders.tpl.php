<div class="row">

    <h1 class="page-header"><?php print t('Your orders'); ?></h1>
    
    <?php if(empty($vars['orders'])): ?>
    
        <div class="alert alert-danger" role="alert"><?php print t('You currently have no orders.'); ?></div>
        
    <?php else: ?>
        <?php
            $orders = $vars['orders'];
        ?>
        <div class="table-responsive">
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
                            <button class="btn btn-primary" data-toggle="modal" data-target="#orderModal<?php print $order_number; ?>">
                                <span class="fa fa-search"></span> Details
                            </button>
                                            
                            <div class="modal fade" id="orderModal<?php print $order_number; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h3 class="modal-title text-center" id="suggestModalLabel"><?php print t('Order @number', array('@number' => $order_number)); ?></h3>
                                        </div>
                                        <div class="modal-body">
                                            <?php print $order_number; ?>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endif; ?>
</div>