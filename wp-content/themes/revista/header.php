<?php

/**
 * Header file for the Revista WordPress theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Revista
 * @since 1.0.0
 */
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php
    if (function_exists('wp_body_open')) {
        wp_body_open();
    } ?>

    <?php
    $revista_default = revista_get_default_theme_options();

    $ed_preloader = get_theme_mod('ed_preloader', $revista_default['ed_preloader']);
    if ($ed_preloader) { ?>

        <div class="preloader hide-no-js">
            <div class="preloader-wrapper">
                <div class="preloader-square-swapping">
                    <div class="cssload-square-part cssload-square-orange"></div>
                    <div class="cssload-square-part cssload-square-purple"></div>
                    <div class="cssload-square-blend"></div>
                </div>
            </div>
        </div>

    <?php } ?>

    <div id="page" class="hfeed site">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to the content', 'revista'); ?></a>

        <?php revista_header_ad(); ?>

        <?php
        get_template_part('template-parts/header/header', 'content'); ?>

        <?php revista_header_banner(); ?>

        <div id="content" class="site-content">