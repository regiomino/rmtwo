
<div class="row entry">
    <?php if (rm_sales_user_is_salesguy ()): ?>
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
                          <div class="modal-body text-left">
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
                                <div class="row">
                                    <div class="col-xs-8">
                                        <p class="text-left"> <small> Haben Sie Fragen? Rufen Sie uns an oder schreiben Sie uns!</small> <br>
                                            <a class="pull-left"  href="tel:+49091319291117"> <span class="glyphicon glyphicon-earphone"></span> 09131-9291117</a>
                                            <a class="pull-left" href="mailto:support@regiomino.de"> <span class="glyphicon glyphicon-send"></span> support@regiomino.de</a>
                                            
                                        </p>
                                    </div>
                                    <div class="col-xs-4"> 
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Alles klar!</button>
                                    </div>
                               </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="col-md-7  ">
        <div class="welcome"> 
            <h1> <strong> Einfach regionale Produkte einkaufen</strong></h1>
        
            <p class="lead">Der günstigste Weg regionale Produkte zu
            verkaufen oder zu beschaffen!
            </p>
            <ul class="countdown list-inline">
                  <li>
                     <p class="h3"><strong> <span class="days">00</span></strong></p>
                    <p><em class="text">Tage</em></p>
                  </li>
                  <li>
                    <p class="h3"><strong><span class="hours">00</span></strong></p>
                    <p><em class="text">Stunden</em></p>
                  </li>
                  <li>
                    <p class="h3"><strong> <span class="minutes">00</span></strong></p>
                    <p><em class="text">Minuten</em></p>
                  </li>
                  <li>
                    <p class="h3"><strong><span class="seconds">00</span></strong></p>
                    <p><em class="text">Sekunden</em></p>
                  </li>
                </ul>
              <a href="#" class="more-info text-uppercase"> <small><strong>  <span class="glyphicon glyphicon-circle-arrow-right"> </span> Erfahren Sie mehr </strong></small> </a>  </span>
           
        </div>
    </div>
</div>



 
 

