<?php /*
    Template Name: Guestlist
    */

    use Roots\Sage\Extras;
?>

<?php while (have_posts()) : the_post();
    $loggedIn = is_user_logged_in();
    if ($loggedIn) {
        $orderBy = isset($_GET['orderby']) ? $_GET['orderby'] :'';
        $direction = isset($_GET['direction']) ? $_GET['direction'] :'ASC';
        $orderByToUse = $orderBy === 'name' ? 'first_name':$orderBy;

        $ticketsOriginal = Extras\get_tickets($orderByToUse, $direction);
        $tickets = array();
        foreach($ticketsOriginal as $ticketOriginal){
            $ticket = array();
            foreach($ticketOriginal as $key => $value){
                $ticket[$key] = $value;
                if ($key == 'last_name')
                {
                    $ticket['name'] = $ticketOriginal['first_name'].' '.$ticketOriginal['last_name'];
                }

                if ($key == 'user_agent' && strlen($ticket[$key]))
                {
                    $browser = Extras\get_browser_from_useragent($ticket[$key]);
                    $ticket['user_agent'] = $browser->getPlatform().' '.$browser->getBrowser().' '.$browser->getVersion();
                }

                if ($key == 'qr_code')
                {
                    $ticket['send_ticket'] = $ticket['qr_code'];
                }
            }
            array_push($tickets, $ticket);
        }
        $paidTickets = 0;
        $soldTickets = 0;
        $scannedTickets = 0;
        $amountPaid = 0;

        foreach($tickets as $ticket) {
            if ($ticket['paid'] == 1)
            {
                $paidTickets++;
                $amountPaid += $ticket['price'];
                if ($ticket['price'] > 0)
                {
                    $soldTickets++;
                }
            }
            if ($ticket['scanned'] > 0 && $ticket['price'] > 0)
            {
                $scannedTickets++;
            }
        }
        $lastInvoice = '';
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
               )); ?>
            <?php else:?>
                <div class="tickets-infos">
                    <div class="confirmed">
                        <span class="label"><?= __('Confirmed', 'immersiveproductions').'s:</span> <span class="amount">'.$paidTickets; ?></span>
                    </div>
                    <div class="sold">
                        <span class="label"><?= __('Sold', 'immersiveproductions').'s:</span> <span class="amount">'.$soldTickets; ?></span>
                    </div>
                    <div class="potential">
                        <span class="label"><?= __('Potential', 'immersiveproductions').'s:</span> <span class="amount">'.(count($tickets) - $paidTickets); ?></span>
                    </div>
                    <div class="scanned">
                        <span class="label"><?= __('Scanned', 'immersiveproductions').'s:</span> <span class="amount">'.$scannedTickets; ?></span>
                    </div>
                    <div class="amount-paid">
                        <span class="label"><?= __('Amount paid', 'immersiveproductions').':</span> <span class="amount">'.$amountPaid; ?></span>$
                    </div>
                    <button class="toggle-view" type="button">Afficher la vue détaillée</button>
                </div>
                <div class="tickets-data">
                    <table border="1">
                        <?php foreach ($tickets as $ticketCount => $ticket): ?>
                            <?php if ($ticketCount === 0): ?>
                                <tr>
                                    <?php foreach ($ticket as $fieldKey => $fieldValue): ?>
                                        <td class="column-name <?=$fieldKey?>">
                                            <a href="<?=get_permalink()?>?orderby=<?=$fieldKey?>&direction=<?=$orderBy === $fieldKey && $direction === 'ASC' ? 'DESC':'ASC'?>"><?=$fieldKey?></a>
                                        </td>
                                    <?php endforeach;?>
                                </tr>
                            <?php endif;?>
                            <tr class="ticket <?=($ticket['scanned'] > 0 ? 'ticket-scanned ':'').($ticket['paid'] == 0 ? 'ticket-unpaid':($ticket['price']==0?'ticket-free':'ticket-paid'))?>" style="border-top: <?=$lastInvoice === $ticket['invoice']?'0':'4px solid black;'?>">
                                <?php foreach ($ticket as $fieldKey => $fieldValue): ?>
                                    <td class="field <?=$fieldKey?>">
                                    <?php if ($fieldKey === 'paid' || ($fieldKey === 'scanned' && ($fieldValue == 0 || $fieldValue == 1))): ?>
                                        <input type="checkbox" disabled <?php checked( $fieldValue, 1); ?>>
                                    <?php elseif ($fieldKey === 'send_ticket'): ?>
                                        <?php if ($ticket['paid'] == 1): ?>
                                            <button class="email-qr-code" type="button" data-qrcode="<?=$fieldValue?>">Email</button>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?=stripcslashes($fieldValue);?>
                                    <?php endif; ?>
                                    </td>
                                <?php endforeach;?>
                            </tr>
                            <?php $lastInvoice = $ticket['invoice'];?>
                        <?php endforeach;?>
                    </table>
                </div>
            <?php endif;?>
        </section>
    </div>
<?php endwhile; ?>
