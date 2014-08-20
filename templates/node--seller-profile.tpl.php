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
<div class="wrapper-m">
    <div class="wrapper-m-inner">
        <div class="seller-infos"> 
            <h1 class="h2"><?php print $node->title; ?></h1>
            <ul class="list-inline">
                <li>
                    <span class="glyphicon glyphicon-cutlery" ></span>
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
                <li>
                    <span class="glyphicon glyphicon-road"></span>
                    <?php print $node->field_address[LANGUAGE_NONE][0]['thoroughfare']; ?>, <?php print $node->field_address[LANGUAGE_NONE][0]['postal_code'] ?> <?php print $node->field_address[LANGUAGE_NONE][0]['locality']; ?></li>
                </li>
            </ul>
            <div class="seller-description"> 
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="<?php print image_style_url('thumbnail', $node->field_image[LANGUAGE_NONE][0]['uri']); ?>" alt="<?php print $node->title; ?>">
                    </a>
                    <div class="media-body">
                       <?php
                        $length = 350;
                        $body = strip_tags($node->body[LANGUAGE_NONE][0]['value']);
                        if(mb_strlen($body) > $length) {
                            print '<div class="description" id="long-desc" style="display:none; height:auto"><p>'.$body.'</p>';
                                print '<div class="more-toggle"><a href="#" id="read-less"> <span class="glyphicon glyphicon-chevron-up"></span> weniger lesen </a></div></div>';
                            
                            print '<div class="description" id="short-desc"><p>';
                            print mb_substr($body, 0, mb_strpos($body, " ", $length)) . '<span class="elipsis"> ...</span></p><div class="more-toggle"><a href="#" id="read-more"> <span class="glyphicon glyphicon-chevron-down"></span> mehr lesen </a></div></div>';
                            
                        }
                        else {
                            print $body;
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <ul class="product-grid clearfix"> 
            <?php foreach($node->offers as $offer): ?>
                <li class="list-group">
                    <div class="list-group-item"> 
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
                    
                    <div class="list-group-item">
                        <select class="form-control quantity-select">                            
                        <?php $options = rm_cart_get_quantity_options($variation->nid); ?>
                        
                        <?php if(!empty($options)): foreach($options as $option): ?>
                            <option value="<?php print $option;?>">
                                <?php print $option;?>
                                    &times;
                                <?php print $variation->field_productunit[LANGUAGE_NONE][0]['first']; ?><?php print t($variation->field_productunit[LANGUAGE_NONE][0]['second']); ?>
                            </option>
                        <?php endforeach; endif; ?>
                        </select>
                        <span class="input-group-btn"><?php print l('<span class="glyphicon glyphicon-plus"></span> ' . t('Add to cart'), 'addtocart/' . $offer->nid . '/' . $variation->nid . '/' . $variation->trading_units[0]->nid . '/1', array('html' => TRUE, 'attributes' => array('class' => array('btn', 'btn-success', 'product-cart', 'product-cart-' . $variation->nid, $hidden)), 'query' => drupal_get_destination())); ?></span>
                    </div>
      
                </li>
             <?php endforeach; ?>
        </ul>
    </div>
</div>

<div class= "grid-l">
<?php
$block = module_invoke('rm_cart', 'block_view', 'rm_cart_block');
    print render($block['content']);
?>
</div>