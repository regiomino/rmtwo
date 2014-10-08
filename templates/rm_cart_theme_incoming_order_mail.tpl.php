<?php
    /*
    $vars['order_number']; bestellnr
    $vars['user_gender'];anrede m-> if 
    $vars['user_first_name'];
    $vars['user_last_name'];
    $vars['order_items']; array 
    $vars['billing_address']; einzel $vars['billing_address']['thoroughfare'] postal_code
 locality
 name_line
    $vars['shipping_address']; leer wenn keine lieferung
    $vars['delivery_type']; schlüssel oder wert
    $vars['payment_type']; abkürzung
    $vars['pickup_agreement'];
    $vars['delivery_range_from'];  timestamp
    $vars['delivery_range_to']; timestamp
    */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="initial-scale=1.0">    <!-- So that mobile webkit will display zoomed in -->
    <meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS -->
    <title>Bestelleingangsbestätigung</title>
    <style type="text/css">

        /* Resets: see reset.css for details */
        .ReadMsgBody { width: 100%; background-color: #f8f8f8;}
        .ExternalClass {width: 100%; background-color: #ebebeb;}
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height:100%;}
        body {-webkit-text-size-adjust:none; -ms-text-size-adjust:none;}
        body {margin:0; padding:0;}
        table {border-spacing:0;}
        table td {border-collapse:collapse;}
        .yshortcuts a {border-bottom: none !important;}

        /* Constrain email width for small screens */
        @media screen and (max-width: 600px) {
            table[class="container"] {
                width: 95% !important;
            }
        }

        /* Give content more room on mobile */
        @media screen and (max-width: 480px) {
            td[class="container-padding"] {
                padding-left: 12px !important;
                padding-right: 12px !important;
            }
        }
    </style>
</head>
<body style="margin:0; padding:10px 0;" bgcolor="#f8f8f8" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<br>

<!-- 100% wrapper (grey background) -->
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#f8f8f8">
  <tr>
    <td align="center" valign="top" bgcolor="#f8f8f8" style="background-color: #f8f8f8;">

      <!-- 600px container (white background) -->
      <table border="0" width="600" cellpadding="0" cellspacing="0" class="container" bgcolor="#ffffff">
        <tr>
          <td class="container-padding" bgcolor="#ffffff" style="background-color: #ffffff; padding-left: 30px; padding-right: 30px; font-size: 14px; line-height: 20px; font-family: Helvetica, sans-serif; color: #333;">
            <br>
            
            <!-- Header -->
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
               <tr>
                    <td align="left" valign="top" style="padding-bottom:10px;">
                        <img src="http://www.regiomino.de/sites/all/themes/rmtwo/images/logo.png" alt="regiomino.de" border="0" hspace="0" vspace="0" style="vertical-align:top; padding-bottom:12px;">
                    </td>
                    
                    <td align="right" valign="top" width="180"  style="padding-top:10px; padding-bottom:10px;">
                        <?php print $vars['order_number']; ?>
                    </td>
                </tr>
            </table>
            
            <!-- ### BEGIN CONTENT ### -->
            <?php print ($vars['user_gender'] == 'f') ? 'Sehr geehrte Frau' : 'Sehr geehrter Herr'; ?> <?php print $vars['user_last_name'];?>,<br><br>
            wir bestätigen Ihnen den Eingang Ihrer Bestellung, die wir an <span style="font-weight: bold"><?php print $vars['seller_title'];?> </span> weitergeleitet haben.
            <br>
            <br>
            <div style="font-weight: bold; border-bottom: 1px solid #000; font-size: 16px; line-height: 24px;">
                Ihre Bestellung im Überblick
            </div>
            
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <?php if(!empty($vars['order_items'])): ?>
                    <?php $netto = 0; ?>
                    <?php $nettoaddup = 0; ?>
                    <?php $vataddup = 0; ?>
                    <?php foreach($vars['order_items'] as $order_item): ?>
                        <?php if($order_item->field_item_type[LANGUAGE_NONE][0]['value'] == 'product'): ?>
                            <?php $netto = $order_item->field_order_amount[LANGUAGE_NONE][0]['value'] * $order_item->field_tu_price[LANGUAGE_NONE][0]['value']; ?>
                            <?php $nettoaddup += $netto; ?>
                            <?php $vat = $netto / 100 * $order_item->field_tu_vat[LANGUAGE_NONE][0]['value']; ?>
                            <?php $vataddup += $vat; ?>
                            <tr>
                                <td align="left" border valign="top" style="padding-top:7px; padding-bottom:3px;">
                                    <?php print $order_item->field_order_amount[LANGUAGE_NONE][0]['value']; ?>
                                </td>
                                
                                <td align="left" valign="top"  style="padding-top:7px; padding-bottom:3px;">
                                    <?php print $order_item->title; ?><br>
                                    <em style="font-style:italic; font-size: 12px; "> <?php $packaging_allowed_values = list_allowed_values(field_info_field('field_tu_packaging')); print $packaging_allowed_values[$order_item->field_tu_packaging[LANGUAGE_NONE][0]['value']]; ?> (<?php print $order_item->field_tu_amount[LANGUAGE_NONE][0]['value']; ?> x <?php print $order_item->field_productunit[LANGUAGE_NONE][0]['first']; ?> <?php print t($order_item->field_productunit[LANGUAGE_NONE][0]['second']); ?>)</em>
                                </td>
                                <td align="right" valign="top" style="padding-top:5px; padding-bottom:5px;">
                                    <?php print number_format($netto, 2, ",", "."); ?>€
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
                
                <!-- Lieferart -->
                 <tr>
                    <td align="left" colspan="2" valign="top" style="border-top: 1px solid #ddd;padding-top:5px; padding-bottom:5px;">
                        Lieferart: <strong> Selbstabholung</strong><br>
                        52342 Möhrendorf <br>
                        Starße 23
                    </td>
                    <td align="right" valign="top" style="padding-top:5px; border-top: 1px solid #ddd; padding-bottom:5px;"  >
                        0 €
                    </td>
                </tr>
                 
                 <!--breakdown -->
                <tr>
                    <td align="right" colspan="2" valign="top" style="border-top: 1px solid #000; background-color: #F3F3F3; padding-top:3px; padding-bottom:3px;">
                       Summe<br>
                    </td>
                    <td align="right" width="80" valign="top" style="padding-top:3px; background-color: #F3F3F3; border-top: 1px solid #000; padding-bottom:3px;">
                        130,78 €
                    </td>
                </tr>
                <tr>
                    <td align="right" colspan="2" valign="top" style="padding-top:3px; background-color: #F3F3F3; padding-bottom:3px;">
                       zzgl. MwSt.<br>
                    </td>
                    <td align="right" width="80" valign="top" style="padding-top:3px; background-color: #F3F3F3;  padding-bottom:3px;">
                       10 €
                    </td>
                </tr>
                 <tr>
                    <td align="right" colspan="2" valign="top" style="padding-top:3px; background-color: #F3F3F3; padding-bottom:3px;">
                       Pfand<br>
                    </td>
                    <td align="right" width="80" valign="top" style="padding-top:3px; background-color: #F3F3F3; padding-bottom:3px;">
                       0 €
                    </td>
                </tr>
                 <tr>
                    <td align="right" colspan="2" valign="top" style="padding-top:3px; border-bottom: 1px solid #000; background-color: #F3F3F3; padding-bottom:3px;">
                       <strong> Gesamtsumme </strong><br>
                    </td>
                    <td align="right" width="80" valign="top" style="padding-top:3px; border-bottom: 1px solid #000; background-color: #F3F3F3;  padding-bottom:3px;">
                      <strong>  1000,67 €</strong>
                    </td>
                </tr>
            </table>
           
            

           <div style="padding-top:15px">  <strong>Gewählte Zahlungsart:</strong></div>
            
            Paypal
            
            <br>
            <br>
               
            <strong>Ihre Rechnungsanschrift:</strong> 
            <br>
                <?php print $vars['billing_address']['name_line']; ?> <br>
                <?php print $vars['billing_address']['thoroughfare']; ?> <br>
                <?php print $vars['billing_address']['postal_code']; ?>  <?php print $vars['billing_address']['locality']; ?>
            <br>
            <br>
                
            <?php if (isset($vars['shipping_address'])): ?>
                <strong>Ihre Lieferanschrift:</strong> 
               <br>
                    <?php print $vars['shipping_address']['name_line']; ?> <br>
                    <?php print $vars['shipping_address']['thoroughfare']; ?> <br>
                    <?php print $vars['shipping_address']['postal_code']; ?>  <?php print $vars['shipping_address']['locality']; ?>
               <br>
               <br>
            <?php endif;?>
             
            Vielen Dank für Ihre Bestellung!
            <br>
            Mit freundlichen Grüßen,<br>
            Ihr regiomino.de-Team 
            <br>
            <br>
                
            <div style="padding-top: 5px; border-top: 1px solid #ddd"></div>
            <em style="font-style:italic; font-size: 12px;">Haben Sie Fragen?
            Sie erreichen unser Serviceteam per E-Mail unter support@regiomino.de oder telefonisch unter 09131-9291117 (kostenfrei, rund um die Uhr). <br>
            <a href="http://www.regiomino.de/kontakt" style="color:#95bc0d"> Kontaktformular im Browser öffnen</a>
            
            </em>
            <br><br>

            <!-- ### END CONTENT ### -->

          </td>
        </tr>
      </table>
      <!--/600px container -->

    </td>
  </tr>
</table>
<!--/100% wrapper-->
<br>
<br>
</body>
</html>

