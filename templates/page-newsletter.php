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
                    echo '<button class="send-newsletter" type="button" style="border:2px solid black; margin: 40px; padding: 20px; min-width: 200px;">Envoyer l\'infolettre</button>';
                    echo '<div class="results" style="padding: 20px; margin: 40xp;"></div>';
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
