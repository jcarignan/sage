<?php

namespace Roots\Sage\Extras;
require_once('Browser.php');
use Roots\Sage\Setup;

if (!session_id()) {
    session_start();
}

if (isset($_GET['promo']))
{
    $_SESSION['promo'] = $_GET['promo'];
}
else if (isset($_POST['promo']))
{
    $_SESSION['promo'] = $_POST['promo'];
}
else if (isset($_REQUEST['promo']))
{
    $_SESSION['promo'] = $_REQUEST['promo'];
}

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'immersiveproductions') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

function get_browser_from_useragent($userAgentString) {
    return new \Browser($userAgentString);
}

/**
 * TICKETS
 */
function get_coupon_from_code($couponCode) {
    $valid = false;
    $price = null;
    $buttonID = null;
    $buttonSandboxID = null;

    for ($i = 65; $i >= 35; $i-=5)
    {
        $code = get_option('ticket_coupon_'.$i.'_code');

        if (strtolower($code) === strtolower($couponCode))
        {
            $valid = true;
            $price = $i;
            $buttonID = get_option('ticket_coupon_'.$i.'_button_id');
            $buttonSandboxID = get_option('ticket_coupon_'.$i.'_sandboxed_button_id');
        }
    }
    return array(
        'valid' => $valid,
        'price' => $price,
        'button_id' => $buttonID,
        'button_sandbox_id' => $buttonSandboxID
    );
}

function get_ticket_status() {
    global $wpdb;
    $price;
    $comboPrice;
    $comboActive = false;
    $comboCount = get_option('ticket_combo_count');
    $promoCount = get_option('ticket_promo_count');
    $normalPriceStartDate = get_option('ticket_normal_price_start_date');
    $timeUntilNormalPrice = strtotime($normalPriceStartDate) - current_time('timestamp');

    $tickets_sold = $wpdb->get_var("SELECT COUNT(*) FROM wp_tickets WHERE `paid` = 1");
    $promoActive = $tickets_sold < $promoCount;
    $earlyActive = $timeUntilNormalPrice > 0;

    if ($promoActive)
    {
        $price = $comboPrice = get_option('ticket_promo_price');
    } else {
        if ($earlyActive){
            $price = get_option('ticket_early_price');
        } else {
            $price = get_option('ticket_normal_price');
        }
        $comboPrice = get_option('ticket_combo_price');
    }

    $coupon;
    $validCoupon = false;
    $couponCode = '';

    if (isset($_SESSION['promo'])) {
        $couponCode = $_SESSION['promo'];
        $coupon = get_coupon_from_code($couponCode);
        $validCoupon = $coupon['valid'];
        if ($validCoupon)
        {
            $_SESSION['promo'] = $couponCode;
            $price = $coupon['price'];
        }
    }
    if ($comboPrice > $price)
    {
        $comboPrice = $price;
    }

    return array(
        'tickets_sold' => $tickets_sold,
        'price'=> $price,
        'normal_price' => get_option('ticket_normal_price'),
        'promo_active' => $promoActive,
        'early_active' => $earlyActive,
        'coupon_active' => $validCoupon,
        'combo_price' => $comboPrice,
        'combo_count' => $comboCount,
        'promo_count' => $promoCount,
        'coupon_code' => $couponCode,
        'labels' => array(
            'ticket' => get_option('ticket_name'),
            'promo' => get_option('ticket_promo_label'),
            'early' => get_option('ticket_early_label'),
            'normal' => get_option('ticket_normal_label'),
            'combo' => get_option('ticket_combo_label'),
            'coupon' => $validCoupon ? 'Promo '.$price:''
        )
    );
}

function add_currency_to_price($price) {
    return function_exists('qtrans_getLanguage') && qtrans_getLanguage() == 'fr' ? $price.'$':'$'.$price;
}

function get_current_price(){
    $ticketStatus = get_ticket_status();
    return add_currency_to_price($ticketStatus['price']);
}

function get_normal_price(){
    $ticketStatus = get_ticket_status();
    return add_currency_to_price($ticketStatus['normal_price']);
}

