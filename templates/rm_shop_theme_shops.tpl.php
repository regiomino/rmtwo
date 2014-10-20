<div class="map ">
    <div id="map" style="width: 100%; height: 100%"></div>
</div>

<div class="sidebar">
    <div class="filter-area" id="filter">
        <?php global $user; if($user->uid <= 0): ?>
            <div class="alert alert-info" role="alert">Bitte <?php print l('loggen Sie sich ein', 'user/register', array('query' =>             drupal_get_destination())); ?>, um die mit Ihnen vereinbarten Liefer- und Zahlungsbedingungen nutzen zu können</div>
        <?php endif;?>
        
        <!-- <?php if (!empty($vars['title'])): ?>
            <h1 class="h5">
                <?php print $vars['title']; ?>
            </h1>
        <?php endif; ?> -->
        
      <!--  <div class="input-group">
            <input placeholder="<?php print t('Schnellsuche'); ?> " id="filterShops" type="text" class="form-control">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button"><span class="fa fa-search"></span></button>
            </span>
        </div> -->
        
        <div class="row distance">
            <div class="col-md-3">
               Schnellsuche
            </div>
            <div class="col-md-8">
                   <div class="input-group" style="width: 100%;">
            <input placeholder="<?php print t('Schnellsuche'); ?> " id="filterShops" type="text" class="form-control">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button"><span class="fa fa-search"></span></button>
            </span>
        </div>
            </div>
            <div class="col-md-1"></div>
            
        </div>
        
       <!-- <div class="row distance">
            <div class="col-md-3">
                Entfernung (km)
            </div>
            <div class="col-md-8">
                    <div id="distance-slider"></div> 
            </div>
            <div class="col-md-1"></div>
        </div>
        -->
         <div class="row category-filter">
            <div class="col-md-3" style="margin-bottom :  10px;">
                 Filter
            </div>
            <div class="col-md-8">
                <div class="filter-wrapper">
                    
                     <div class="filter" data-filtertype="seller_type">
                        <div class="filter-name">
                            <div class="filter-name-text" data-defaulttext="Betrieb" data-filtertype="seller_type">Betrieb</div>
                            <span class="show-more fa fa-caret-down"></span>
                            <span class="reset fa fa-times" data-filtertype="seller_type"></span>
                        </div> <!-- end filter-name -->
                        <div class="filter-content">
                            <ul class="filter-terms filter-terms-seller_type" data-filtertype="seller_type">
                                <?php foreach($vars['categories'] as $term): ?>
                                <div class="term-wrapper"> 
                                    <li data-term="<?php print $term->tid; ?>">
                                        <div class="filter-checkbox"><i class="fa fa-check"></i></div>
                                        <span class="checkbox-label"><?php print $term->name; ?></span>
                                    </li>
                                </div>
                                <?php endforeach; ?>
                            </ul>
                        </div><!-- end filter-content -->
                    </div><!--end filter-->
                    
                     <div class="filter" data-filtertype="delivery_option">
                        <div class="filter-name">
                            <div class="filter-name-text" data-defaulttext="Lieferoptionen" data-filtertype="delivery_option">Lieferoptionen</div>
                            <span class="show-more fa fa-caret-down"></span>
                            <span class="reset fa fa-times" data-filtertype="delivery_option"></span>
                        </div> <!-- end filter-name -->
                        <div class="filter-content">
                            <ul class="filter-terms filter-terms-delivery_type" data-filtertype="delivery_option">
                                <div class="term-wrapper"> 
                                    <li data-term="pickup">
                                        <div class="filter-checkbox"><i class="fa fa-check"></i></div>
                                        <span class="checkbox-label">Selbstabholung</span>
                                    </li>
                                </div>
                                <div class="term-wrapper"> 
                                    <li data-term="delivery">
                                        <div class="filter-checkbox"><i class="fa fa-check"></i></div>
                                        <span class="checkbox-label">Lieferung</span>
                                    </li>
                                </div>
                                 <!--<div class="term-wrapper"> 
                                    <li data-term="postversand">
                                        <div class="filter-checkbox"><i class="fa fa-check"></i></div>
                                        <span class="checkbox-label">Postversand</span>
                                    </li>
                                </div>-->
                            </ul>
                        </div><!-- end filter-content -->
                    </div><!--end filter-->
                    
 
                    <div class="filter" data-filtertype="payment_type">
 
                        <div class="filter-name">
                            <div class="filter-name-text" data-defaulttext="Zahlungsarten" data-filtertype="payment_type">Zahlungsarten</div>
                            <span class="show-more fa fa-caret-down"></span>
                            <span class="reset fa fa-times" data-filtertype="payment_type"></span>
                        </div> <!-- end filter-name -->
                 
                        <div class="filter-content">
                            <ul class="filter-terms filter-terms-paymenttype" data-filtertype="payment_type">
                                 <div class="term-wrapper"> 
                                    <li data-term="prepaid">
                                        <div class="filter-checkbox"><i class="fa fa-check"></i></div>
                                        <span class="checkbox-label">PayPal, Sofortüberweisung</span>
                                    </li>
                                </div>
                                <div class="term-wrapper"> 
                                    <li  data-term="invoice">
                                        <div class="filter-checkbox"><i class="fa fa-check"></i></div>
                                        <span class="checkbox-label">Rechnung</span>
                                    </li>
                                </div>
                                 <div class="term-wrapper"> 
                                    <li data-term="cash">
                                        <div class="filter-checkbox"><i class="fa fa-check"></i></div>
                                        <span class="checkbox-label">Bar</span>
                                    </li>
                                </div>
                                
                            </ul>
                        </div><!-- end filter-content -->
                    </div><!--end filter-->
                    
                </div><!--end filte-wrapper-->
            </div><!--end col -md-9-->
             <div class="col-md-1"></div>
        </div>
    </div><!-- end filter area-->
        
            <div class="col-xs-12 seller-area" id="sellers">
                <div class="row"> 
                <?php print theme('rm_shop_theme_filteredshops', array(
                    'vars' => array(
                        'shops' => $vars['shops'],
                    ),
                 )); ?>
            </div> <!--end row -->
        </div><!--end seller-area -->
   

   
    <?php print $vars['pager']; ?>
</div>

