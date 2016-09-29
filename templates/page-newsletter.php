<?php /*
    Template Name: Newsletter
    */
    use Roots\Sage\Extras;
    ?>
<?php while (have_posts()) : the_post();?>
    <div class="block-main-container">
        <section class="block block-main block-main-content" style="text-align:center;">
            <?php
                if (is_user_logged_in())
                {
                    echo 'Envoi simple:';
                    echo '<input type="email" class="single-email" style="margin: 30px; padding: 10px; min-width: 100px;" placeholder="Email" />';
                    echo '<button type="button" class="send-single" style="border:1px solid black; padding: 10px; min-width: 100px;">Envoyer</button>';
                    /*echo '<br/>';
                    echo '<button class="send-newsletter" type="button" style="border:2px solid black; margin: 40px; padding: 20px; min-width: 200px;">Envoyer à tous</button>';
                    echo '<div class="results" style="padding: 20px; margin: 40xp;"></div>';*/
                } else {
                    $base_url = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' .  $_SERVER['HTTP_HOST'];
                    $url = $base_url . $_SERVER["REQUEST_URI"];
                            wp_login_form(array(
                               'remember' => false,
                               'redirect' => $url,
                               'label_username' => __('Username / Email', 'immersiveproductions').':',
                               'label_password' => __('Password', 'immersiveproductions').':'
                           ));
                }
            ?>
        </section>
    </div>
<?php endwhile; ?>
