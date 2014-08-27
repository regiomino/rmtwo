<?php
$form = $variables['form'];
//$form = drupal_get_form('rm_seller_offer_form');
$uid = $user->uid;
if(rm_user_is_admin()) $uid = 50;
$vars['offers'] = rm_shop_get_structured_seller_offers($uid, array(0,1));

?>

<div class="col-sm-12 col-md-12 main">

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
        <div class="col-sm-12 col-md-12">
            <strong>Titel</strong>
            <?php print render($form['offers']['offer_' . $offer->nid]['these_fields']['field_description_title-' . $offer->nid]); ?>
        </div>
        <div class="col-sm-6 col-md-6">
            <strong>Herkunft</strong>
            <?php print render($form['offers']['offer_' . $offer->nid]['these_fields']['field_origin_company-' . $offer->nid]); ?>
            <?php print render($form['offers']['offer_' . $offer->nid]['these_fields']['field_origin_zip-' . $offer->nid]); ?>
            <?php print render($form['offers']['offer_' . $offer->nid]['these_fields']['field_origin_locality-' . $offer->nid]); ?>
            <?php print render($form['offers']['offer_' . $offer->nid]['these_fields']['field_origin_country-' . $offer->nid]); ?>
        </div>
        <div class="col-sm-6 col-md-6">
            <?php //print render($form['offers']['offer_' . $offer->nid]['these_fields']['field_label_reference-' . $offer->nid]); ?>
        </div>
      </div>
      <!-- Table -->
      <table class="table">
        <thead>
          <tr>
            <th>Angebotsnr.</th>
            <th>Bezeichnung Variante</th>
            <th>Beschreibung</th>
            <!--<th>Bilder</th>-->
            <th>Produkteinheit</th>
            <th>Bestand</th>
            <th>GTIN (ehem. EAN)</th>
            <th>Gebinde</th>
            <th>Aktionen</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($offer->offer_variations as $variation): ?>
          <tr id="variation<?php print $variation->nid; ?>">
            <td class="vert-align">
                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['field_sku-' . $variation->nid]); ?>
            </td>
            <td>
                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['field_variation_title-' . $variation->nid]); ?>
            </td>
                
            <td>
                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['body-' . $variation->nid]); ?>
            </td>
           <!--<td>
                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['field_image-' . $variation->nid]); ?>
            </td>-->
            <td>
                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['field_productunit_amount-' . $variation->nid]); ?>
                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['field_productunit_unit-' . $variation->nid]); ?>
            </td>
            <td>
                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['field_stock-' . $variation->nid]); ?>
            </td>
            <td>
                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['these_fields']['field_gtin-' . $variation->nid]); ?>
            </td>
            <td>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Anzahl</th>
                            <th>Preis</th>
                            <th>MwSt.</th>
                            <th>Pfand</th>
                            <th>Gebindeart</th>
                            <th>Aktionen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($variation->trading_units as $tradingunit): ?>
                        <tr>
                            <td>
                                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['tradingunit_' . $tradingunit->nid]['these_fields']['field_tu_amount-' . $tradingunit->nid]); ?>
                            </td>
                            <td>
                                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['tradingunit_' . $tradingunit->nid]['these_fields']['field_tu_price-' . $tradingunit->nid]); ?>
                            </td>
                            <td>
                                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['tradingunit_' . $tradingunit->nid]['these_fields']['field_tu_vat-' . $tradingunit->nid]); ?>
                            </td>
                            <td>
                                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['tradingunit_' . $tradingunit->nid]['these_fields']['field_tu_deposit-' . $tradingunit->nid]); ?>
                            </td>
                            <td>
                                <?php print render($form['offers']['offer_' . $offer->nid]['variation_' . $variation->nid]['tradingunit_' . $tradingunit->nid]['these_fields']['field_tu_packaging-' . $tradingunit->nid]); ?>
                            </td>
                            <td>
                                <?php if(count($variation->trading_units) > 1) print l(t('Delete trading unit'), 'manage/seller/deleteoffer/' . $tradingunit->nid, array('query' => drupal_get_destination())); ?>
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
            <td>
                <?php if(count($offer->offer_variations) > 1) print l(t('Delete variation'), 'manage/seller/deleteoffer/' . $variation->nid, array('query' => drupal_get_destination())); ?>
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
    
    <?php print render($form['offers']['submit']); ?>
</div>

<?php
print drupal_render_children($form);
?>
