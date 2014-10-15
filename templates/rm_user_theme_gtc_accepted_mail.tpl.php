<?php
/*
    $vars['profileobject']
    $vars['profileuser']
    $vars['password']
*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="initial-scale=1.0">    <!-- So that mobile webkit will display zoomed in -->
    <meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS -->
    <title>Vielen Dank für Ihre Registrierung</title>
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
                </tr>
            </table>
            
            <!-- ### BEGIN CONTENT ### -->
            <div style="font-weight: bold;padding-bottom: 10px; font-size: 16px; line-height: 24px;">
                Vielen Dank für Ihre Registrierung
            </div>
 
            <?php print ($vars['profileuser']->field_gender[LANGUAGE_NONE][0]['value'] == 'f') ? 'Sehr geehrte Frau' : 'Sehr geehrter Herr'; ?> <?php print $vars['profileuser']->field_last_name[LANGUAGE_NONE][0]['value']; ?>,<br><br>
            vielen Dank für Ihre Registrierung und Willkommen bei Regiomino! Sie haben jetzt jederzeit Zugriff auf Ihren persönlichen Verwaltungsbereich. Dort können Sie z.B. Ihre Angebote verwalten aber auch Ihre Profil- und Benutzerdaten ändern.<br><br>
            
            Ihr Passwort: <?php print $vars['password']; ?>
            
            <br>
            <br>
            
            <div style="font-weight: bold; border-bottom: 1px solid #000; font-size: 16px; line-height: 24px;">
                Ihre Registrierungs-Daten im Überblick
            </div>
            
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <!--Name-->
                <tr>
                    <td align="left" border valign="top" style="padding-top:7px; padding-bottom:3px;">
                        <?php print t('Your name'); ?>
                    </td>
                    <td align="left" valign="top"  style="padding-top:7px; padding-bottom:3px;">
                        <?php print ($vars['profileuser']->field_gender[LANGUAGE_NONE][0]['value'] == 'f') ? 'Frau' : 'Herr'; ?> <?php print $vars['profileuser']->field_first_name[LANGUAGE_NONE][0]['value']; ?> <?php print $vars['profileuser']->field_last_name[LANGUAGE_NONE][0]['value']; ?>
                    </td>
                </tr>
                <!--Profiltitel-->
                <tr>
                    <td align="left" border valign="top" style="padding-top:7px; padding-bottom:3px;">
                        <?php print t('Profile title'); ?>
                    </td>
                    <td align="left" valign="top"  style="padding-top:7px; padding-bottom:3px;">
                        <?php print $vars['profileobject']->title; ?>
                    </td>
                </tr>
                <!--Firmenname-->
                <tr>
                    <td align="left" border valign="top" style="padding-top:7px; padding-bottom:3px;">
                        <?php print t('Company name'); ?>
                    </td>
                    <td align="left" valign="top"  style="padding-top:7px; padding-bottom:3px;">
                        <?php print $vars['profileobject']->field_company_name[LANGUAGE_NONE][0]['value']; ?>
                    </td>
                </tr>
                <!--Telefon-->
                <tr>
                    <td align="left" border valign="top" style="padding-top:7px; padding-bottom:3px;">
                        <?php print t('Phone'); ?>
                    </td>
                    <td align="left" valign="top"  style="padding-top:7px; padding-bottom:3px;">
                        <?php print rm_api_format_phone($vars['profileobject']->field_publicphone[LANGUAGE_NONE][0]['number']); ?>
                    </td>
                </tr>
                <!--Fax-->
                <?php if(!empty($vars['profileobject']->field_publicfax[LANGUAGE_NONE][0]['number'])): ?>
                <tr>
                    <td align="left" border valign="top" style="padding-top:7px; padding-bottom:3px;">
                        <?php print t('Profile title'); ?>
                    </td>
                    <td align="left" valign="top"  style="padding-top:7px; padding-bottom:3px;">
                        <?php print $vars['profileobject']->field_publicfax[LANGUAGE_NONE][0]['number']; ?>
                    </td>
                </tr>
                <?php endif; ?>
                <!--E-Mail-->
                <tr>
                    <td align="left" border valign="top" style="padding-top:7px; padding-bottom:3px;">
                        <?php print t('Email'); ?>
                    </td>
                    <td align="left" valign="top"  style="padding-top:7px; padding-bottom:3px;">
                        <?php print $vars['profileobject']->field_email[LANGUAGE_NONE][0]['email']; ?>
                    </td>
                </tr>
                <!--IBAN-->
                <tr>
                    <td align="left" border valign="top" style="padding-top:7px; padding-bottom:3px;">
                        <?php print t('IBAN'); ?>
                    </td>
                    <td align="left" valign="top"  style="padding-top:7px; padding-bottom:3px;">
                        <?php print $vars['profileobject']->field_iban[LANGUAGE_NONE][0]['value']; ?>
                    </td>
                </tr>
                <!--BIC-->
                <tr>
                    <td align="left" border valign="top" style="padding-top:7px; padding-bottom:3px;">
                        <?php print t('BIC'); ?>
                    </td>
                    <td align="left" valign="top"  style="padding-top:7px; padding-bottom:3px;">
                        <?php print $vars['profileobject']->field_bic[LANGUAGE_NONE][0]['value']; ?>
                    </td>
                </tr>
                <!--Kontoinhaber-->
                <tr>
                    <td align="left" border valign="top" style="padding-top:7px; padding-bottom:3px;">
                        <?php print t('Account holder'); ?>
                    </td>
                    <td align="left" valign="top"  style="padding-top:7px; padding-bottom:3px;">
                        <?php print $vars['profileobject']->field_bankaccountholder[LANGUAGE_NONE][0]['value']; ?>
                    </td>
                </tr>
                <!--Steuernummer/UStID-->
                <tr>
                    <td align="left" border valign="top" style="padding-top:7px; padding-bottom:3px;">
                        <?php print t('Tax ID'); ?>
                    </td>
                    <td align="left" valign="top"  style="padding-top:7px; padding-bottom:3px;">
                        <?php print $vars['profileobject']->field_taxnumber[LANGUAGE_NONE][0]['value']; ?>
                    </td>
                </tr>
                <!--Anschrift: Straße-->
                <tr>
                    <td align="left" border valign="top" style="padding-top:7px; padding-bottom:3px;">
                        <?php print t('Street'); ?>
                    </td>
                    <td align="left" valign="top"  style="padding-top:7px; padding-bottom:3px;">
                        <?php print $vars['profileobject']->field_address[LANGUAGE_NONE][0]['thoroughfare']; ?>
                    </td>
                </tr>
                <!--Anschrift: PLZ-->
                <tr>
                    <td align="left" border valign="top" style="padding-top:7px; padding-bottom:3px;">
                        <?php print t('Postal code'); ?>
                    </td>
                    <td align="left" valign="top"  style="padding-top:7px; padding-bottom:3px;">
                        <?php print $vars['profileobject']->field_address[LANGUAGE_NONE][0]['postal_code']; ?>
                    </td>
                </tr>
                <!--Anschrift: Ort-->
                <tr>
                    <td align="left" border valign="top" style="padding-top:7px; padding-bottom:3px;">
                        <?php print t('Locality'); ?>
                    </td>
                    <td align="left" valign="top"  style="padding-top:7px; padding-bottom:3px;">
                        <?php print $vars['profileobject']->field_address[LANGUAGE_NONE][0]['locality']; ?>
                    </td>
                </tr>
                <!--Kleinunternehmer-->
                <tr>
                    <td align="left" border valign="top" style="padding-top:7px; padding-bottom:3px;">
                        <?php print '"Kleinunternehmerregelung"'; ?>
                    </td>
                    <td align="left" valign="top"  style="padding-top:7px; padding-bottom:3px;">
                        <?php print (!empty($vars['profileobject']->field_kleinunternehmer[LANGUAGE_NONE][0]['value'])) ? t('Yes') : t('No'); ?>
                    </td>
                </tr>
                <!--AGB-->
                <tr>
                    <td align="left" border valign="top" style="padding-top:7px; padding-bottom:3px;">
                        <?php print t('GTC accepted'); ?>
                    </td>
                    <td align="left" valign="top"  style="padding-top:7px; padding-bottom:3px;">
                        <?php print t('Yes'); ?>
                    </td>
                </tr>
            </table>
            
            <div style="font-weight: bold; border-bottom: 1px solid #000; font-size: 16px; line-height: 24px;">
                <?php print $vars['gtc']->title; ?> der Regiomino GmbH
            </div>
            
            <?php print $vars['gtc']->body[LANGUAGE_NONE][0]['value']; ?>

            <br>
            <br>
            Mit freundlichen Grüßen,<br>
            Ihr Regiomino-Team 
            <br>
            <br>
                
            <div style="padding-top: 5px; border-top: 1px solid #ddd"></div>
            <em style="font-style:italic; font-size: 12px;">Haben Sie Fragen?
            Sie erreichen unser Serviceteam per E-Mail unter support@regiomino.de oder telefonisch unter 09131-9291117.<br>
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

