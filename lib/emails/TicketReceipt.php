<?php
namespace JCarignan\tickets\TicketReceipt;
use Roots\Sage\Extras;

function get_html($subject, $ticket)
{
    $socialImgPath = get_template_directory_uri().'/dist/images/social/';
    $socialMedias = '<a style="text-decoration: none;" href="http://www.facebook.com/ACCRO-261078524281645/" target="_blank"><img src="'.$socialImgPath.'facebook-small.png" width="50" height="50" alt="Facebook"/> </a>
                     <a style="text-decoration: none;" href="http://twitter.com/ACCROMTL"><img src="'.$socialImgPath.'twitter-small.png" width="50" height="50" alt="Twitter" /> </a>
                     <a style="text-decoration: none;" href="http://www.instagram.com/accromtl/"><img src="'.$socialImgPath.'instagram-small.png" width="50" height="50" alt="Instagram" /> </a>
                     <a style="text-decoration: none;" href="https://www.linkedin.com/company/accro-montr%C3%A9al"><img src="'.$socialImgPath.'linkedin-small.png" width="50" height="50" alt="LinkedIn" /> </a>
    ';
    if (function_exists('qtrans_getLanguage') && qtrans_getLanguage() == 'en')
    {
        $message =    '<p>Hi,</p>
                        <p>Thank you for your participation in ACCRO! You will find below your ticket for the event on September 29th at La TOHU , we will be waiting for you starting at 5h PM<br><br>
                        Please preserve your ticket until the event and present it at the reception from your smart phone.</p>
                        <p>Here are some useful things to know:<br>
                        - La TOHU (2345 Jarry E street, Montreal, QC H1Z 4P3)<br>
                        - Free parking included, located on Michel-Jurdan street, on the corner of the Regrattiers street.<br>
                        - Bixi Station and bus stops nearby<br>
                        <p>For more information about the event’s location: <a href="http://www.tohu.ca" target="_blank">www.tohu.ca</a><br>
                        Stay informed about ACCRO: <a href="http://www.accromontreal.com" target="_blank">www.accromontreal.com</a></p>
                        <p>'.$socialMedias.'</p>
                        <p>We look forward to seeing you there!</p><br>';
    } else {
        $message =    '<p>Bonjour,</p>
                        <p>Merci de votre participation à Accro! Vous trouverez ci-joint votre billet pour l’événement du 29 septembre prochain à La TOHU, nous vous y attendons dès 17h.<br><br>
                        Vous n’avez qu’à préserver votre billet jusqu’à l’événement et le présenter à l’accueil simplement à partir de votre téléphone intelligent.</p>
                        <p>Voici quelques informations pratiques:<br>
                        - La TOHU (2345 Rue Jarry E, Montréal, QC H1Z 4P3)<br>
                        - Stationnement gratuit inclus, situé sur la rue Michel-Jurdant, à l’angle de la rue des Regrattiers.<br>
                        - Station Bixi et arrêts d’autobus à proximité<br>
                        <p>Pour plus d’informations concernant le lieu de l’événement : <a href="http://www.tohu.ca" target="_blank">www.tohu.ca</a><br>
                        Restez à l’affût des actualités ACCRO : <a href="http://www.accromontreal.com" target="_blank">www.accromontreal.com</a></p>
                        <p>'.$socialMedias.'</p>
                        <p>Au plaisir de vous y voir!</p><br>';
    }

     $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
              <html xmlns="http://www.w3.org/1999/xhtml">
                 <head>
                     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                     <!--[if !mso]><!-->
                         <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                     <!--<![endif]-->
                     <meta name="viewport" content="width=device-width, initial-scale=1.0">
                     <title>'.$subject.'</title>
                     <style type="text/css">
                         @import url(https://fonts.googleapis.com/css?family=Noto+Sans:400,700);
                         div[style*="margin: 16px 0"] {
                             margin:0 !important;
                         }
                         @media only screen and (max-width: 600px){
                             .ticket-infos {
                                 max-width: 400px !important;
                             }
                         }
                     </style>
                     <!--[if (gte mso 9)|(IE)]>
                     <style type="text/css">
                         table {border-collapse: collapse;}
                     </style>
                     <![endif]-->
                 </head>
                 <body style="margin: 0 !important;padding: 0;background-color: #ffffff;">
                     <!--[if mso]>
                         <style type="text/css">
                             td {
                                 font-family: Arial, sans-serif;
                             }
                         </style>
                     <![endif]-->
                     <center class="wrapper" style="width: 100%; table-layout: fixed; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
                         <div class="webkit" style="max-width: 600px;margin: 0 auto;">
                             <!--[if (gte mso 9)|(IE)]>
                                <table width="600" align="center">
                                <tr>
                                <td style="padding: 0;">
                             <![endif]-->
                             <table class="outer" align="center" style="font-family: Noto Sans, Arial, Helvetica, sans-serif !important;border-spacing: 0; margin: 0 auto;width: 100%;max-width: 600px;">
                                 <tr>
                                     <td style="font-size:14px;padding:10px;">'.$message.'</td>
                                </tr>
                                '.\Roots\Sage\Extras\generate_ticket_html($ticket).'
                            </table>
                            <!--[if (gte mso 9)|(IE)]>
                                </td>
                                </tr>
                                </table>
                            <![endif]-->
                         </div>
                     </center>
                 </body>
            </html>';
    return $html;
}
?>
