<?php

/**
 * Revista Dynamic Styles
 *
 * @package Revista
 */

function revista_dynamic_css()
{

    $revista_default = revista_get_default_theme_options();
    $twp_revista_home_sections_4 = get_theme_mod('twp_revista_home_sections_4', json_encode($revista_default['twp_revista_home_sections_4']));
    $twp_revista_home_sections_4 = json_decode($twp_revista_home_sections_4);


    echo "<style type='text/css' media='all'>"; ?>

    <?php

    $repeat_times = 1;

    foreach ($twp_revista_home_sections_4 as $revista_home_section) {

        $section_text_color = esc_attr(isset($revista_home_section->section_text_color) ? $revista_home_section->section_text_color : '');

        if ($section_text_color) { ?>
            #theme-block-<?php echo $repeat_times; ?>,
            #theme-block-<?php echo $repeat_times; ?> a:not(:hover):not(:focus){
            color: <?php echo esc_attr($section_text_color); ?>;
            }

            #theme-block-<?php echo $repeat_times; ?>.theme-main-banner .border-md-highlight .block-title{
            color: <?php echo esc_attr($section_text_color); ?>;
            }

            #theme-block-<?php echo $repeat_times; ?> .theme-article-spacing:not(:last-child){
            border-color: <?php echo revista_hex_2_rgba($section_text_color, 0.25); ?>;
            }

        <?php
        }
        $section_background_color = esc_attr(isset($revista_home_section->background_color) ? $revista_home_section->background_color : '');

        if ($section_background_color) { ?>

            #theme-block-<?php echo $repeat_times; ?> {
            background-color: <?php echo esc_attr($section_background_color); ?>;
            margin-bottom:0;
            }

        <?php
        }

        $background_image = esc_attr(isset($revista_home_section->background_image) ? $revista_home_section->background_image : '');

        if ($background_image) {

            $bg_image_size = isset($revista_home_section->bg_image_size) ? $revista_home_section->bg_image_size : 'auto';
            $background_image_repeat = isset($revista_home_section->background_image_repeat) ? $revista_home_section->background_image_repeat : 'yes';
            $background_image_scroll = isset($revista_home_section->background_image_scroll) ? $revista_home_section->background_image_scroll : 'yes';

            if ($background_image_repeat == 'yes' || $background_image_repeat == '') {
                $background_image_repeat = 'repeat';
            } else {
                $background_image_repeat = 'no-repeat';
            }

            if ($background_image_scroll == 'yes' || $background_image_scroll == '') {
                $background_image_scroll = 'scroll';
            } else {
                $background_image_scroll = 'fixed';
            } ?>

            #theme-block-<?php echo $repeat_times; ?> {
            background-image: url(<?php echo esc_attr($background_image); ?> );
            background-size: <?php echo esc_attr($bg_image_size); ?>;
            background-repeat: <?php echo esc_attr($background_image_repeat); ?>;
            background-attachment: <?php echo esc_attr($background_image_scroll); ?>;
            }

            #theme-block-<?php echo $repeat_times; ?>::before {
            position: absolute;
            content: '';
            top: 0;
            left: 0;
            right: 0;
            height: 100%;
            width: 100%;
            background-color: var(--plain-white);
            opacity: .6;
            }

    <?php
        }

        $repeat_times++;
    } ?>

<?php echo "</style>";
}

add_action('wp_head', 'revista_dynamic_css', 100);

/**
 * Sanitizing Hex color function.
 */
function revista_sanitize_hex_color($color)
{

    if ('' === $color)
        return '';
    if (preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color))
        return $color;
}