function get_current_price_difference(){
    $ticketStatus = get_ticket_status();
    $priceDifference = $ticketStatus['normal_price'] - $ticketStatus['price'];
    return add_currency_to_price($priceDifference);
}

function get_combo_price(){
    $ticketStatus = get_ticket_status();
	return add_currency_to_price($ticketStatus['combo_price']);
}

function get_promo_count(){
    $ticketStatus = get_ticket_status();
	return $ticketStatus['promo_count'];
}

function get_combo_count(){
    $ticketStatus = get_ticket_status();
	return $ticketStatus['combo_count'];
}

function get_normal_start_date(){
    $timeStamp = strtotime(get_option('ticket_normal_price_start_date'));
    $formatted;
    if (function_exists('qtrans_getLanguage'))
    {
        $locale = qtrans_getLanguage();
        setlocale(LC_ALL,$locale);
        if ($locale == 'fr')
        {
            $formatted = ltrim(strftime('%d %B %Y', $timeStamp), '0');
        } else {
            $formatted = strftime('%B ',$timeStamp).ltrim(strftime('%d',$timeStamp),'0').'th, '.strftime('%Y', $timeStamp);
        }

    }
    return strtolower($formatted);
}

function get_tickets($orderBy, $direction) {
    global $wpdb;
    $orderByStr = '';
    if (strlen($orderBy)>0)
    {
        $orderByStr = 'ORDER BY '.$orderBy.' '.$direction.';';
    }

    return $wpdb->get_results("SELECT * FROM wp_tickets $orderByStr", ARRAY_A);
}

function get_tickets_from_invoice($invoice) {
    global $wpdb;
    return $wpdb->get_results($wpdb->prepare( "SELECT * FROM wp_tickets WHERE `invoice` = %s", $invoice), ARRAY_A);
}

function get_ticket_from_qrcode($qrcode) {
    global $wpdb;
    return $wpdb->get_row($wpdb->prepare( "SELECT * FROM wp_tickets WHERE `qr_code` = %s", $qrcode), ARRAY_A);
}

function scan_ticket($qrcode) {
    global $wpdb;
    $ticket = get_ticket_from_qrcode($qrcode);

    $wpdb->update(
        'wp_tickets',
        array(
            'scanned' =>intval($ticket['scanned']) + 1,
            'scanned_date' => current_time('mysql'),
            'scanned_author' => wp_get_current_user()->display_name
        ),
        array(
            'qr_code' => $qrcode
        ),
        array(
            '%d',
            '%s',
            '%s'
        ),
        array('%s')
    );

    return $ticket;
}

function on_paypal_payment_completed($posted) {
    $invoice = isset($posted['invoice']) ? $posted['invoice'] : '';
    $mc_gross = isset($posted['mc_gross']) ? $posted['mc_gross'] : '';
    $first_name = isset($posted['first_name']) ? $posted['first_name'] : '';
    $last_name = isset($posted['last_name']) ? $posted['last_name'] : '';

    $tickets = get_tickets_from_invoice($invoice);

    if (count($tickets))
    {
        global $wpdb;
        $wpdb->update(
        	'wp_tickets',
        	array(
        		'paid' => 1,
                'paid_date' => current_time('mysql')
        	),
        	array('invoice' => $invoice),
        	array(
        		'%d',
        		'%s'
        	),
        	array('%s')
        );

        foreach ($tickets as $ticket) {
            send_ticket_by_email($ticket);
        }
        $entreprise = $tickets[0]['entreprise'];
    } else {
        $entreprise = 'tickets not found';
    }
    $smsMessage = 'PAYÉ! '.$mc_gross.'$ par '.$first_name.' '.$last_name.' ('.$entreprise.')';
    wp_mail('5142674953@msg.koodomobile.com', '', $smsMessage);
    wp_mail('5146233890@msg.koodomobile.com', '', $smsMessage);
}

