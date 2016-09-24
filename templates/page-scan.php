<?php /*
    Template Name: Scan
    */
    use Roots\Sage\Extras;
?>

<?php while (have_posts()) : the_post();
    $ticket = null;
    if (isset($_REQUEST['billet']))
    {
        $ticket = Extras\scan_ticket_php($_REQUEST['billet']);
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
            $message = 'Déjà scanné à '.$ticket['scanned_date_formatted'];
            $message .= '<br/>par '.$ticket['scanned_author'].'. ('.$ticket['scanned'].' fois)';
        }

    }

?>
    <div class="block-main-container">
        <section class="block block-main block-main-content">
            <?php if (!$loggedIn):?>
                <?php wp_login_form(get_permalink()); ?>
            <?php elseif (!$ticket):?>
                <div class="content-scanner">
                    <div class="scanner-container">
                        <canvas id="qr-canvas"></canvas>
                        <video class="qr-scanner" autoplay></video>
                        <button class="device-switcher" type="button"></button>
                    </div>
                    <div class="app-logo"></div>
                    <div class="qr-result">
                        <div class="user-info name"></div>
                        <div class="user-info title"></div>
                        <div class="user-info entreprise"></div>
                    </div>
                    <div class="qr-status-container">
                        <div class="qr-status">
                            <canvas class="qr-image"></canvas>
                            <div class="qr-label"></div>
                        </div>
                    </div>
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
