<?php
    $form = $variables['form'];
?>
<div class="row">
    <div class="col-sm-4 lpr"> 
        <?php print render($form['profileregistration']['gender']); ?>
    </div>
    <div class="col-sm-4 lpl lpr"> 
        <?php print render($form['profileregistration']['first_name']); ?>
    </div>
    <div class="col-sm-4 lpl"> 
<?php print render($form['profileregistration']['last_name']); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 lpr"> 
        <?php print render($form['profileregistration']['profile_title']); ?>
    </div>
     <div class="col-sm-6 lpl"> 
        <?php print render($form['profileregistration']['company_name']); ?>
     </div>
</div>
<div class="row">
    <div class="col-sm-6 lpr"> 
        <?php print render($form['profileregistration']['phone']); ?>
    </div>
    <div class="col-sm-6 lpl"> 
        <?php print render($form['profileregistration']['fax']); ?>
    </div>
</div>
<div class="row">
     <div class="col-sm-12"> 
        <?php print render($form['profileregistration']['email']); ?>
     </div>
</div>
<div class="row">
    <div class="col-sm-6 lpr"> 
        <?php print render($form['profileregistration']['iban']); ?>
    </div>
    <div class="col-sm-6 lpl"> 
        <?php print render($form['profileregistration']['bic']); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 lpr"> 
       <?php print render($form['profileregistration']['accountholder']); ?>
    </div>
    <div class="col-sm-6 lpl"> 
        <?php print render($form['profileregistration']['taxnumber']); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 lpr"> 
        <?php print render($form['profileregistration']['street']); ?>
    </div>
    <div class="col-sm-3 lpr lpl">
      <?php print render($form['profileregistration']['zipcode']); ?>
    </div>
    <div class="col-sm-3 lpl">
        <?php print render($form['profileregistration']['locality']); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12"> 
        <?php print render($form['profileregistration']['smallbusiness']); ?>
    </div>
</div>
<div class="row">
     <div class="col-sm-12"> 

   <?php print drupal_render_children($form);?>

     </div>
</div>
