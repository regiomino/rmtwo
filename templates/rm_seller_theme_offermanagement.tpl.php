
<div class="col-sm-12 col-md-12 main">

<?php
$form = $vars['form'];
echo render($form['form_id']);
echo render($form['form_build_id']);
echo render($form['form_token']);
//print render($form);
?>

<?php foreach($vars['offers'] as $offer): ?>
    <?php
        switch($offer->status) {
            case 1:
                $state = 'success';
                $badge = l('<span class="glyphicon glyphicon-pause"></span> ' . t('Pause offer'), 'pauseoffer/' . $offer->nid, array('html' => TRUE, 'attributes' => array('class' => array('unpublish-link', 'btn', 'btn-warning', 'btn-sm', 'pull-right')), 'data-nid' => $offer->nid, 'query' => drupal_get_destination()));
                break;
            case 0:
                $state = 'danger';
                $badge = l('<span class="glyphicon glyphicon-play"></span> ' . t('Activate offer'), 'activateoffer/' . $offer->nid, array('html' => TRUE, 'attributes' => array('class' => array('unpublish-link', 'btn', 'btn-primary', 'btn-sm', 'pull-right')), 'data-nid' => $offer->nid, 'query' => drupal_get_destination()));
                break;
        }
    ?>
    <a name="<?php print $offer->nid; ?>" />
    <div class="panel panel-<?php print $state; ?>" id="offer<?php print $offer->nid; ?>">
      <!-- Default panel contents -->
      <div class="panel-heading">
          <div class="row">
              <div class="col-sm-8 col-md-8">
                <h5><strong><?php print l($offer->title, '#collapse' . $offer->nid, array('external' => TRUE, 'attributes' => array('data-toggle' => 'collapse', 'data-parent' => '#accordion'))); ?></strong></h5>
              </div>
              <div class="col-sm-4 col-md-4">
                <?php print l('<span class="glyphicon glyphicon-remove"></span> ' . t('Delete complete offer'), 'manage/seller/deleteoffer/' . $offer->nid, array('html' => TRUE, 'attributes' => array('class' => array('unpublish-link', 'btn', 'btn-danger', 'btn-sm', 'pull-right')), 'data-nid' => $offer->nid, 'query' => drupal_get_destination())) ?>&nbsp;
                <?php print $badge; ?>
              </div>
          </div>
      </div>
      <div id="collapse<?php print $offer->nid; ?>" class="panel-collapse collapse">
      <div class="panel-body">
        <div class="col-sm-6 col-md-6">
            <?php print render($form['offers']['offer_' . $offer->nid]['these_fields']['field_origin']); ?>
            <!--<label>Herkunft</label>
            <div class="col-md-12">
                <input id="offer_description-field_origin_company-4523" type="text" class="offer_description field_origin_company form-control" value="<?php print $offer->field_origin[LANGUAGE_NONE][0]['organisation_name']; ?>" placeholder="Firma" />
            </div>
            <div class="col-md-3">
                <input id="offer_description-field_origin_zip-4523" type="text" class="offer_description field_origin_zip form-control" value="<?php print $offer->field_origin[LANGUAGE_NONE][0]['postal_code']; ?>" placeholder="PLZ" />
            </div>
            <div class="col-md-4">
                <input id="offer_description-field_origin_city-4523" type="text" class="offer_description field_origin_city form-control" value="<?php print $offer->field_origin[LANGUAGE_NONE][0]['locality']; ?>" placeholder="Ort" />
            </div>
            <div class="col-md-5">
                <?php print rm_api_return_country_select($offer->field_origin[LANGUAGE_NONE][0]['country'], 'form-control', 'de'); ?>
            </div>-->
        </div>
        <div class="col-sm-6 col-md-6">
            <?php print render($form['offers']['offer_' . $offer->nid]['these_fields']['field_label_reference']); ?>
        </div>
      </div>
      <!-- Table -->
      <table class="table">
        <thead>
          <tr>
            <th>Angebotsnr.</th>
            <th>Bezeichnung Variante</th>
            <th>Beschreibung</th>
            <th>Bilder</th>
            <th>Produkteinheit</th>
            <th>Bestand</th>
            <th>GTIN (ehem. EAN)</th>
            <th>Gebinde</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($offer->offer_variations as $variation): ?>
          <tr id="variation<?php print $variation->nid; ?>">
            <td class="vert-align">
                <!--<input type="text" class="form-control" placeholder="WB-1-772" value="<?php print $variation->field_sku[LANGUAGE_NONE][0]['value']; ?>" />-->
                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['field_sku']); ?>
            </td>
            <td>
                <!--<input type="text" class="form-control" placeholder="750ml" value="<?php print $variation->title; ?>" />-->
                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['field_title']); ?>
            </td>
                
            <td>
                <!--<textarea class="form-control" placeholder="aus der eigenen Mühle, in 750ml Flaschen"><?php print strip_tags($variation->body[LANGUAGE_NONE][0]['value']); ?></textarea>-->
                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['body']); ?>
            </td>
            <td>
                <!--<?php if(isset($variation->field_image[LANGUAGE_NONE])): foreach($variation->field_image[LANGUAGE_NONE] as $productimage): ?>
                    <img src="<?php print image_style_url('thumbnail', $productimage['uri']); ?>" />
                <?php endforeach; endif; ?>
                <br /><a href="#" class="btn btn-sm btn-primary">Bilder verwalten</a>-->
                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['field_image']); ?>
            </td>
            <td>
                <!--<div class="input-group"  style="width: 150px;">
                    <input type="text" class="form-control" placeholder="Menge" value="<?php print $variation->field_productunit[LANGUAGE_NONE][0]['first']; ?>" />
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php print t($variation->field_productunit[LANGUAGE_NONE][0]['second']); ?> <span class="caret"></span></button>
                        <ul class="dropdown-menu dropdown-menu-right dropdown_unit_unit">
                            <li><a href="#">St.</a></li>
                            <li><a href="#">Bd.</a></li>
                            <li><a href="#">Paar</a></li>
                            <li><a href="#">ml</a></li>
                            <li><a href="#">l</a></li>
                            <li><a href="#">g</a></li>
                            <li><a href="#">mg</a></li>
                        </ul>
                        <input type="hidden" class="hidden_unit_unit" id="unit_unit_<?php print $variation->nid; ?>" />
                    </div>
                </div>-->
                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['field_productunit']); ?>
            </td>
            <td>
                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['field_stock']); ?>
            </td>
            <td>
                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['field_gtin']); ?>
            </td>
            <td>
                <!--<div class="list-group">
                    <?php $counter = 0; foreach($variation->trading_units as $tradingunit): $counter++;?>
                        <a href="#" class="list-group-item">
                            <span class="glyphicon glyphicon-pencil"></span> <?php print $counter; ?>. Gebinde: <?php //print $tradingunit->field_tu_amount[LANGUAGE_NONE][0]['value']; ?> Einheiten für <?php //print number_format($tradingunit->field_tu_price[LANGUAGE_NONE][0]['value'], 2, ",", "."); ?>€ (zzgl. <?php //print $tradingunit->field_tu_vat[LANGUAGE_NONE][0]['value']; ?>% MwSt. und <?php //print number_format($tradingunit->field_tu_deposit[LANGUAGE_NONE][0]['value'], 2, ",", "."); ?>€ Pfand)
                        </a>
                    <?php endforeach; ?>
                    <a href="#" class="list-group-item active">
                        <span class="glyphicon glyphicon-plus"></span> Gebinde hinzufügen
                    </a>
                </div>-->
                <table>
                    <thead>
                        <tr>
                            <th>Anzahl</th>
                            <th>Preis</th>
                            <th>MwSt.</th>
                            <th>Pfand</th>
                            <th>Gebindeart</th>
                            <th>Löschen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($variation->trading_units as $tradingunit): ?>
                        <tr>
                            <td>
                                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['tradingunit_' . $tradingunit->nid]['these_fields']['field_tu_amount']); ?>
                            </td>
                            <td>
                                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['tradingunit_' . $tradingunit->nid]['these_fields']['field_tu_price']); ?>
                            </td>
                            <td>
                                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['tradingunit_' . $tradingunit->nid]['these_fields']['field_tu_vat']); ?>
                            </td>
                            <td>
                                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['tradingunit_' . $tradingunit->nid]['these_fields']['field_tu_deposit']); ?>
                            </td>
                            <td>
                                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['tradingunit_' . $tradingunit->nid]['these_fields']['field_tu_packaging']); ?>
                            </td>
                            <td>
                                <?php print l(t('Delete'), 'manage/seller/deleteoffer/' . $tradingunit->nid, array('query' => drupal_get_destination())); ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="6">
                                
                                <?php print l('<span class="glyphicon glyphicon-plus"></span> ' . t('Add trading unit'), 'addtradingunit/' . $variation->nid, array('html' => TRUE, 'query' => drupal_get_destination(), 'attributes' => array('class' => array('btn', 'btn-primary')))); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
          </tr>
          <?php endforeach; ?>
          <tr>
            <td colspan="6">
                <?php print l('<span class="glyphicon glyphicon-plus"></span> ' . t('Add offer variation'), 'addoffervariation/' . $offer->nid, array('html' => TRUE, 'query' => drupal_get_destination(), 'attributes' => array('class' => array('btn', 'btn-primary')))); ?>
            </td>
          </tr>
        </tbody>
      </table>
      
      </div>
    </div>
    
    <?php endforeach; ?>
    
    <!--<a href="#" class="btn btn-lg btn-primary">Weiteres Angebot hinzufügen</a>-->
    
    <?php print render($form['offers']['submit']); ?>
</div>