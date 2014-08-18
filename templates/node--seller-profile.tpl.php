<?php

/**
 *  Alle spannenden Sachen in $node
 */
 
    /* //Titel
    print $node->title;
     
    //Kategorien für den Verkäufer (nicht für die Produkte!)
    foreach($node->field_sellercategories[LANGUAGE_NONE] as $category) {
        print $category['taxonomy_term']->name;
    }
     
    //URLs für Verkäuferbilder
    foreach($node->field_image[LANGUAGE_NONE] as $sellerimage) {
        print image_style_url('image_style', $sellerimage['uri']);
    }

    //Beschreibung
    print $node->body[LANGUAGE_NONE][0]['value'];

    //Produkte
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
            
            foreach($variation->trading_units as $tradingunits) {
                //Gebindemenge
                print $tradingunits->field_tu_amount[LANGUAGE_NONE][0]['value'];
                //Gebinde-Nettopreis
                print number_format($tradingunits->field_tu_price[LANGUAGE_NONE][0]['value'], 2, ",", ".") . ' €';
                //Gebinde-Pfand
                print number_format($tradingunits->field_tu_deposit[LANGUAGE_NONE][0]['value'], 2, ",", ".") . ' €';
            }
        }
    } */

?>

<div class="col-sm-3 col-md-2 sidebar">
<?php
$block = module_invoke('rm_cart', 'block_view', 'rm_cart_block');
print render($block['content']);
?>
</div>
<div class="col-sm-9 col-md-10 main">
    <h2><?php print $node->title; ?></h2>
    
    <ul class="list-unstyled">
        <li><span class="glyphicon glyphicon-cutlery" ></span>
            <?php
            $all_tids = array();
            foreach($node->field_sellercategories[LANGUAGE_NONE] as $index => $tid) {
                $all_tids[] = (int)$tid['tid'];
            }

            $allterms = taxonomy_term_load_multiple($all_tids);
            foreach($allterms as $term) {
                print $term->name . ' ';
            }
            ?>
        </li>
        <li><span class="glyphicon glyphicon-road"></span> <?php print $node->field_address[LANGUAGE_NONE][0]['thoroughfare']; ?>, <?php print $node->field_address[LANGUAGE_NONE][0]['postal_code'] ?> <?php print $node->field_address[LANGUAGE_NONE][0]['locality']; ?></li>
    </ul>
    
    
    
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="<?php print image_style_url('thumbnail', $node->field_image[LANGUAGE_NONE][0]['uri']); ?>" alt="<?php print $node->title; ?>">
        </a>
        <div class="media-body">
            <?php print $node->body[LANGUAGE_NONE][0]['value']; ?>
        </div>
    </div>
    
    <?php $elements = 0; $tabsperrow = 3; ?>
    <?php foreach($node->offers as $offer): ?>
    
        <?php if(!($elements % $tabsperrow)): ?>
            <div class="row">
        <?php endif; ?>
        <?php $elements++; ?>
        <?php $closed = FALSE; ?>
        
        <div class="col-sm-<?php print 12/$tabsperrow; ?> col-md-<?php print 12/$tabsperrow; ?>">
            <div class="list-group">
                <!--Title-->
                <li class="list-group-item product-title">
                    <strong><?php print $offer->title; ?></strong>
                </li>
                <!--Body-->
                <li class="list-group-item product-body">
                    Dapibus ac facilisis in
                </li>
                <!--Cart-->
                <?php print l(t('Add to cart'), 'addtocart/1076/1074/1071/3', array('attributes' => array('class' => array('list-group-item', 'active', 'btn', 'product-cart')), 'query' => drupal_get_destination())); ?>
            </div>
        </div>
        
        <?php if(!($elements % $tabsperrow)): ?>
            </div>
        <?php endif; ?>
        <?php $closed = TRUE; ?>
    <?php endforeach; ?>
    
    <?php if(!$closed): ?></div><?php endif; ?>
    
</div>