function send_email_ticket() {
    $qrcode = isset($_POST['qrcode']) ? $_POST['qrcode']:'';
    $ticket = get_ticket_from_qrcode($qrcode);
    send_ticket_by_email($ticket);

    echo json_encode(array(
        'success' => true
    ));
    wp_die();
}

function create_ticket_and_pay() {
    global $wpdb;
    $invoice = md5(uniqid());
    $quantity = isset($_POST['quantity']) ? $_POST['quantity']:1;
    $ticketStatus = get_ticket_status();
    $price = $ticketStatus['price'];
    $ticketName = $ticketStatus['labels']['ticket'];
    $itemName;
    $paypalSandboxed = get_option('ticket_sandboxed') == 1;
    $paypalUrl = $paypalSandboxed ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

    if ($ticketStatus['coupon_active'])
    {
        $coupon = get_coupon_from_code($ticketStatus['coupon_code']);
        if ($ticketStatus['price'] > $ticketStatus['combo_price'] && $quantity >= $ticketStatus['combo_count'])
        {
            $buttonID = $paypalSandboxed ? get_option('ticket_combo_sandboxed_button_id') : get_option('ticket_combo_button_id');
            $itemName = $ticketStatus['labels']['combo'];
            $price = $ticketStatus['combo_price'];
        } else {
            $buttonID = $paypalSandboxed ? $coupon['button_sandbox_id'] : $coupon['button_id'];
            $itemName = $ticketStatus['labels']['coupon'];
        }

    }
    else if ($ticketStatus['promo_active'])
    {
        $buttonID = $paypalSandboxed ? get_option('ticket_promo_sandboxed_button_id') : get_option('ticket_promo_button_id');
        $itemName = $ticketStatus['labels']['promo'];
    } else {
        if ($quantity < $ticketStatus['combo_count'])
        {
            if ($ticketStatus['early_active']){
                $buttonID = $paypalSandboxed ? get_option('ticket_early_sandboxed_button_id') : get_option('ticket_early_button_id');
                $itemName = $ticketStatus['labels']['early'];
            } else {
                $buttonID = $paypalSandboxed ? get_option('ticket_normal_sandboxed_button_id') : get_option('ticket_normal_button_id');
                $itemName = $ticketStatus['labels']['normal'];
            }
        } else {
            $buttonID = $paypalSandboxed ? get_option('ticket_combo_sandboxed_button_id') : get_option('ticket_combo_button_id');
            $itemName = $ticketStatus['labels']['combo'];
            $price = $ticketStatus['combo_price'];
        }
    }
    if (function_exists('qtrans_getLanguage'))
    {
        $itemName = qtranxf_use(qtranxf_getLanguage(), $itemName);
        $ticketName = qtranxf_use(qtranxf_getLanguage(), $ticketName);
    }

    $userAgent = substr($_SERVER['HTTP_USER_AGENT'], 0, 2048);
    $smsMessage = 'Création de '.$quantity.' billet'.($quantity > 1 ? 's':'').':'."\n".'------------------'."\n";

    for ($i = 0; $i < $quantity;$i++)
    {
        $success = $wpdb->insert('wp_tickets', array(
            'first_name' => isset($_POST['firstname_'.$i]) ? substr($_POST['firstname_'.$i],0,255):'',
            'last_name' => isset($_POST['lastname_'.$i]) ? substr($_POST['lastname_'.$i],0,255):'',
            'entreprise' => isset($_POST['entreprise_'.$i]) ? substr($_POST['entreprise_'.$i],0,255):'',
            'title' => isset($_POST['title_'.$i]) ? substr($_POST['title_'.$i],0,255):'',
            'email' => isset($_POST['email_'.$i]) ? substr($_POST['email_'.$i],0,255):'',
            'telephone' => isset($_POST['telephone_'.$i]) ? substr($_POST['telephone_'.$i],0,255):'',
            'price' => $price,
            'item_name' => $itemName,
            'invoice' => $invoice,
            'qr_code' => md5(uniqid()),
            'user_agent' => $userAgent
        ), array(
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%d',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s'
        ));

        $smsMessage .= 'Nom: '.$_POST['firstname_'.$i].' '.$_POST['lastname_'.$i]."\n".
                       'Entreprise: '.$_POST['entreprise_'.$i]."\n".
                       'Titre: '.$_POST['title_'.$i]."\n".
                       'Email: '.$_POST['email_'.$i]."\n".
                       'Téléphone: '.$_POST['telephone_'.$i]."\n".
                       ($success == 1 ? 'SUCCESS':'FAILED')."\n".
                       '------------------'."\n";
    }

    $paypalFields = array(
        'hosted_button_id' => $buttonID,
        'quantity' => $quantity,
        'invoice' => $invoice,
        'item_name' => $ticketName.' - '.$itemName,
        'notify_url' => home_url().'/?AngellEYE_Paypal_Ipn_For_Wordpress&action=ipn_handler',
        'return' =>  home_url().'/merci/?invoice='.$invoice,
        'cancel_return' =>  home_url().'/billeterie/',
        'rm' =>  2,
        'undefined_ quantity' =>  1,
        'cmd' =>  '_s-xclick',
        'lc' =>  'CA',
        'charset' => 'utf-8',
        'no_note' => '1',
        'cbt' => $quantity <= 1 ? __('See my ticket', 'immersiveproductions') : __('See my tickets', 'immersiveproductions')
    );

    echo json_encode(array(
        'paypal_url' => $paypalUrl,
        'paypal_fields' => $paypalFields
    ));

    wp_mail('5142674953@msg.koodomobile.com', '', $smsMessage);
    wp_mail('5146233890@msg.koodomobile.com', '', $smsMessage);
    wp_die();
}


