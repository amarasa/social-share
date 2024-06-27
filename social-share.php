<?php

/*
Plugin Name: Social Share
Plugin URI: http://kaleidico.com
Description: Displays Social Share icons below every post
Version: 1.6
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
    add_settings_field("social-share-pinterest", "Do you want to display Pinterest share button?", "social_share_pinterest_checkbox", "social-share", "social_share_config_section");

    add_settings_field("social-share-print", "Do you want to display Print button?", "social_share_print_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-email", "Do you want to display Email button?", "social_share_email_checkbox", "social-share", "social_share_config_section");


    register_setting("social_share_config_section", "social-share-facebook");
    register_setting("social_share_config_section", "social-share-twitter");
    register_setting("social_share_config_section", "social-share-linkedin");
    register_setting("social_share_config_section", "social-share-reddit");
    register_setting("social_share_config_section", "social-share-pinterest");

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
        $html .= "<div class='facebook mr-4 mb-4'><a target='_blank' href='http://www.facebook.com/sharer.php?u=" . $url . "'>
        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path d='M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z'/></svg>
        </a></div>";
    }

    if (get_option("social-share-twitter") == 1) {
        $html .= "<div class='twitter mr-4 mb-4'><a target='_blank' href='https://twitter.com/share?url=" . $url . "'>
        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path d='M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z'/></svg>
        </a></div>";
    }

    if (get_option("social-share-linkedin") == 1) {
        $html .= "<div class='linkedin mr-4 mb-4'><a target='_blank' href='http://www.linkedin.com/shareArticle?url=" . $url . "'>
        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'><path d='M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z'/></svg>
        </a></div>";
    }

    if (get_option("social-share-reddit") == 1) {
        $html .= "<div class='reddit mr-4 mb-4'><a target='_blank' href='http://reddit.com/submit?url=" . $url . "'>
        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path d='M373 138.6c-25.2 0-46.3-17.5-51.9-41l0 0c-30.6 4.3-54.2 30.7-54.2 62.4l0 .2c47.4 1.8 90.6 15.1 124.9 36.3c12.6-9.7 28.4-15.5 45.5-15.5c41.3 0 74.7 33.4 74.7 74.7c0 29.8-17.4 55.5-42.7 67.5c-2.4 86.8-97 156.6-213.2 156.6S45.5 410.1 43 323.4C17.6 311.5 0 285.7 0 255.7c0-41.3 33.4-74.7 74.7-74.7c17.2 0 33 5.8 45.7 15.6c34-21.1 76.8-34.4 123.7-36.4l0-.3c0-44.3 33.7-80.9 76.8-85.5C325.8 50.2 347.2 32 373 32c29.4 0 53.3 23.9 53.3 53.3s-23.9 53.3-53.3 53.3zM157.5 255.3c-20.9 0-38.9 20.8-40.2 47.9s17.1 38.1 38 38.1s36.6-9.8 37.8-36.9s-14.7-49.1-35.7-49.1zM395 303.1c-1.2-27.1-19.2-47.9-40.2-47.9s-36.9 22-35.7 49.1c1.2 27.1 16.9 36.9 37.8 36.9s39.3-11 38-38.1zm-60.1 70.8c1.5-3.6-1-7.7-4.9-8.1c-23-2.3-47.9-3.6-73.8-3.6s-50.8 1.3-73.8 3.6c-3.9 .4-6.4 4.5-4.9 8.1c12.9 30.8 43.3 52.4 78.7 52.4s65.8-21.6 78.7-52.4z'/></svg>
        </a></div>";
    }

    if (get_option("social-share-pinterest") == 1) {
        $html .= "<div class='pinterest mr-4 mb-4'><a target='_blank' href='http://pinterest.com/pinthis?url=" . $url . "'>
        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 496 512'><path d='M496 256c0 137-111 248-248 248-25.6 0-50.2-3.9-73.4-11.1 10.1-16.5 25.2-43.5 30.8-65 3-11.6 15.4-59 15.4-59 8.1 15.4 31.7 28.5 56.8 28.5 74.8 0 128.7-68.8 128.7-154.3 0-81.9-66.9-143.2-152.9-143.2-107 0-163.9 71.8-163.9 150.1 0 36.4 19.4 81.7 50.3 96.1 4.7 2.2 7.2 1.2 8.3-3.3 .8-3.4 5-20.3 6.9-28.1 .6-2.5 .3-4.7-1.7-7.1-10.1-12.5-18.3-35.3-18.3-56.6 0-54.7 41.4-107.6 112-107.6 60.9 0 103.6 41.5 103.6 100.9 0 67.1-33.9 113.6-78 113.6-24.3 0-42.6-20.1-36.7-44.8 7-29.5 20.5-61.3 20.5-82.6 0-19-10.2-34.9-31.4-34.9-24.9 0-44.9 25.7-44.9 60.2 0 22 7.4 36.8 7.4 36.8s-24.5 103.8-29 123.2c-5 21.4-3 51.6-.9 71.2C65.4 450.9 0 361.1 0 256 0 119 111 8 248 8s248 111 248 248z'/></svg>
        </a></div>";
    }

    if (get_option("social-share-email") == 1) {
        $html .= "<div class='email mr-4 mb-4'><a href='mailto:?body=Hi, I found this article and thought you might like it " . $url . "'>
        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path d='M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z'/></svg>
        </a></div>";
    }

    if (get_option("social-share-print") == 1) {
        $html .= "<div class='print mr-4 mb-4'><a href='javascript:window.print()'>
        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path d='M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z'/></svg>
        </a></div>";
    }

    return $content . $html;
}

add_shortcode("social-share-icons", "add_social_share_icons");


