<?php
    $form = $variables['form'];
?>

<?php print render($form['profileregistration']['gender']); ?>
<?php print render($form['profileregistration']['first_name']); ?>
<?php print render($form['profileregistration']['last_name']); ?>
<?php print render($form['profileregistration']['profile_title']); ?>
<?php print render($form['profileregistration']['company_name']); ?>
<?php print render($form['profileregistration']['smallbusiness']); ?>
<?php print render($form['profileregistration']['phone']); ?>
<?php print render($form['profileregistration']['fax']); ?>
<?php print render($form['profileregistration']['email']); ?>
<?php print render($form['profileregistration']['iban']); ?>
<?php print render($form['profileregistration']['bic']); ?>
<?php print render($form['profileregistration']['accountholder']); ?>
<?php print render($form['profileregistration']['taxnumber']); ?>
<?php print render($form['profileregistration']['street']); ?>
<?php print render($form['profileregistration']['zipcode']); ?>
<?php print render($form['profileregistration']['locality']); ?>
<?php print render($form['profileregistration']['newsletter']); ?>

<?php
    print drupal_render_children($form);
?>