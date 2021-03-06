<?php /*
    Template Name: Thankyou
    */
    use Roots\Sage\Extras;
?>

<?php while (have_posts()) : the_post();
    $tickets = array();
    if (isset($_REQUEST['invoice']))
    {
        $tickets = Extras\get_tickets_from_invoice($_REQUEST['invoice']);
    }
?>
    <div class="block-main-container">
        <section class="block block-main block-main-content">
        <div class="content-description"><?= count($tickets) >1 ? str_replace('votre billet', 'vos billets', str_replace('your ticket', 'your tickets', get_the_content())):get_the_content(); ?></div>
        </section>
        <section class="block block-main block-main-tickets">
            <center class="wrapper" style="width: 100%; table-layout: fixed; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
                <div class="webkit" style="max-width: 600px;margin: 0 auto;">
                    <!--[if (gte mso 9)|(IE)]>
                    <table width="600" align="center">
                    <tr>
                    <td style="padding: 0;">
                    <![endif]-->
                    <table class="outer" align="center" style="font-family: Noto Sans, Arial, Helvetica, sans-serif !important;border-spacing: 0; margin: 0 auto;width: 100%;max-width: 600px;">
                        <?php
                        foreach($tickets as $ticket){
                            echo Extras\generate_ticket_html($ticket);
                        }?>
                    </table>
                </div>
            </center>
        </section>
    </div>
<?php endwhile; ?>
