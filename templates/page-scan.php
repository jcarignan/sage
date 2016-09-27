<?php /*
    Template Name: Scan
    */
    use Roots\Sage\Extras;
?>

<?php while (have_posts()) : the_post();
    $ticket = null;
    $requestedTicket = isset($_REQUEST['billet']);
    $loggedIn = is_user_logged_in();

    if ($loggedIn && $requestedTicket) {
        $qrCode = $_REQUEST['billet'];
        $ticket = Extras\scan_ticket_php($qrCode);
        $qrCodeUrl = 'https://chart.googleapis.com/chart?chs=90x90&cht=qr&chl='.home_url().'/scan/?billet='.$qrCode.'&choe=UTF-8';

        $status = '';
        $message = '';
        $name = '';
        $title = '';
        $entreprise = '';

        if (!$ticket)
        {
            $status = 'failed';
            $message = 'Billet invalide.';
        } else {
            $name = ucfirst($ticket['first_name']).' '.ucfirst($ticket['last_name']);
            $title = ucfirst($ticket['title']);
            $entreprise = ucfirst($ticket['entreprise']);

            if ($ticket['scanned'] == 0)
            {
                $status = 'success';
                $message = 'Bienvenue!';
            } else {
                $status = 'warning';
                $message = 'Déjà scanné à '.$ticket['scanned_date_formatted'];
                $message .= ' par '.$ticket['scanned_author'].' ('.$ticket['scanned'].'&nbsp;fois)';
            }
        }

    }

?>
    <div class="block-main-container">
        <section class="block block-main block-main-content">
            <?php if (!$loggedIn):
                $base_url = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' .  $_SERVER['HTTP_HOST'];
                $url = $base_url . $_SERVER["REQUEST_URI"];
                        wp_login_form(array(
                           'remember' => false,
                           'redirect' => $url,
                           'label_username' => __('Username / Email', 'immersiveproductions').':',
                           'label_password' => __('Password', 'immersiveproductions').':'
                       ));
                  elseif ($requestedTicket):?>
                  <div class="content-scanner-static">
                      <div class="app-logo"></div>
                      <div class="qr-result-container">
                          <div class="qr-result">
                              <div class="user-info message"><?=$message?></div>
                              <div class="user-info name"><?=$name?></div>
                              <div class="user-info title"><?=$title?></div>
                              <div class="user-info entreprise"><?=$entreprise?></div>
                          </div>
                      </div>
                      <div class="qr-status-container">
                          <div class="qr-status <?=$status?>">
                              <canvas class="qr-image" style="background-image:url(<?=$qrCodeUrl?>)"></canvas>
                              <div class="qr-icon"></div>
                              <div class="qr-label"></div>
                          </div>
                      </div>
                  </div>
                <?php else:?>
                <div class="content-scanner">
                    <div class="scanner-container">
                        <canvas id="qr-canvas"></canvas>
                        <video class="qr-scanner" autoplay></video>
                        <button class="device-switcher" type="button"></button>
                    </div>
                    <div class="app-logo"></div>
                    <div class="qr-result-container">
                        <div class="qr-result">
                            <div class="user-info message"></div>
                            <div class="user-info name"></div>
                            <div class="user-info title"></div>
                            <div class="user-info entreprise"></div>
                        </div>
                    </div>
                    <div class="qr-status-container">
                        <div class="qr-status">
                            <canvas class="qr-image"></canvas>
                            <div class="qr-icon"></div>
                            <div class="qr-label"></div>
                        </div>
                    </div>
                </div>
            <?php endif;?>
        </section>
    </div>
<?php endwhile; ?>
