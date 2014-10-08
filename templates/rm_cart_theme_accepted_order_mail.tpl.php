
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="initial-scale=1.0">    <!-- So that mobile webkit will display zoomed in -->
    <meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS -->
    <title>Bestellbestätigung</title>
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
            
            
            
            <!-- ### BEGIN CONTENT ### -->
            <?php print ($vars['user_gender'] == 'f') ? 'Sehr geehrte Frau' : 'Sehr geehrter Herr'; ?> <?php print $vars['user_last_name'];?>,<br><br>
            wir bedanken uns für den Auftrag und bestätigen Ihre Bestellung (Nr. <?php print $vars['order_number']; ?>).
            
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
               
            <strong>Ihre Rechnungsanschrift:</strong> 
            <br>
                <?php print $vars['billing_address']['name_line']; ?> <br>
                <?php print $vars['billing_address']['thoroughfare']; ?> <br>
                <?php print $vars['billing_address']['postal_code']; ?>  <?php print $vars['billing_address']['locality']; ?>
            <br>
            <br>
                
            <?php if($vars['delivery_type'] == 'shipping_agreement'): ?>
                <strong>Ihre Lieferanschrift:</strong> 
                <br>
                    <?php print $vars['shipping_address']['name_line']; ?> <br>
                    <?php print $vars['shipping_address']['thoroughfare']; ?> <br>
                    <?php print $vars['shipping_address']['postal_code']; ?>  <?php print $vars['shipping_address']['locality']; ?>
                <br>
                <br>
            <?php endif;?>
             
            <br>
            Mit freundlichen Grüßen,<br>
            <?php if(!empty($vars['seller_user']->field_first_name[LANGUAGE_NONE][0]['value']) && !empty($vars['seller_user']->field_last_name[LANGUAGE_NONE][0]['value'])): ?>
                <?php print $vars['seller_user']->field_first_name[LANGUAGE_NONE][0]['value']; ?>
                <?php print $vars['seller_user']->field_last_name[LANGUAGE_NONE][0]['value']; ?>
            <?php endif; ?>
            <?php print $vars['shop']->field_company_name[LANGUAGE_NONE][0]['value']; ?>
            <br>
            <br>
            
            <div style="padding-top: 5px; border-top: 1px solid #ddd"></div>
            <em style="font-style:italic; font-size: 12px;"><?php print $vars['shop']->field_company_name[LANGUAGE_NONE][0]['value']; ?>    <br>
            <?php print $vars['shop']->field_billingaddress[LANGUAGE_NONE][0]['thoroughfare']; ?><br>
            <?php print $vars['shop']->field_billingaddress[LANGUAGE_NONE][0]['postal_code']; ?>
            <?php print $vars['shop']->field_billingaddress[LANGUAGE_NONE][0]['locality']; ?></em>
            
            <br>
            <br>
            
            <div style="font-weight: bold; border-bottom: 1px solid #000; font-size: 16px; line-height: 24px;">
                Widerrufsbelehrung
            </div>
            
            <strong>Widerrufsrecht</strong>
            <p>Sie haben das Recht, binnen vierzehn Tagen ohne Angabe von Gründen diesen Vertrag zu widerrufen. Die Widerrufsfrist beträgt vierzehn Tage ab dem Tag, an dem Sie oder ein von Ihnen benannter Dritter, der nicht der Beförderer ist, die Waren in Besitz genommen haben bzw. hat.</p>
            <p>Um Ihr Widerrufsrecht auszuüben, müssen Sie uns (<?php print $vars['shop']->field_company_name[LANGUAGE_NONE][0]['value']; ?>, <?php print $vars['shop']->field_billingaddress[LANGUAGE_NONE][0]['thoroughfare']; ?>, <?php print $vars['shop']->field_billingaddress[LANGUAGE_NONE][0]['postal_code']; ?> <?php print $vars['shop']->field_billingaddress[LANGUAGE_NONE][0]['locality']; ?>, <?php print $vars['shop']->field_email[LANGUAGE_NONE][0]['email']; ?>) mittels einer eindeutigen Erklärung (z. B. ein mit der Post versandter Brief, Telefax oder E-Mail) über Ihren Entschluss, diesen Vertrag zu widerrufen, informieren. Sie können dafür das beigefügte Muster-Widerrufsformular verwenden, das jedoch nicht vorgeschrieben ist.
            </p>
            <p>Zur Wahrung der Widerrufsfrist reicht es aus, dass Sie die Mitteilung über die Ausübung des Widerrufsrechts vor Ablauf der Widerrufsfrist absenden.</p>
            <strong>Folgen des Widerrufs</strong>
            <p>Wenn Sie diesen Vertrag widerrufen, haben wir Ihnen alle Zahlungen, die wir von Ihnen erhalten haben, einschließlich der Lieferkosten (mit Ausnahme der zusätzlichen Kosten, die sich daraus ergeben, dass Sie eine andere Art der Lieferung als die von uns angebotene, günstigste Standardlieferung gewählt haben), unverzüglich und spätestens binnen vierzehn Tagen ab dem Tag zurückzuzahlen, an dem die Mitteilung über Ihren Widerruf dieses Vertrags bei uns eingegangen ist. Für diese Rückzahlung verwenden wir dasselbe Zahlungsmittel, das Sie bei der ursprünglichen Transaktion eingesetzt haben, es sei denn, mit Ihnen wurde ausdrücklich etwas anderes vereinbart; in keinem Fall werden Ihnen wegen dieser Rückzahlung Entgelte berechnet.
            Wir können die Rückzahlung verweigern, bis wir die Waren wieder zurückerhalten haben oder bis Sie den Nachweis erbracht haben, dass Sie die Waren zurückgesandt haben, je nachdem, welches der frühere Zeitpunkt ist</p>
            <p>
            Sie haben die Waren unverzüglich und in jedem Fall spätestens binnen vierzehn Tagen ab dem Tag, an dem Sie uns über den Widerruf dieses Vertrags unterrichten, an uns zurückzusenden oder zu übergeben. Die Frist ist gewahrt, wenn Sie die Waren vor Ablauf der Frist von vierzehn Tagen absenden.
            Sie tragen die unmittelbaren Kosten der Rücksendung der Waren.
            Sie müssen für einen etwaigen Wertverlust der Waren nur aufkommen, wenn dieser Wertverlust auf einen zur Prüfung der Beschaffenheit, Eigenschaften und Funktionsweise der Waren nicht notwendigen Umgang mit Ihnen zurückzuführen ist.
            </p>
            <ul>
            Das Widerrufsrecht besteht nicht bei den folgenden Verträgen:
            <li>Verträge zur Lieferung von Waren, die nicht vorgefertigt sind und für deren Herstellung eine individuelle Auswahl oder Bestimmung durch den Verbraucher maßgeblich ist oder die eindeutig auf die persönlichen Bedürfnisse des Verbrauchers zugeschnitten sind.</li>
            <li>Verträge zur Lieferung von Waren, die schnell verderben können oder deren Verfallsdatum schnell überschritten würde.</li>
            <li>Verträge zur Lieferung versiegelter Waren, die aus Gründen des Gesundheitsschutzes oder der Hygiene nicht zur Rückgabe geeignet sind, wenn ihre Versiegelung nach der Lieferung entfernt wurde.</li>
            </ul>
            <div style="border: 1px solid black; padding: 10px;">
            <strong>Muster-Widerrufsformular</strong><br>
            <p>
            <i>(Wenn Sie den Vertrag widerrufen wollen, dann füllen Sie bitte dieses Formular aus und senden Sie es zurück.)</i>
            </p>
            <p>– An <?php print $vars['shop']->field_company_name[LANGUAGE_NONE][0]['value']; ?>, <?php print $vars['shop']->field_billingaddress[LANGUAGE_NONE][0]['thoroughfare']; ?>, <?php print $vars['shop']->field_billingaddress[LANGUAGE_NONE][0]['postal_code']; ?> <?php print $vars['shop']->field_billingaddress[LANGUAGE_NONE][0]['locality']; ?>, <?php print $vars['shop']->field_email[LANGUAGE_NONE][0]['email']; ?></p>
            <p>– Hiermit widerrufe(n) ich/wir (*) den von mir/uns (*) abgeschlossenen Vertrag über den Kauf der folgenden
            Waren (*)/die Erbringung der folgenden Dienstleistung (*)</p>
            <p>– Bestellt am (*)/erhalten am (*)</p>
            <p>– Name des/der Verbraucher(s)</p>
            <p>– Anschrift des/der Verbraucher(s)</p>
            <p>– Unterschrift des/der Verbraucher(s) (nur bei Mitteilung auf Papier)</p>
            <p>– Datum</p>
            <p><i>(*) Unzutreffendes streichen.</i></p>
            </div>
            
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

