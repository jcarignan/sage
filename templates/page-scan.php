<?php /*
    Template Name: Scan
    */
    use Roots\Sage\Extras;
?>

<?php while (have_posts()) : the_post();
    $ticket = null;
    if (isset($_REQUEST['billet']))
    {
        $ticket = Extras\get_ticket_from_qrcode($_REQUEST['billet']);
    }
?>
    <div class="block-main-container">
        <section class="block block-main block-main-content">
            <div class="content-description"><?php the_content(); ?></div>
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
                        <?= $ticket ? Extras\generate_ticket_html($ticket):'';?>
                    </table>
                </div>
            </center>
        </section>
    </div>
<?php endwhile; ?>