function generate_ticket_html($ticket)
{
    $imgPath = get_template_directory_uri().'/dist/images/ticket/';
    $imgLogoUrl = $imgPath.'accro-logo-'.(function_exists('qtrans_getLanguage') && qtrans_getLanguage() === 'en' ? 'en':'fr').'.png';
    $imgEventInfosUrl = $imgPath.'event-infos-'.(function_exists('qtrans_getLanguage') && qtrans_getLanguage() === 'en' ? 'en':'fr').'.png';
    $imgSpacerUrl = $imgPath.'vspacer.png';
    $eventInfosAlt = (function_exists('qtrans_getLanguage') && qtrans_getLanguage() === 'en' ? 'At the TOHU - September 29th, 2016 - from 5pm to 10pm':'À la TOHU le 29 septembre 2016 de 17h à 22h');
    $price = function_exists('qtrans_getLanguage') && qtrans_getLanguage() === 'en' ? '$'.$ticket['price']: $ticket['price'].'$';
    $qrCodeUrl = 'https://chart.googleapis.com/chart?chs=90x90&cht=qr&chl='.home_url().'/scan/?billet='.$ticket['qr_code'].'&choe=UTF-8';
    return '<tr>
                <td class="ticket" style="padding: 0;text-align: center;font-size: 0;">
                    <!--[if (gte mso 9)|(IE)]>
                    <table width="100%" style="border-spacing: 0;">
                    <tr>
                    <td width="400px" valign="top" style="padding: 0;">
                    <![endif]-->
                    <div style="max-width: 400px;display: inline-block;vertical-align: top;">
                        <table width="100%" style="border-spacing: 0;">
                            <tr>
                                <td style="padding: 0;">
                                    <table style="border-spacing: 0; width: 100%;border: 1px solid black;">
                                        <tr>
                                            <td style="padding: 0;">
                                                <img src="'.$imgLogoUrl.'" width="400" alt="ACCRO" style="border: 0; width: 100%;height: auto;max-width: 400px;"/>
                                            </td>
                                        </tr>
                                        <tr>
                                             <td style="padding: 0;">
                                                <img src="'.$imgEventInfosUrl.'" width="400" alt="'.$eventInfosAlt.'" style="border: 0; width: 100%;height: auto;max-width: 400px;" />
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!--[if (gte mso 9)|(IE)]>
                        </td><td width="200px" valign="top" style="padding: 0;">
                        <![endif]-->
                        <div class="ticket-infos" style="max-width: 200px;width: 100%;display: inline-block;vertical-align: top;">
                            <table width="100%" style="border-spacing: 0;">
                                <tr>
                                    <td style="padding: 0;">
                                        <table style="border-spacing: 0; color: #000; text-align:center;font-weight: bold;width: 100%;border: 1px solid black;">
                                            <tr>
                                                 <td style="font-size: 14px;padding:0 10px 0 10px;">'.$ticket['first_name'].' '.$ticket['last_name'].'</td>
                                                <td style="padding: 0;visibility:hidden;opacity:0;">
                                                     <img style="border: 0; width: 1px;height:92px;visibility:hidden;opacity:0;" src="'.$imgSpacerUrl.'" width="1" height="92" alt="" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table width="100%" style="border-spacing: 0;border-top:1px solid black;">
                                                        <tr>
                                                            <td style="padding: 0;">
                                                                <table width="100%" style="border-spacing: 0;">
                                                                	<tr>
                                                                        <td style="font-weight: bold;text-align:center;font-size:12px;padding: 0 10px 0 10px;">'.$ticket['item_name'].'</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="font-weight: bold;text-align:center; padding: 0 10px 0 10px; font-size:26px;">'.$price.'</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        	<td style="padding: 0;">
                                                                <img style="border: 0; width:90px;height:90px;"src="'.$qrCodeUrl.'" alt="QR code" width="90" height="90" alt="" />
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!--[if (gte mso 9)|(IE)]>
                        </td>
                        </tr>
                        </table>
                        <![endif]-->
                    </td>
                </tr>
                <tr><td>&nbsp;</td></tr>';
}

