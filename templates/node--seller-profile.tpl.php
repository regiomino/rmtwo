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
    
    <br />
    
    <?php $elements = 0; $tabsperrow = 3; ?>
    <?php foreach($node->offers as $offer): ?>
        <?php $onlyone = FALSE; ?>
        <?php if(count($offer->offer_variations) == 1) $onlyone = TRUE; ?>
        
        <?php if(!($elements % $tabsperrow)): ?>
            <div class="row">
        <?php endif; ?>
        <?php $elements++; ?>
        <?php $closed = FALSE; ?>
        
        <div class="col-sm-<?php print 12/$tabsperrow; ?> col-md-<?php print 12/$tabsperrow; ?>">
            <div class="list-group product-list-group">
                <!--Title-->
                <li class="list-group-item product-title">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <span class="label label-success label-price pull-right">6 x 7,5kg für 15,50 €</span>
                            <div class="dropdown">
                                <a href="#" id="dropdownMenu<?php print $offer->nid; ?>" class="dropdown-toggle" data-toggle="dropdown"><strong><?php print $offer->offer_variations[0]->title; ?></strong> <?php if(!$onlyone): ?><span class="caret"></span><?php endif; ?></a>
                                <?php if(!$onlyone): ?>
                                    <ul class="dropdown-menu dropdown-variation" role="menu" aria-labelledby="dropdownMenu<?php print $offer->nid; ?>">
                                    <?php foreach($offer->offer_variations as $variation): ?>
                                        <li role="presentation" data-variation-nid="<?php print $variation->nid; ?>"><a role="menuitem" tabindex="-1" href="#"><?php print $variation->title; ?></a></li>
                                    <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </li>
                    
                
                <?php $counter = 0; $hidden = ''; foreach($offer->offer_variations as $variation): ?>
                <?php if($counter) $hidden = ' hidden'; ?>
                <!--Body-->
                <li class="list-group-item product-body product-body-<?php print $variation->nid; ?><?php print $hidden; ?>">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 center">
                            <p class="text-center"></p>
                        </div>
                    </div>
                    <div class="row" style="min-height: 100px;">
                        <?php $columnsize = 6; if(!empty($variation->field_image[LANGUAGE_NONE][0]['uri'])): $columnsize = 4; ?><div class="col-sm-<?php print $columnsize; ?> col-md-<?php print $columnsize; ?> small"><img src="<?php print image_style_url('thumbnail', $variation->field_image[LANGUAGE_NONE][0]['uri']); ?>" alt="<?php print $variation->title; ?>" /></div><?php endif; ?>
                        <div class="col-sm-<?php print $columnsize; ?> col-md-<?php print $columnsize; ?> small">
                            Produktionsort:<br />
                            <?php print drupal_render(addressfield_generate($offer->field_origin[LANGUAGE_NONE][0], array('organisation' => 'organisation', 'address' => 'address'), array('mode' => 'render'))); ?>
                        </div>
                        <div class="col-sm-<?php print $columnsize; ?> col-md-<?php print $columnsize; ?> small">
                            Siegel
                        </div>
                    </div>
                </li>
                <!--Cart-->
                <?php print l('<span class="glyphicon glyphicon-plus"></span> ' . t('Add to cart'), 'addtocart/' . $offer->nid . '/' . $variation->nid . '/' . $variation->trading_units[0]->nid . '/1', array('html' => TRUE, 'attributes' => array('class' => array('list-group-item', 'btn', 'btn-default', 'product-cart', 'product-cart-' . $variation->nid, $hidden)), 'query' => drupal_get_destination())); ?>
                
                <?php $counter++; endforeach; ?>

            </div>
        </div>
        
        <?php if(!($elements % $tabsperrow)): ?>
            </div>
        <?php endif; ?>
        <?php $closed = TRUE; ?>
    <?php endforeach; ?>
    
    <?php if(!$closed): ?></div><?php endif; ?>
    
</div>