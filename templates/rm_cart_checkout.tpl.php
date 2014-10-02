<?php
$form = $variables['form'];
?>
<div class="flexfix-wrapper clearfix"> 
    <div class="flexfix-content">
        <div class="flexfix-content-inner">
            <div class="row address checkout-item">
                <div class="col-md-12 title">
                    <h4>Rechnungsadresse angeben </h4>
                    <span class="text-muted pull-right"><small> *Pflichtfelder</small></span> 
                </div>
                
                <div class="col-lg-10 col-md-12">
                    <div class="row">
                        <div class="col-md-6 lpr"> 
                            <label for="surname">Vorname</label>
                            <input type="text" class="form-control" id="surname" placeholder="Vorname">
                        </div>
                        <div class="col-md-6 lpl"> 
                            <label for="name">Nachname</label>
                            <input type="text" class="form-control" id="name" placeholder="Nachname*">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 lpr">
                            <div class="row">
                                <div class="col-md-9 lpr">
                                    <label for="street">Straße</label>
                                    <input type="text" class="form-control" id="street" placeholder="Straße">
                                </div>
                                <div class="col-md-3 lpl">
                                   <label for="number">Nr.</label>
                                   <input type="text" class="form-control" id="number" placeholder="Nr.">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 lpl">
                            <div class="row">
                                <div class="col-md-4 lpr">
                                    <label for="postal-code">Postleitzahl</label>
                                    <input type="text" class="form-control" id="postal-code" placeholder="PLZ*">
                                </div>
                                <div class="col-md-8 lpl">
                                   <label for="location">Ort</label>
                                   <input type="text" class="form-control" id="location" placeholder="Ort*">
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
            
            
             <div class="row delivery checkout-item">
                <div class="col-md-12 title">
                    <h4>Lieferart wählen  </h4>
                </div>
                
                <div class="col-lg-10 col-md-12">
                    
                    <ul class="list-inline delivery-select">
                        <li class="active">
                            <input id="pickup" type="radio" name="delivery" value="pickup" checked>
                            <label data-target="#pickupoptions"  for="pickup">
                                Selbstabholung
                            </label>
                            <span class="sprite sprite-delivery-pickup-lg"></span>
                        </li>
                        
                        <li>
                            <input id="shipping" type="radio" name="delivery" value="shipping">
                            <label for="shipping"  data-target="#shippingoptions">
                               Lieferung
                            </label>
                            <span class="sprite sprite-delivery-truck-lg"></span>
                        </li>
                        
                        
                    </ul>
                    <div class="tab-content clearfix">
                        
                        <div id="pickupoptions" class="tab-pane active">
                         
                           <ul class="pickupspot-select">
                                <li class="clearfix"> 
                                    <label>
                                        <input type="radio" data-target="option1" name="pickupspot-options"  value="option1" checked>
                                            Theuerstadt 5, 56567 Bamberg <strong> (kostenlos) </strong>
                                    </label>
                                    <div id="option1" class="pickup-collapse collapse in">
                                        <div class="day pickuptime"> 
                                            <span class="fa fa-calendar"></span>
                                            <select class="form-control input-sm">
                                                    <option>Mo 12.04</option>
                                                    <option>Di 13.04</option>
                                                    <option>Mi 14.04 </option>
                                                    <option>Do 15.04</option>
                                                    <option>Fr 16.04</option>
                                                    <option>Sa 17.04</option>
                                              </select>
                                        </div>
                                        
                                        <div class="time pickuptime"> 
                                            <span class="fa fa-clock-o"></span>
                                            <select class="form-control input-sm">
                                                <option>12:30 - 15:00</option>
                                                <option>12:30 - 20:00</option>
                                                <option>12:30 - 15:00 </option>
                                                <option>12:30 - 15:00</option>
                                              </select>
                                        </div>
                                    </div>
                                </li>
                                <li class="clearfix"> 
                                    <label>
                                        <input data-target="option2" type="radio" name="pickupspot-options" value="option2">
                                         Stadtstraße 5, 56567 Bachstadt  <strong> (+10,50 €) </strong>
                                    </label>
                                    
                                    <div id="option2" class="pickup-collapse collapse">
                                        <div class="day pickuptime"> 
                                            <span class="fa fa-calendar"></span>
                                            <select class="form-control input-sm">
                                                    <option>Mo 12.04</option>
                                                    <option>Di 13.04</option>
                                                    <option>Mi 14.04 </option>
                                                    <option>Do 15.04</option>
                                                    <option>Fr 16.04</option>
                                                    <option>Sa 17.04</option>
                                              </select>
                                        </div>
                                        
                                        <div class="time pickuptime"> 
                                            <span class="fa fa-clock-o"></span>
                                            <select class="form-control input-sm">
                                                <option>12:30 - 15:00</option>
                                                <option>12:30 - 20:00</option>
                                                <option>12:30 - 15:00 </option>
                                                <option>12:30 - 15:00</option>
                                              </select>
                                        </div>
                                    </div>
                                </li>
                                
                                 <li class="clearfix"> 
                                    <label>
                                        <input data-target="option3" type="radio" name="pickupspot-options" value="option3">
                                         Käseallee 5, 56567 Käsestadt  <strong> (+30,50 €) </strong>
                                    </label>
                                    
                                    <div id="option3" class="pickup-collapse collapse">
                                        <div class="day pickuptime"> 
                                            <span class="fa fa-calendar"></span>
                                            <select class="form-control input-sm">
                                                    <option>Mo 12.04</option>
                                                    <option>Di 13.04</option>
                                                    <option>Mi 14.04 </option>
                                                    <option>Do 15.04</option>
                                                    <option>Fr 16.04</option>
                                                    <option>Sa 17.04</option>
                                              </select>
                                        </div>
                                        
                                        <div class="time pickuptime"> 
                                            <span class="fa fa-clock-o"></span>
                                            <select class="form-control input-sm">
                                                <option>12:30 - 15:00</option>
                                                <option>12:30 - 20:00</option>
                                                <option>12:30 - 15:00 </option>
                                                <option>12:30 - 15:00</option>
                                              </select>
                                        </div>
                                    </div>
                                </li>
                                
                            </ul>
                             
                        </div>
                       
                        <div id="shippingoptions" class="tab-pane">
                            Weekly
                        </div>
                        <div id="mailpoptions" class="tab-pane">
                            Montly
                        </div>
                    </div>
                </div>
            </div>
            
           
             <div class="row payment-method checkout-item">
                <div class="col-md-12 title">
                    <h4>Zahlungsart wählen </h4>
                   
                </div>
                
                <div class="col-lg-10 col-md-12">
                    
                    <ul class="list-inline payment-select">
                        <li>
                            <input id="debit"   type="radio" name="payment" value="debit">
                            <label class="debit" data-target="#debitoptions"  for="debit">
                                Lastschrift
                            </label>
                            <span class="sprite lastschrift-lg"></span>
                        </li>
                        
                        <li>
                            <input id="sofort" type="radio" name="payment" value="sofort">
                            <label for="sofort" data-target="#sofortoptions">
                               Sofortüberweisung
                            </label>
                            <span class="sprite sofort-lg"></span>
                        </li>
                        
                        <li>
                            <input id="paypal" type="radio" name="payment" value="paypal">
                            <label for="paypal" data-target="#paypalpoptions" >
                               PayPal
                            </label>
                             <span class="sprite paypal-lg"></span>
                        </li>
                    </ul>
                     
                    <div class="tab-content clearfix">
                        
                        <div id="debitoptions" class="tab-pane ">
                            <label> IBAN</label>
                            <input placeholder="IBAN" type="text" class="form-control"> 
                        </div>
                        
                        <div id="sofortoptions" class="tab-pane">
                             <small><strong>  Hinweis:</strong> 
                          Nach der Bestellung werden Sie weitergeleitet, um mit Sofortüberweisung zu bezahlen</small> 
                        </div>
                        
                         <div id="paypalpoptions" class="tab-pane">
                            <small><strong>  Hinweis:</strong> 
                          Nach der Bestellung werden Sie zu PayPal weitergeleitet, um die Bestellung abzuschließen</small> 
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            
         <input type="submit" id="edit-submit" name="op" value="Zahlungspflichtig bestellen" class="form-submit btn btn-primary btn-lg">   
        </div>
    </div> 
    
    <div class="flexfix-sidebar">
        <div class="cart-container"> 
            <?php 
            $block = module_invoke('rm_cart', 'block_view', 'rm_checkout_block');
                print render($block['content']);
            ?>
        </div>
    </div>
</div>

 
