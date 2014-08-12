
<div class="row entry">
    <div class="col-md-5">
        <div class="zipcodeselect"> 
            <h3>1. <?php echo t('Enter your address...'); ?></h3>
    
            <?php echo render($vars['regionselect']); ?>
            
            <div class="proceed-info"> 
                <a class="toggle-link" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    Wie geht es danach weiter?
                </a>
            
                <div id="collapseOne" class="panel-collapse collapse">
                    <div class="row"> 
                        <ul class="list-inline">
                            <li>
                                <img id="steps_shop" data-toggle="popover" data-content="<?php print t('Each vendor offers special regional products that you can now order to create tasteful meals that your customers will love.'); ?>" src="<?php global $base_path; print $base_path . drupal_get_path('theme', 'rmtwo'); ?>/images/steps_shop.png" alt="<?php print t('Select your favorite products'); ?>" title="<?php print t('Select your favorite products'); ?>" />
                                <h5>2.<br />Lieblingsprodukte<br />aussuchen</h5>
                            </li>
                            <li>
                                <img id="steps_payment" data-toggle="popover" data-content="<?php print t('Instead of having to pay cash or work your way through hundreds of bills each month you can now pay online. Receipts and tax reports are send right to your inbox.'); ?>" src="<?php global $base_path; print $base_path . drupal_get_path('theme', 'rmtwo'); ?>/images/steps_payment.png" alt="<?php print t('Choose payment method'); ?>" title="<?php print t('Choose payment method'); ?>" />
                                <h5>3.<br />Zahlungsart<br />auswählen</h5>
                            </li>
                            <li>
                                <img id="steps_delivery" data-toggle="popover" data-content="<?php print t('Once your order is complete, at an agreed upon time the vendor will deliver the products right to your door or prepare them for you to pick up.'); ?>" src="<?php global $base_path; print $base_path . drupal_get_path('theme', 'rmtwo'); ?>/images/steps_delivery.png" alt="<?php print t('Have your order delivered'); ?>" title="<?php print t('Have your order delivered'); ?>" />
                                <h5>4.<br />Abholen oder ge-<br />liefert bekommen</h5>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



</div>
 

