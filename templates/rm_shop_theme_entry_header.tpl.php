
<div class="row entry">
      <div class="col-md-7 col-md-push-5">
        <div class="welcome"> 
            <h1> <strong> Einfach regionale Produkte einkaufen</strong></h1>
        
           <!-- <p class="lead">Der günstigste Weg regionale Produkte zu
            verkaufen oder zu beschaffen!
            </p>-->
            <!--<ul class="countdown list-inline">
                  <li>
                     <p class="h2"><strong> <span class="days">00</span></strong></p>
                    <p><em class="text">Tage</em></p>
                  </li>
                  <li>
                    <p class="h2"><strong><span class="hours">00</span></strong></p>
                    <p><em class="text">Stunden</em></p>
                  </li>
                  <li>
                    <p class="h2"><strong> <span class="minutes">00</span></strong></p>
                    <p><em class="text">Minuten</em></p>
                  </li>
                  <li>
                    <p class="h2"><strong><span class="seconds">00</span></strong></p>
                    <p><em class="text">Sekunden</em></p>
                  </li>
                </ul>-->
              <!--<a href="#" class="more-info text-uppercase"> <small><strong>  <span class="glyphicon glyphicon-circle-arrow-right"> </span> Erfahren Sie mehr </strong></small> </a>  </span>-->
           
        </div>
    </div>
    
       <div class="col-md-5 col-md-pull-7">
            <div class="zipcodeselect">
                <h3> Schritt 1: <strong>Postleitzahl eingeben</strong></h3>
        
                <?php echo render($vars['regionselect']); ?>
                
                <div class="proceed-info"> 
                    <a class="toggle-link" data-toggle="modal" data-target="#steps-explanation"  href="#collapseOne">
                       <strong>Wie geht es danach weiter? </strong> 
                    </a>
                    
                    <!--<ul class="payment-icons list-inline">
                        <li> <span class="sprite sofort"> </span></li>
                        <li> <span class="sprite paypal"> </span></li>
                        <li> <span class="sprite lastschrift"> </span></li>
                        <li> <span class="sprite rechnung"> </span></li>
                    </ul>-->
                </div>
            </div>
        </div>
  
</div>


<div class="modal fade steps-explanation" id="steps-explanation" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-left">
                <div class="row">
                    <div class="col-sm-3 col text-right">
                        <img class="select" src="<?php echo base_path() . path_to_theme();?>/images/frontpage_illus/select.png" alt="<?php print t('Select your favorite products'); ?>" />
                    </div>
                    <div class="col-sm-9">
                          <h4 class="media-heading">Schritt 2: <strong> Lieblingsprodukte aussuchen</strong></h4>
                          <p><?php print t('Each vendor offers special regional products that you can now order to create tasteful meals that your customers will love.'); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3 col text-right">
                        <img class="payment" src="<?php echo base_path() . path_to_theme();?>/images/frontpage_illus/payment.png" alt="<?php print t('Choose payment method'); ?>" />
                    </div>
                    <div class="col-sm-9">
                        <h4 class="media-heading">Schritt 3: <strong> Zahlungsart auswählen</strong></h4>
                        <p><?php print t('Instead of having to pay cash or work your way through hundreds of bills each month you can now pay online. Receipts and tax reports are send right to your inbox.'); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3 col text-right">
                        <img class=" payment" src="<?php echo base_path() . path_to_theme();?>/images/frontpage_illus/delivery.png" alt="<?php print t('Choose payment method'); ?>" />
                    </div>
                    <div class="col-sm-9">
                        <h4 class="media-heading">Schritt 4: <strong> Abholen oder geliefert bekommen</strong></h4>
                      <p><?php print t('Once your order is complete, at an agreed upon time the vendor will deliver the products right to your door or prepare them for you to pick up.'); ?></p>
                    </div>
                </div>
          </div>
          <div class="modal-footer">
                <div class="row">
                    <div class="col-xs-8">
                        <p class="text-left"> <small> Haben Sie Fragen? Rufen Sie uns an oder schreiben Sie uns!</small> <br>
                            <a class="pull-left"  href="tel:+49091319291117"> <span class="fa fa-phone"></span> 09131-9291117</a>
                            <a class="pull-left" href="mailto:support@regiomino.de"> <span class="fa fa-paper-plane"></span> support@regiomino.de</a>
                            
                        </p>
                    </div>
                    <div class="col-xs-4"> 
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Alles klar!</button>
                    </div>
               </div>
            </div>
        </div><!--end modal contents-->
    </div><!--end modal dialog -->
</div>
 
 

