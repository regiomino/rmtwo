 
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
                <li>
                    <div class="product-item">
                        <h4> Roggen Shit</h4>
                        
                            <div class="btn-group btn-group-xs" data-toggle="buttons">
                                 
                                <label class="btn btn-default">
                                  <input type="radio" name="options" id="option2"> <span class="h4 price"><strong>5,10 €</strong></span> <em>6 x 1 kg </em>
                                </label>
                                 <label class="btn btn-default">
                                  <input type="radio" name="options" id="option2"> <span class="h4 price"><strong>5,10 €</strong></span> <em>6 x 1 kg </em>
                                </label>
                                  <label class="btn btn-default">
                                  <input type="radio" name="options" id="option2"> <span class="h4 price"><strong>5,10 €</strong></span> <em>6 x 1 kg </em>
                                </label>
                                 
</div>
                        
                        
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