function send_ticket_by_email($ticket) {
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
                                '.generate_ticket_html($ticket).'
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

     $subject = __('Your ticket for ACCRO 2016', 'immersiveproductions');
     $headers = "MIME-Version: 1.0" . "\r\n";
     $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
     $attachments = array();
     $qrCodeUrl = 'https://chart.googleapis.com/chart?chs=320x320&cht=qr&chl='.home_url().'/scan/?billet='.$ticket['qr_code'].'&choe=UTF-8';
     if($qrCodeUrl)
     {
         $sanitized = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/','', $ticket['first_name'].'-'.$ticket['last_name'])).'_'.substr($ticket['qr_code'], 0, 5);
         $localUrl = WP_CONTENT_DIR .'/uploads/qrcodes/'.$sanitized.'.png';
         copy($qrCodeUrl, $localUrl);
         $attachments = array( $localUrl );
     }

     wp_mail($ticket['email'], $subject, $html, $headers, $attachments);
}

add_action('wp_ajax_create_ticket_and_pay', __NAMESPACE__ .'\\create_ticket_and_pay');
add_action('wp_ajax_nopriv_create_ticket_and_pay', __NAMESPACE__ .'\\create_ticket_and_pay');

add_action('wp_ajax_send_email_ticket', __NAMESPACE__ .'\\send_email_ticket');
add_action('wp_ajax_nopriv_send_email_ticket', __NAMESPACE__ .'\\send_email_ticket');

add_action('paypal_ipn_for_wordpress_txn_type_web_accept',  __NAMESPACE__ . '\\on_paypal_payment_completed', 10, 1);

add_shortcode('current_price', __NAMESPACE__ . '\\get_current_price');
add_shortcode('current_price_difference', __NAMESPACE__ . '\\get_current_price_difference');
add_shortcode('normal_price', __NAMESPACE__ . '\\get_normal_price');
add_shortcode('combo_price', __NAMESPACE__ . '\\get_combo_price');
add_shortcode('tickets_promo_count', __NAMESPACE__ . '\\get_promo_count');
add_shortcode('tickets_combo_count', __NAMESPACE__ . '\\get_combo_count');
add_shortcode('tickets_normal_start_date', __NAMESPACE__ . '\\get_normal_start_date');
