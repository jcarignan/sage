<?php /*
    Template Name: Testmail
    */
    use Roots\Sage\Extras;

    if (isset($_REQUEST['email']) && !empty($_REQUEST["email"]))
    {
        $subject = "Test email from accro";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $html = "Test";
        wp_mail($_REQUEST['email'], $subject, $html, $headers);
        echo '<div style="text-align:center;">Sent to '.$_REQUEST['email'].'!</div>';
    } else {
        echo '<form action="/testemail" method="GET" style="text-align: center;"><input type="email" name="email" placeholder="Email" /><input type="submit" value="Send" /></form>';
    }
?>
