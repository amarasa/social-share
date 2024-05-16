<?php

/*
Plugin Name: Social Share
Plugin URI: http://kaleidico.com
Description: Displays Social Share icons below every post
Version: 1.1
Author: Angelo Marasa
*/

// Updater
require 'puc/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/amarasa/social-share',
    __FILE__,
    'social-share'
);

//Set the branch that contains the stable release.
//$myUpdateChecker->setBranch('stable-branch-name');

//Optional: If you're using a private repository, specify the access token like this:
// $myUpdateChecker->setAuthentication('your-token-here');

/* -------------------------------------------------------------------------------------- */


function social_share_menu_item()
{
    add_submenu_page("options-general.php", "Kaleidico Social Share", "Kaleidico Social Share", "manage_options", "social-share", "social_share_page");
}
add_action("admin_menu", "social_share_menu_item");

function social_share_page()
{
?>
    <div class="wrap">
        <h1>Social Sharing Options</h1>

        <form method="post" action="options.php">
            <?php
            settings_fields("social_share_config_section");

            do_settings_sections("social-share");

            submit_button();
            ?>
        </form>
    </div>
<?php
}

function social_share_settings()
{
    add_settings_section("social_share_config_section", "", null, "social-share");

    add_settings_field("social-share-facebook", "Do you want to display Facebook share button?", "social_share_facebook_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-twitter", "Do you want to display Twitter share button?", "social_share_twitter_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-linkedin", "Do you want to display LinkedIn share button?", "social_share_linkedin_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-reddit", "Do you want to display Reddit share button?", "social_share_reddit_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-google-plus", "Do you want to display Google Plus share button?", "social_share_google_plus_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-pinterest", "Do you want to display Pinterest share button?", "social_share_pinterest_checkbox", "social-share", "social_share_config_section");

    add_settings_field("social-share-print", "Do you want to display Print button?", "social_share_print_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-email", "Do you want to display Email button?", "social_share_email_checkbox", "social-share", "social_share_config_section");


    register_setting("social_share_config_section", "social-share-facebook");
    register_setting("social_share_config_section", "social-share-twitter");
    register_setting("social_share_config_section", "social-share-linkedin");
    register_setting("social_share_config_section", "social-share-reddit");
    register_setting("social_share_config_section", "social-share-pinterest");
    register_setting("social_share_config_section", "social-share-google-plus");

    register_setting("social_share_config_section", "social-share-print");
    register_setting("social_share_config_section", "social-share-email");
}

function social_share_facebook_checkbox()
{
?>
    <input type="checkbox" name="social-share-facebook" value="1" <?php checked(1, get_option('social-share-facebook'), true); ?> /> Check for Yes
<?php
}

function social_share_twitter_checkbox()
{
?>
    <input type="checkbox" name="social-share-twitter" value="1" <?php checked(1, get_option('social-share-twitter'), true); ?> /> Check for Yes
<?php
}

function social_share_linkedin_checkbox()
{
?>
    <input type="checkbox" name="social-share-linkedin" value="1" <?php checked(1, get_option('social-share-linkedin'), true); ?> /> Check for Yes
<?php
}

function social_share_reddit_checkbox()
{
?>
    <input type="checkbox" name="social-share-reddit" value="1" <?php checked(1, get_option('social-share-reddit'), true); ?> /> Check for Yes
<?php
}

function social_share_google_plus_checkbox()
{
?>
    <input type="checkbox" name="social-share-google-plus" value="1" <?php checked(1, get_option('social-share-google-plus'), true); ?> /> Check for Yes
<?php
}

function social_share_pinterest_checkbox()
{
?>
    <input type="checkbox" name="social-share-pinterest" value="1" <?php checked(1, get_option('social-share-pinterest'), true); ?> /> Check for Yes
<?php
}

function social_share_print_checkbox()
{
?>
    <input type="checkbox" name="social-share-print" value="1" <?php checked(1, get_option('social-share-print'), true); ?> /> Check for Yes
<?php
}

function social_share_email_checkbox()
{
?>
    <input type="checkbox" name="social-share-email" value="1" <?php checked(1, get_option('social-share-email'), true); ?> /> Check for Yes
<?php
}

add_action("admin_init", "social_share_settings");

function add_social_share_icons($content)
{
    $html = "";

    global $post;

    $url = get_permalink($post->ID);
    $url = esc_url($url);

    if (get_option("social-share-facebook") == 1) {
        $html .= "<div class='facebook xs:mr-4 md:mr-0 mb-4'><a target='_blank' href='http://www.facebook.com/sharer.php?u=" . $url . "'><img src='" . get_template_directory_uri() . "/img/share-facebook.svg' alt='Share on Facebook'></a></div>";
    }

    if (get_option("social-share-twitter") == 1) {
        $html .= "<div class='twitter xs:mr-4 md:mr-0 mb-4'><a target='_blank' href='https://twitter.com/share?url=" . $url . "'><img src='" . get_template_directory_uri() . "/img/share-twitter.svg' alt='Share on Twitter'></a></div>";
    }

    if (get_option("social-share-linkedin") == 1) {
        $html .= "<div class='linkedin xs:mr-4 md:mr-0 mb-4'><a target='_blank' href='http://www.linkedin.com/shareArticle?url=" . $url . "'><img src='" . get_template_directory_uri() . "/img/share-linkedin.svg' alt='Share on LinkedIn'></a></div>";
    }

    if (get_option("social-share-reddit") == 1) {
        $html .= "<div class='reddit xs:mr-4 md:mr-0 mb-4'><a target='_blank' href='http://reddit.com/submit?url=" . $url . "'>Reddit</a></div>";
    }

    if (get_option("social-share-google-plus") == 1) {
        $html .= "<div class='google-plus xs:mr-4 md:mr-0 mb-4'><a target='_blank' href='https://plus.google.com/share?url=" . $url . "'>Google+</a></div>";
    }

    if (get_option("social-share-pinterest") == 1) {
        $html .= "<div class='pinterest xs:mr-4 md:mr-0 mb-4'><a target='_blank' href='http://pinterest.com/pinthis?url=" . $url . "'>Pinterest</a></div>";
    }

    if (get_option("social-share-email") == 1) {
        $html .= "<div class='email xs:mr-4 md:mr-0 mb-4'><a href='mailto:?subject=Check%20this%20article&body=Hi,%20I%20found%20this%20article%20and%20thought%20you%20might%20like%20it:%20" . $url . "'><img src='" . get_template_directory_uri() . "/img/share-email.svg' alt='Email this Article'></a></div>";
    }

    if (get_option("social-share-print") == 1) {
        $html .= "<div class='print xs:mr-4 md:mr-0 mb-4'><a href='javascript:window.print()'><img src='" . get_template_directory_uri() . "/img/share-print.svg' alt='Print this Article'></a></div>";
    }

    return $content . $html;
}
add_shortcode("social-share-icons", "add_social_share_icons");
