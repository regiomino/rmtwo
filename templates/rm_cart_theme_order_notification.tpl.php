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
                        <?php print $vars['shop']->field_company_name[LANGUAGE_NONE][0]['value']; ?><br>
                        <?php print $vars['shop']->field_billingaddress[LANGUAGE_NONE][0]['thoroughfare']; ?><br>
                        <?php print $vars['shop']->field_billingaddress[LANGUAGE_NONE][0]['postal_code']; ?> <?php print $vars['shop']->field_billingaddress[LANGUAGE_NONE][0]['locality']; ?>
                        <br><br>
                        <?php print $vars['order_number']; ?>
                    </td>
                </tr>
            </table>
            
            <!-- ### BEGIN CONTENT ### -->
            
            <?php print ($vars['seller_user']->field_gender[LANGUAGE_NONE][0]['value'] == 'f') ? 'Sehr geehrte Frau' : 'Sehr geehrter Herr'; ?> <?php print $vars['seller_user']->field_last_name[LANGUAGE_NONE][0]['value']; ?>,<br><br>
            auf www.regiomino.de wurde eine neue Bestellung auf Ihre Produkte getätigt. <span style="font-weight: bold">Wenn Sie in Ihrem Profil eine Fax-Nummer hinterlegt haben, erhalten Sie eine Kopie dieser Information als Fax.</span>
            <br>
            <br>
            <div style="font-weight: bold; border-bottom: 1px solid #000; font-size: 16px; line-height: 24px;">
                Die Bestellung im Überblick
            </div>
            
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <?php if(!empty($vars['order_items'])): ?>
                    <?php $netto = 0; ?>
                    <?php $nettoaddup = 0; ?>
                    <?php $vataddup = 0; ?>
                    <?php $depositaddup = 0; ?>
                    <?php foreach($vars['order_items'] as $order_item): ?>
                        <?php if($order_item->field_item_type[LANGUAGE_NONE][0]['value'] == 'product'): ?>
                            <?php $netto = $order_item->field_order_amount[LANGUAGE_NONE][0]['value'] * $order_item->field_tu_price[LANGUAGE_NONE][0]['value']; ?>
                            <?php $nettoaddup += $netto; ?>
                            <?php $vat = $netto / 100 * $order_item->field_tu_vat[LANGUAGE_NONE][0]['value']; ?>
                            <?php $vataddup += $vat; ?>
                            <?php $depositaddup += $order_item->field_tu_deposit[LANGUAGE_NONE][0]['value']; ?>
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
                    
                    <?php $payablesurcharge = FALSE; ?>
                    <?php foreach($vars['order_items'] as $order_item): ?>
                        <?php if($order_item->field_item_type[LANGUAGE_NONE][0]['value'] == 'surcharge'): ?>
                            <?php $payablesurcharge = TRUE; ?>
                            <?php $netto = $order_item->field_order_amount[LANGUAGE_NONE][0]['value'] * $order_item->field_tu_price[LANGUAGE_NONE][0]['value']; ?>
                            <?php $nettoaddup += $netto; ?>
                            <?php $vat = $netto / 100 * $order_item->field_tu_vat[LANGUAGE_NONE][0]['value']; ?>
                            <?php $vataddup += $vat; ?>
                            <tr>
                                <td align="left" colspan="2" valign="top" style="border-top: 1px solid #ddd;padding-top:5px; padding-bottom:5px;">
                                    Lieferart: <strong> <?php $deliverytype_allowed_values = list_allowed_values(field_info_field('field_deliverytype')); print $deliverytype_allowed_values[$vars['delivery_type']]; ?></strong><br>
                                    <?php print t(date('l', $vars['delivery_range_from'])); ?>, <?php print date('d.m.Y H:i', $vars['delivery_range_from']); ?> - <?php print date('H:i', $vars['delivery_range_to']); ?>
                                    <?php if($vars['delivery_type'] == 'pickup_agreement'): ?>
                                        <br>
                                        <?php print $vars['pickup_agreement']->field_address[LANGUAGE_NONE][0]['thoroughfare']; ?><br>
                                        <?php print $vars['pickup_agreement']->field_address[LANGUAGE_NONE][0]['postal_code']; ?>
                                        <?php print $vars['pickup_agreement']->field_address[LANGUAGE_NONE][0]['locality']; ?>
                                    <?php endif; ?>
                                </td>
                                <td align="right" valign="top" style="padding-top:5px; border-top: 1px solid #ddd; padding-bottom:5px;"  >
                                    <?php print number_format($netto, 2, ",", "."); ?>€
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php if(!$payablesurcharge): ?>
                        <tr>
                            <td align="left" colspan="2" valign="top" style="border-top: 1px solid #ddd;padding-top:5px; padding-bottom:5px;">
                                Lieferart: <strong> <?php $deliverytype_allowed_values = list_allowed_values(field_info_field('field_deliverytype')); print $deliverytype_allowed_values[$vars['delivery_type']]; ?></strong><br>
                                <?php print t(date('l', $vars['delivery_range_from'])); ?>, <?php print date('d.m.Y H:i', $vars['delivery_range_from']); ?> - <?php print date('H:i', $vars['delivery_range_to']); ?>
                                <?php if($vars['delivery_type'] == 'pickup_agreement'): ?>
                                    <br>
                                    <?php print $vars['pickup_agreement']->field_address[LANGUAGE_NONE][0]['thoroughfare']; ?><br>
                                    <?php print $vars['pickup_agreement']->field_address[LANGUAGE_NONE][0]['postal_code']; ?>
                                    <?php print $vars['pickup_agreement']->field_address[LANGUAGE_NONE][0]['locality']; ?>
                                <?php endif; ?>
                            </td>
                            <td align="right" valign="top" style="padding-top:5px; border-top: 1px solid #ddd; padding-bottom:5px;"  >
                                <?php print number_format(0, 2, ",", "."); ?>€
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endif; ?>
                
                
                 
                 <!--breakdown -->
                <tr>
                    <td align="right" colspan="2" valign="top" style="border-top: 1px solid #000; background-color: #F3F3F3; padding-top:3px; padding-bottom:3px;">
                        Summe<br>
                    </td>
                    <td align="right" width="80" valign="top" style="padding-top:3px; background-color: #F3F3F3; border-top: 1px solid #000; padding-bottom:3px;">
                        <?php print number_format($nettoaddup, 2, ",", "."); ?>€
                    </td>
                </tr>
                <tr>
                    <td align="right" colspan="2" valign="top" style="padding-top:3px; background-color: #F3F3F3; padding-bottom:3px;">
                       zzgl. MwSt.<br>
                    </td>
                    <td align="right" width="80" valign="top" style="padding-top:3px; background-color: #F3F3F3;  padding-bottom:3px;">
                       <?php print number_format($vataddup, 2, ",", "."); ?>€
                    </td>
                </tr>
                 <tr>
                    <td align="right" colspan="2" valign="top" style="padding-top:3px; background-color: #F3F3F3; padding-bottom:3px;">
                       Pfand<br>
                    </td>
                    <td align="right" width="80" valign="top" style="padding-top:3px; background-color: #F3F3F3; padding-bottom:3px;">
                       <?php print number_format($depositaddup, 2, ",", "."); ?>€
                    </td>
                </tr>
                 <tr>
                    <td align="right" colspan="2" valign="top" style="padding-top:3px; border-bottom: 1px solid #000; background-color: #F3F3F3; padding-bottom:3px;">
                       <strong> Gesamtsumme </strong><br>
                    </td>
                    <td align="right" width="80" valign="top" style="padding-top:3px; border-bottom: 1px solid #000; background-color: #F3F3F3;  padding-bottom:3px;">
                      <strong><?php print number_format($nettoaddup + $vataddup + $depositaddup, 2, ",", "."); ?>€</strong>
                    </td>
                </tr>
            </table>

            <div style="padding-top:15px">  <strong>Gewählte Zahlungsart:</strong></div>
            
            <?php $paymenttype_allowed_values = list_allowed_values(field_info_field('field_paymenttype')); print $paymenttype_allowed_values[$vars['payment_type']]; ?>
            
            <br>
            <br>
               
            <strong>Rechnungsanschrift:</strong> 
            <br>
                <?php print $vars['billing_address']['name_line']; ?> <br>
                <?php print $vars['billing_address']['thoroughfare']; ?> <br>
                <?php print $vars['billing_address']['postal_code']; ?>  <?php print $vars['billing_address']['locality']; ?>
            <br>
            <br>
                
            <?php if($vars['delivery_type'] == 'shipping_agreement'): ?>
                <strong>Lieferanschrift:</strong> 
                <br>
                    <?php print $vars['shipping_address']['name_line']; ?> <br>
                    <?php print $vars['shipping_address']['thoroughfare']; ?> <br>
                    <?php print $vars['shipping_address']['postal_code']; ?>  <?php print $vars['shipping_address']['locality']; ?>
                <br>
                <br>
            <?php endif;?>
            
            
            <div style="padding-top:15px">  <strong>Regiomino-Provision:</strong></div>
            
            Wir vereinbart erheben wir für diese Bestellung eine Netto-Provision i.H.v. <?php print number_format(floatval($vars['commission']), 2, ",", "."); ?>%. Das entspricht einem Betrag von <?php print number_format(floatval($vars['commission']) * $nettoaddup / 100, 2, ",", "."); ?>€.

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