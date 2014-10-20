<?php
$form = $variables['form'];
//$form = drupal_get_form('rm_seller_offer_form');
$uid = $user->uid;
if(rm_user_is_admin()) $uid = 50;
$vars['offers'] = rm_shop_get_structured_seller_offers($uid, array(0,1));

?>
<div class="row">

    <h1 class="page-header">Angebotsverwaltung</h1>
    
    <div class="col-md-12">
        <div class="panel-group" id="accordion">
        <?php foreach($vars['offers'] as $offer): ?>
            <?php
                switch($offer->status) {
                    case 1:
                        $state = 'success';
                        $badge = l('<span class="fa  fa-circle danger"></span> ' . t('Pause offer'), 'pauseoffer/' . $offer->nid, array('html' => TRUE, 'data-nid' => $offer->nid, 'query' => drupal_get_destination()));
                        break;
                    case 0:
                        $state = 'danger';
                        $badge = l('<span class="fa fa-circle success"></span> ' . t('Activate offer'), 'activateoffer/' . $offer->nid, array('html' => TRUE, 'data-nid' => $offer->nid, 'query' => drupal_get_destination()));
                        break;
                }
        ?>
            <div class="panel panel-default id="offer<?php print $offer->nid; ?>">
                   
                <div class="panel-heading">
                    
                    <div class="btn-group">
                        <button class="btn btn-default dropdown-toggle state-toggle" type="button" data-toggle="dropdown">
                            <span class="fa fa-circle <?php print $state; ?>" > </span>
                            <span class="caret text-muted"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><?php print $badge; ?></li>
                        </ul>
                    </div>
                    
                    <div class="offer-title">
                        <?php if($state == 'success'): ?>
                        <?php print l('<span class="fa fa-chevron-up"> </span>'. $offer->title, '#collapse' . $offer->nid, array('html' => true, 'external' => TRUE, 'attributes' => array('data-toggle' => 'collapse', 'class' =>array('collapsed'), 'data-parent' => '#accordion'))); ?></strong></h5>
                        <?php else: ?>
                          <?php print l('<span class="fa fa-chevron-up"> </span>'. $offer->title, '#collapse' . $offer->nid, array('html' => true, 'external' => TRUE, 'attributes' => array('data-toggle' => 'collapse','class' => array('text-muted', 'collapsed'), 'data-parent' => '#accordion'))); ?></strong></h5>
                        <?php endif; ?>
                    </div>
                
                    <div class="offer-actions">
                        <?php if($state == 'success'):  
                            print l('<span class="fa fa-trash"></span> ' , 'manage/seller/deleteoffer/' . $offer->nid, array('html' => TRUE, 'attributes' => array('class' => array('btn-default btn')), 'data-nid' => $offer->nid, 'query' => drupal_get_destination()));
                        else:
                            print l('<span class="fa fa-trash text-muted"></span> ' , 'manage/seller/deleteoffer/' . $offer->nid, array('html' => TRUE, 'attributes' => array('class' => array('btn-default btn')), 'data-nid' => $offer->nid, 'query' => drupal_get_destination()));
                        endif; ?>
                    </div> 
                </div><!-- end panel-heading-->
                 
                <div id="collapse<?php print $offer->nid; ?>" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="base-info col-md-12">
                               <!-- <h4><strong>Allgemeines </strong> </h4> -->
                                <div class="row">
                                    <div class="col-md-2">
                                        <span class="lbl">Titel</span> 
                                    </div>
                                    <div class="col-md-10">
                                        <?php print render($form['offers']['offer_' . $offer->nid]['these_fields']['field_description_title-' . $offer->nid]); ?>
                                    </div>
                                </div>
                                    
                                <div class="row">
                                    <div class="col-md-2">
                                        <span class="lbl">Herkunft </span>
                                    </div>
                                    <div class="col-md-10">
                                        <?php print render($form['offers']['offer_' . $offer->nid]['these_fields']['field_origin_company-' . $offer->nid]); ?>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <?php print render($form['offers']['offer_' . $offer->nid]['these_fields']['field_origin_zip-' . $offer->nid]); ?>
                                            </div>
                                            <div class="col-md-8">
                                                <?php print render($form['offers']['offer_' . $offer->nid]['these_fields']['field_origin_locality-' . $offer->nid]); ?>
                                            </div>
                                        </div>
                                        <?php print render($form['offers']['offer_' . $offer->nid]['these_fields']['field_origin_country-' . $offer->nid]); ?>
                                    </div>
                                </div>
                                
                                <!-- <div class="row">
                                    <div class="col-md-2">
                                        <span class="lbl">Produktsiegel</span> 
                                    </div>
                                    <div class="col-md-10">
                                        sfsf
                                    </div>
                                </div>-->
                                
                            </div> <!--end base-info-->
                        </div><!--end row-->
                
                        <div class="row">
                            
                            <!-- product variations -->
                            <div class="product-variants col-md-12">
                                <h4>
                                    <strong>Produktvarianten </strong>
                                </h4>
                                 <?php $first = true; ?>
                                <div class="tabarea clearfix"> 
                                    <ul id="myTab" class="nav nav-tabs" role="tablist">
                                        <?php foreach($offer->offer_variations as $variation): ?>
                                            <li <?php if($first): print 'class="active"'; endif; ?>> 
                                                <a href="#variation<?php print $variation->nid; ?>" class="tabtitle" role="tab" data-toggle="tab">
                                                    <?php  print $variation->title; ?>
                            
                                                </a>
                                                <?php if(count($offer->offer_variations) > 1):
                                                        print l('<span class="fa fa-trash"></span>', 'manage/seller/deleteoffer/' . $variation->nid, array('html' => TRUE, 'query' => drupal_get_destination(), 'attributes' => array('class' => array('btn','delete', 'btn-default'))));
                                                    endif;
                                                    ?>
                                            </li>
                                            <?php $first = false; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                    <?php print render($form['offers']['offer_' . $offer->nid]['these_fields']['add_variation_button-' . $offer->nid]); ?>
                                </div>
                   
                                <div id="tabContent" class="tab-content">
                                        <?php $first = true; ?>
                                        <?php foreach($offer->offer_variations as $variation): ?>
                                            <div class="tab-pane <?php if($first): print 'active'; endif; ?> in" id="variation<?php print $variation->nid; ?>">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                       <span class="lbl">Bezeichnung Variante</span> 
                                                        <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['field_variation_title-' . $variation->nid]); ?>
                        
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <span class="lbl">Angebotsnummer</span>
                                                                 <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['field_sku-' . $variation->nid]); ?>
                                                            </div>
                                                            <div class="col-md-6"> 
                                                                <span class="lbl">GTIN (ehem. EAN)</span>
                                                                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['field_gtin-' . $variation->nid]); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                       <span class="lbl">Beschreibung</span> 
                                                        <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['body-' . $variation->nid]); ?>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span class="lbl">Bilder</span>
                                                         <?php if(!empty($variation->field_image[LANGUAGE_NONE])): foreach($variation->field_image[LANGUAGE_NONE] as $image_delta => $image): $destination = drupal_get_destination(); ?>
                                                            <div class="preview-image">
                                                                <img src="<?php print image_style_url('preview_image', $image['uri']); ?>" alt="<?php print $variation->title; ?>">
                                                                <a href="/deleteimage/<?php print $variation->nid; ?>/<?php print $image_delta; ?>">
                                                                    <span class="fa-stack">
                                                                        <i class="fa fa-circle fa-stack-2x"></i>
                                                                        <i class="fa fa-trash fa-stack-1x fa-inverse"></i>
                                                                    </span>
                                                                </a>
                                                            </div>                    
                                                        <?php endforeach; endif; ?>
                                                        <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['field_image-' . $variation->nid]); ?>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-5 productunit">
                                                                <span class="lbl">Produkteinheit</span>
                                                                <div class="row">
                                                                     <div class="col-md-5">
                                                                    <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['field_productunit_amount-' . $variation->nid]); ?>
                                                                     </div>
                                                                     <div class="col-md-7"> 
                                                                    <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['field_productunit_unit-' . $variation->nid]); ?>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                 <span class="lbl">Bestand</span>
                                                                  <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['field_stock-' . $variation->nid]); ?>
                                                             </div>
                                                            <div class="col-md-4">
                                                                 <span class="lbl">Vorlaufzeit (in Std.)</span>
                                                                      <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['field_leadtime-' . $variation->nid]); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                     <span class="lbl">Haltbarkeit (in Tagen)</span>
                                                                      <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['field_use_within-' . $variation->nid]); ?>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                         <span class="lbl">Mindesthaltbarkeitsdatum</span>
                                                                      <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['field_expiration_date-' . $variation->nid]); ?>
                                                                     </div>
                                                                     
                                                                </div>
                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                 <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="table-responsive">
                                                            <span class="lbl">Gebinde</span>
                                                            <table class="table table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="number">#</th>
                                                                        <th>Anzahl</th>
                                                                        <th class="binding-type">Gebindeart</th>
                                                                        <th>Preis (in €)</th>
                                                                        <th class="vat">MwSt.</th>
                                                                        <th>Pfand (in €)</th>
                                                                        <th >Aktionen</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $tucounter = 0; foreach($variation->trading_units as $tradingunit): $tucounter++;?>
                                                                    <tr>
                                                                        <td><?php print $tucounter; ?></td>
                                                                        <td> <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['tradingunit_' . $tradingunit->nid]['these_fields']['field_tu_amount-' . $tradingunit->nid]); ?></td>
                                                                        <td> <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['tradingunit_' . $tradingunit->nid]['these_fields']['field_tu_packaging-' . $tradingunit->nid]); ?></td>
                                                                        <td><?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['tradingunit_' . $tradingunit->nid]['these_fields']['field_tu_price-' . $tradingunit->nid]); ?></td>
                                                                        <td><?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['tradingunit_' . $tradingunit->nid]['these_fields']['field_tu_vat-' . $tradingunit->nid]); ?></td>
                                                                        <td> <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['tradingunit_' . $tradingunit->nid]['these_fields']['field_tu_deposit-' . $tradingunit->nid]); ?></td>
                                                                        <td class="actions">
                                                                            <?php if(count($variation->trading_units) < 2):
                                                                                print l('<span class="fa-stack"><i class="fa fa-trash fa-stack-1x"></i><i class="fa fa-ban fa-4x fa-stack-2x"></i> </span>', 'manage/seller/deleteoffer/' . $tradingunit->nid, array( 'html' => TRUE, 'attributes' => array('class' => array('btn', 'btn-default', 'disabled')), 'query' => drupal_get_destination()));
                                                                            
                                                                            else:
                                                                            print l('<span class="fa fa-trash"></span>', 'manage/seller/deleteoffer/' . $tradingunit->nid, array( 'html' => TRUE, 'attributes' => array('class' => array('btn', 'btn-default')), 'query' => drupal_get_destination()));

                                                                            
                                                                            endif; ?>
                                                                        
                                                                        </td>
                                                                    </tr>
                                                                   <?php endforeach; ?>
                                                                </tbody>
                                                            </table>
                                                           <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['add_tu_button-' . $variation->nid]); //l('<span class="fa fa-plus"></span> ' . t('Add trading unit'), 'addtradingunit/' . $variation->nid, array('html' => TRUE, 'query' => drupal_get_destination(), 'attributes' => array('class' => array('btn', 'btn-primary')))); ?>

                                                        </div><!--end table-responsive-->
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                        <?php $first = false; ?>
                                        <?php endforeach;?>
                                        
                                </div>   <!-- end tabContent -->
                            </div><!-- end product-variants-->
                        </div><!--end row -->
                    </div><!-- end panel-body-->   
                </div><!-- end collapse -->
            </div><!-- end panel-->
            
        <?php endforeach; ?>
        </div><!-- panel-group -->
    </div><!--end col-md-12-->
    <?php print render($form['offers']['submit']); ?>
</div><!-- end row -->
<?php print drupal_render_children($form); ?>
