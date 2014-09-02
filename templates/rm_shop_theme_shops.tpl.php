<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 06.08.14
 * Time: 16:27
 */
?>



<div class="col-sm-7 col-md-6 col-lg-5 main">
<div class="input-group"> <span class="input-group-addon"><?php print t('Filter'); ?></span>
        <input id="filterShops" type="text" class="form-control" placeholder="<?php print t('Filter available vendors'); ?>">

    </div>
    <?php if (!empty($vars['title'])): ?>
        <div class="page-header">
            <h1 class="page-title">
                <?php print $vars['title']; ?>
            </h1>
        </div>
    <?php endif; ?>

    <?php global $user; if($user->uid <= 0): ?>
        <div class="alert alert-info" role="alert">Bitte <?php print l('loggen Sie sich ein', 'user/register', array('query' => drupal_get_destination())); ?>, um die mit Ihnen vereinbarten Liefer- und Zahlungsbedingungen nutzen zu können</div>
    <?php endif;?>
    <?php foreach($vars['shops'] as $shop): ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"> <?php print l($shop->title, 'node/' . $shop->nid); ?></h3>
            </div>
            <div class="panel-body">
                <a href="<?php print url('node/' . $shop->nid); ?>"><img src="<?php print image_style_url('thumbnail', $shop->field_image[LANGUAGE_NONE][0]['uri']); ?>" class="img-rounded seller-img"></a>
                <?php if(!empty($shop->agreements)) {
                    foreach($shop->agreements as $type => $user_reference) {
                        foreach($user_reference as $target_id => $agreements) {
                            //if theres two variantes for the same agreement, then choose the one with less minimum order value
                            if(count($agreements) > 1) {
                                usort($agreements, "rm_shop_sort_agreements_by_mov");
                            }
                            $agreement = $agreements[0];
                            switch($type) {
                                case 'shipping_agreement':
                                    print "<span class='label label-warning label-details' data-toggle='popover' data-content='" . render(field_view_field('node', $agreement, 'field_regular_times')) . "'>" . t('Shipping from @mov', array('@mov' => number_format($agreement->field_minimum_order_value[LANGUAGE_NONE][0]['value'], 2, ",", ".") . ' €')) . "</span> ";
                                    break;
                                case 'pickup_agreement':
                                    print "<span class='label label-warning label-details' data-toggle='popover' data-content='" . render(field_view_field('node', $agreement, 'field_regular_times')) . "'>" . t('Pickup from @mov', array('@mov' => number_format($agreement->field_minimum_order_value[LANGUAGE_NONE][0]['value'], 2, ",", ".") . ' €')) . "</span> ";
                                    break;
                                case 'dispatch_agreement':
                                    print '<span class="label label-warning label-details" data-toggle="popover" data-content="' . t('Have your order delivered to you by @provider', array('@provider' => $agreement->field_dispatch_provider[LANGUAGE_NONE][0]['value'])) . '">' . t('Dispatch from @mov', array('@mov' => number_format($agreement->field_minimum_order_value[LANGUAGE_NONE][0]['value'], 2, ",", ".") . ' €')) . '</span> ';
                                    break;
                            }
                        }
                    }
                    foreach($shop->agreements as $type => $user_reference) {
                        foreach($user_reference as $target_id => $index) {
                            foreach($index as $indexid => $agreement) {
                                switch($type) {
                                    case 'payment_agreement':
                                        foreach($agreement->field_payment_types[LANGUAGE_NONE] as $payment_type) {
                                            switch($payment_type['value']) {
                                                case 'prepaid':
                                                    print '<span class="label label-success label-details" data-toggle="popover" data-content="' . t('Pay online during checkout via one of our payment providers') . '">Vorkasse</span> ';
                                                    break;
                                                case 'cash':
                                                    print '<span class="label label-success label-details" data-toggle="popover" data-content="' . t('Pay cash when your order is delivered') . '">Barzahlung</span> ';
                                                    break;
                                                case 'invoice':
                                                    print '<span class="label label-success label-details" data-toggle="popover" data-content="' . t('The vendor will send you an invoice after your order is complete') . '">Rechnung</span> ';
                                                    break;
                                            }
                                        }
                                        break;
                                }
                            }
                        }
                    }
                }
                ?>
                <br /><br />
                <ul class="list-unstyled">
                    <li><span class="fa fa-cutlery" ></span>
                        <?php
                        $all_tids = array();
                        foreach($shop->field_sellercategories[LANGUAGE_NONE] as $index => $tid) {
                            $all_tids[] = (int)$tid['tid'];
                        }

                        $allterms = taxonomy_term_load_multiple($all_tids);
                        foreach($allterms as $term) {
                            print $term->name . ' ';
                        }
                        ?>
                    </li>
                    <li><span class="fa fa-map-marker"></span> <?php print $shop->field_address[LANGUAGE_NONE][0]['thoroughfare']; ?>, <?php print $shop->field_address[LANGUAGE_NONE][0]['postal_code'] ?> <?php print $shop->field_address[LANGUAGE_NONE][0]['locality']; ?></li>
                </ul>
                <p>
                    <?php
                        $length = 300;
                        $body = strip_tags($shop->body[LANGUAGE_NONE][0]['value']);
                        if(mb_strlen($body) > $length) {
                            print mb_substr($body, 0, mb_strpos($body, " ", $length)) . ' ...';
                        }
                        else {
                            print $body;
                        }
                    ?>
                </p>
                <?php print l(t('View products '), 'node/' . $shop->nid, array('attributes' => array('class' => array('btn', 'btn-success', 'seller-btn')))); ?>

            </div>
        </div>
    <?php endforeach; ?>
    <?php print $vars['pager']; ?>
</div>

<div class="col-sm-5 col-md-6  col-lg-7 sidebar ">
    <div id="directoryGoogleMap" style="width: 100%; height: 100%"></div>
<!--    <br />
    <ul class="nav nav-sidebar">
        <li class="active"><a href="#">Overview</a></li>
        <li><a href="#">Reports</a></li>
        <li><a href="#">Analytics</a></li>
        <li><a href="#">Export</a></li>
    </ul>
    <ul class="nav nav-sidebar">
        <li><a href="">Nav item</a></li>
        <li><a href="">Nav item again</a></li>
        <li><a href="">One more nav</a></li>
        <li><a href="">Another nav item</a></li>
        <li><a href="">More navigation</a></li>
    </ul>
    <ul class="nav nav-sidebar">
        <li><a href="">Nav item again</a></li>
        <li><a href="">One more nav</a></li>
        <li><a href="">Another nav item</a></li>
    </ul>-->
</div>