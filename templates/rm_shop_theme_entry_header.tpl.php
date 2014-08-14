
<div class="row entry">
    <div class="col-md-5">
        <div class="zipcodeselect  ">
            
            <h3> Schritt 1:<strong> <?php echo t('Enter your address...'); ?></strong></h3>
    
            <?php echo render($vars['regionselect']); ?>
            
            <div class="proceed-info"> 
                <a class="toggle-link" data-toggle="modal" data-target="#steps-explanation"  href="#collapseOne">
                   <strong>Wie geht es danach weiter? </strong> 
                </a>
                <!-- Modal -->
                <div class="modal fade" id="steps-explanation" tabindex="-1" role="dialog" aria-labelledby="So funktionoert´s" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-body">
                            <div class="media">
                                <img class="pull-left" src="<?php global $base_path; print $base_path . drupal_get_path('theme', 'rmtwo'); ?>/images/steps_shop.png" alt="<?php print t('Select your favorite products'); ?>" />
                                  
                                <div class="media-body">
                                  <h4 class="media-heading">Schritt 2: <strong> Lieblingsprodukte aussuchen</strong></h4>
                                  <p><?php print t('Each vendor offers special regional products that you can now order to create tasteful meals that your customers will love.'); ?></p>
                                </div>
                            </div>
                            
                            <div class="media">
                                <img class="pull-left" src="<?php global $base_path; print $base_path . drupal_get_path('theme', 'rmtwo'); ?>/images/steps_payment.png" alt="<?php print t('Choose payment method'); ?>" />
                                  
                                <div class="media-body">
                                  <h4 class="media-heading">Schritt 3: <strong> Zahlungsart auswählen</strong></h4>
                                  <p><?php print t('Instead of having to pay cash or work your way through hundreds of bills each month you can now pay online. Receipts and tax reports are send right to your inbox.'); ?></p>
                                </div>
                            </div>
                            
                            <div class="media">
                                <img class="pull-left" src="<?php global $base_path; print $base_path . drupal_get_path('theme', 'rmtwo'); ?>/images/steps_delivery.png" alt="<?php print t('Have your order delivered'); ?>" />
                                  
                                <div class="media-body">
                                  <h4 class="media-heading">Schritt 4: <strong> Abholen oder geliefert bekommen</strong></h4>
                                  <p><?php print t('Once your order is complete, at an agreed upon time the vendor will deliver the products right to your door or prepare them for you to pick up.'); ?></p>
                                </div>
                            </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Alles klar!</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7  col-lg-5">
        <div class="welcome"> 
            <h1> <strong> Einfach regionale Produkte einkaufen</strong></h1>
        
            <p class="lead">Der günstigste Weg regionale Produkte zu
verkaufen oder zu beschaffen!</p>
        </div>
    </div>
</div>



 
 

