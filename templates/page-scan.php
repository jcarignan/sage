<?php /*
    Template Name: Scan
    */
    use Roots\Sage\Extras;
?>

<?php while (have_posts()) : the_post();
    $ticket = null;
    if (isset($_REQUEST['billet']))
    {
        $ticket = Extras\scan_ticket($_REQUEST['billet']);
    }

    $loggedIn = is_user_logged_in();

    if ($loggedIn && $ticket) {
        $name = ucfirst($ticket['first_name']).' '.ucfirst($ticket['last_name']);
        $title = ucfirst($ticket['title']);
        $entreprise = ucfirst($ticket['entreprise']);
        $message = '';
        if ($ticket['scanned'] == 0)
        {
            $message = 'Bienvenue!';
        } else {
            $message = 'Déjà scanné à ';
            $timeStamp = strtotime($ticket['scanned_date']);
            if (function_exists('qtrans_getLanguage'))
            {
                $locale = qtrans_getLanguage();
                setlocale(LC_ALL,$locale);
            }
            $message .= strftime('%H:%M:%S', $timeStamp);
            $message .= '<br/>par '.$ticket['scanned_author'].'.';
            $message .= '<br/>('.$ticket['scanned'].' fois)';
        }

    }

?>
    <div class="block-main-container">
        <section class="block block-main block-main-content">
            <?php if (!$loggedIn):?>
                <?php wp_login_form(get_permalink()); ?>
            <?php elseif (!$ticket):?>
                <div class="content-scanner">
                    <div class="qr-result">Scanning...</div>
                    <video id="qr-scanner" autoplay></video>
                </div>
            <?php else:?>
                <h1 class="message"><?=$message?></h1>
                <h4 class="name"><?=$name?></h4>
                <h5 class="title"><?=$title?></h5>
                <h6 class="entreprise"><?=$entreprise?></h6>
            <?php endif;?>
        </section>
    </div>
<?php endwhile; ?>
