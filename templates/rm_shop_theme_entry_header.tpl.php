<?php
//Notwendige Metadaten zur Formularverarbeitung rendern und ausgeben
$form1 = $vars['regionselect'];
$form2 = $vars['directoryselect'];
//Notwendige Metadaten zur Formularverarbeitung rendern und ausgeben
echo render($form1['form_id']);
echo render($form1['form_build_id']);
echo render($form1['form_token']);
echo render($form2['form_id']);
echo render($form2['form_build_id']);
echo render($form2['form_token']);
?>

<div class="col-md-6 zipcodeselect">

        <h2><?php echo t('Enter city or zipcode...'); ?></h2>
        <?php echo render($form1['rm_shop_zipcode']['zipcode']); ?>
        <?php echo render($form1['rm_shop_zipcode']['submit']); ?>

</div>
<div class="col-md-6 directoryselect">

        <h2><?php echo t('... or select seller from directory'); ?></h2>
        <?php echo render($form2['rm_shop_directory']['name']); ?>
        <?php echo render($form2['rm_shop_directory']['submit']); ?>

</div>
