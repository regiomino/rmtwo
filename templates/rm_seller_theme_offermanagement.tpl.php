
<div class="col-sm-12 col-md-12 main">

<?php
/*
foreach($node->offers as $offer) {
        //Übergeordneter Titel
        print $offer->title;
        //Produktherkunft Firma
        print $offer->field_origin[LANGUAGE_NONE][0]['organisation_name'];
        //Produktherkunft PLZ
        print $offer->field_origin[LANGUAGE_NONE][0]['postal_code'];
        //Produktherkunft Ort
        print $offer->field_origin[LANGUAGE_NONE][0]['locality'];
        //Produktherkunft Land
        print $offer->field_origin[LANGUAGE_NONE][0]['country'];
        
        foreach($offer->offer_variations as $variation) {
            //Titel der Produktvariante
            print $variation->title;
            //Produkteinheit (Menge)
            print $variation->field_productunit[LANGUAGE_NONE][0]['first'];
            //Produkteinheit (Einheit)
            print $variation->field_productunit[LANGUAGE_NONE][0]['second'];
            //URLs für Produktbilder
            foreach($variation->field_image[LANGUAGE_NONE] as $productimage) {
                print image_style_url('image_style', $productimage['uri']);
            }
            //Produktbeschreibung
            print $variation->body[LANGUAGE_NONE][0]['value'];
            
            foreach($variation->trading_units as $tradingunit) {
                //Gebindemenge
                print $tradingunit->field_tu_amount[LANGUAGE_NONE][0]['value'];
                //Gebinde-Nettopreis
                print number_format($tradingunit->field_tu_price[LANGUAGE_NONE][0]['value'], 2, ",", ".") . ' €';
                //Gebinde-Pfand
                print number_format($tradingunit->field_tu_deposit[LANGUAGE_NONE][0]['value'], 2, ",", ".") . ' €';
            }
        }
    }
    
*/
?>

<?php foreach($vars['offers'] as $offer): ?>
    <?php
        switch($offer->status) {
            case 1:
                $state = 'success';
                $badge = '<a id="unpublish' . $offer->nid . '" href="#">Angebot pausieren</a>';
                break;
            case 0:
                $state = 'danger';
                $badge = '<a id="publish' . $offer->nid . '" href="#">Angebot aktivieren</a>';
                break;
        }
    ?>
    <div class="panel panel-<?php print $state; ?>" id="offer<?php print $offer->nid; ?>">
      <!-- Default panel contents -->
      <div class="panel-heading"><span class="badge pull-right"><a id="delete<?php print $offer->nid; ?>" href="#">Komplettes Angebot löschen</a></span><span class="badge pull-right"><a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php print $offer->nid; ?>">Bearbeiten</a></span><span class="badge pull-right"><?php print $badge; ?></span><br /><input id="offer_description-title-4523" type="text" class="offer_description form-control" value="<?php print $offer->title; ?>" placeholder="Produkttitel, z.B. 'Kaltgepresstes Rapsöl'" /></div>
      <div id="collapse<?php print $offer->nid; ?>" class="panel-collapse collapse">
      <div class="panel-body">
        <div class="col-sm-6 col-md-6">
            <label>Herkunft</label>
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
            </div>
        </div>
        <div class="col-sm-6 col-md-6">
            <div class="col-md-4">
                Siegel 1
            </div>
            <div class="col-md-4">
                Siegel 2
            </div>
            <div class="col-md-4">
                Siegel 3
            </div>
            <div class="col-md-4">
                Siegel 4
            </div>
            <div class="col-md-4">
                Siegel 5
            </div>
            <div class="col-md-4">
                Siegel 6
            </div>
            <div class="col-md-4">
                Siegel 7
            </div>
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
            <th>Gebinde</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($offer->offer_variations as $variation): ?>
          <tr id="variation<?php print $variation->nid; ?>">
            <td class="vert-align"><input type="text" class="form-control" placeholder="WB-1-772" value="<?php print $variation->field_sku[LANGUAGE_NONE][0]['value']; ?>" /></td>
            <td><input type="text" class="form-control" placeholder="750ml" value="<?php print $variation->title; ?>" /></td>
            <td><textarea class="form-control" placeholder="aus der eigenen Mühle, in 750ml Flaschen"><?php print strip_tags($variation->body[LANGUAGE_NONE][0]['value']); ?></textarea></td>
            <td><a href="#" class="btn btn-sm btn-primary">Bilder hinzufügen</a></td>
            <td>
                <div class="input-group"  style="width: 150px;">
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
                </div>
            </td>
            <td>
                <div class="list-group">
                    <?php $counter = 0; foreach($variation->trading_units as $tradingunit): $counter++;?>
                        <a href="#" class="list-group-item">
                            <span class="glyphicon glyphicon-pencil"></span> <?php print $counter; ?>. Gebinde: <?php print $tradingunit->field_tu_amount[LANGUAGE_NONE][0]['value']; ?> Einheiten für <?php print number_format($tradingunit->field_tu_price[LANGUAGE_NONE][0]['value'], 2, ",", "."); ?>€ (zzgl. <?php print $tradingunit->field_tu_vat[LANGUAGE_NONE][0]['value']; ?>€ MwSt. und <?php print number_format($tradingunit->field_tu_deposit[LANGUAGE_NONE][0]['value'], 2, ",", "."); ?>€ Pfand)
                        </a>
                    <?php endforeach; ?>
                    <a href="#" class="list-group-item active">
                        <span class="glyphicon glyphicon-plus"></span> Gebinde hinzufügen
                    </a>
                </div>
            </td>
          </tr>
          <?php endforeach; ?>
          <tr>
            <td colspan="6">
                <a href="#" class="btn btn-primary">Angebotsvariante hinzufügen</a>
            </td>
          </tr>
        </tbody>
      </table>
      
      </div>
    </div>
    
    <?php endforeach; ?>
    
    <a href="#" class="btn btn-lg btn-primary">Weiteres Angebot hinzufügen</a>
</div>