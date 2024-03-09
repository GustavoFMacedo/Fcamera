<?php
/**
 * Default Values.
 *
 * @package Revista
 */

if (!function_exists('revista_get_default_theme_options')) :

    /**
     * Get default theme options
     *
     * @return array Default theme options.
     * @since 1.0.0
     *
     */
    function revista_get_default_theme_options(){

        $revista_defaults = array();

        $revista_defaults['twp_revista_home_sections_4'] = array(

            array(
                'home_section_type' => 'main-banner',
                'section_ed' => 'yes',
                'home_section_title_1' => esc_html__('Column Title Two','revista'),
                'home_section_title_4' => esc_html__('Column Title One','revista'),
                'section_post_cat_1' => '',
                'ed_arrows_carousel' => 'yes',
                'ed_dots_carousel' => 'no',
                'home_section_title_3' => esc_html__('Column Title Three','revista'),
                'section_category_3' => '',
                'background_color' => '#f2f8f8',
                'section_text_color' => '#222'
            ),
            array(
                'home_section_type' => 'tiles-blocks',
                'section_ed' => 'no',
                'section_category' => '',
                'background_color' => '#fff',
                'section_text_color' => '#222'
            ),
            array(
                'home_section_type' => 'banner-blocks-1',
                'section_ed' => 'no',
                'section_category_1' => '',
                'section_category_2' => '',
                'ed_flip_column' => 'no',
                'ed_tab' => 'no',
                'ed_dots_carousel' => 'no',
                'ed_autoplay_carousel' => 'yes',
                'home_section_title_1' => esc_html__('Block Title One','revista'),
                'home_section_title_2' => esc_html__('Block Title Tab','revista'),
                'background_color' => '#f2f8f8',
                'section_text_color' => '#222'
            ),
            array(
                'home_section_type' => 'latest-posts-blocks',
                'section_ed' => 'yes',
                'background_color' => '#fff',
                'section_text_color' => '#222'
            ),
            array(
                'home_section_type' => 'advertise-blocks',
                'section_ed' => 'no',
                'advertise_image' => '',
                'advertise_link' => '',
                'background_color' => '#fff',
                'section_text_color' => '#222'
            ),
            array(
                'home_section_type' => 'home-widget-area',
                'section_ed' => 'yes',
            ),
            array(
                'home_section_type' => 'you-may-like-blocks',
                'section_ed' => 'yes',
                'home_section_title' => '',
                'section_category' => '',
                'background_color' => '#fff',
                'section_text_color' => '#222'
            ),
        );

        // header section
        $revista_defaults['ed_header_new_entry_posts'] = 1;
        $revista_defaults['ed_header_new_entry_posts_title'] = esc_html__('New Entry : From Editor', 'revista');
        $revista_defaults['revista_header_new_entry_cat'] = '';

        // Options.
        $revista_defaults['global_sidebar_layout'] = 'left-sidebar';
        $revista_defaults['revista_archive_layout'] = 'default';
        $revista_defaults['revista_pagination_layout'] = 'numeric';
        $revista_defaults['ed_breadcrumb'] = 1;
        $revista_defaults['footer_column_layout'] = 3;
        $revista_defaults['footer_copyright_text'] = esc_html__('All rights reserved.', 'revista');
        $revista_defaults['ed_ticker_slider_autoplay'] = 1;
        $revista_defaults['ed_header_trending_news'] = 1;
        $revista_defaults['ed_header_trending_posts_title'] = esc_html__('Trending News', 'revista');
        $revista_defaults['ed_header_ad'] = 0;
        $revista_defaults['ticker_date_format'] = 'l, F jS, Y';
        $revista_defaults['ed_image_content_inverse'] = 0;
        $revista_defaults['ed_related_post'] = 1;
        $revista_defaults['related_post_title'] = esc_html__('More Stories', 'revista');
        $revista_defaults['twp_navigation_type'] = 'norma-navigation';
        $revista_defaults['revista_single_post_layout'] = 'layout-2';
        $revista_defaults['ed_post_thumbnail'] = 0;
        $revista_defaults['ed_post_date'] = 1;
        $revista_defaults['ed_post_category'] = 1;
        $revista_defaults['ed_header_overlay'] = 0;
        $revista_defaults['ed_floating_next_previous_nav'] = 1;       
        $revista_defaults['revista_header_bg_size'] = 1;
        $revista_defaults['ed_preloader'] = 1;
        $revista_defaults['ed_header_bg_fixed'] = 0;
        $revista_defaults['ed_header_bg_overlay'] = 0;
        $revista_defaults['post_date_format'] = 'default';
        $revista_defaults['ed_fullwidth_layout'] = 'default';
        $revista_defaults['ed_post_views'] = 0;
        $revista_defaults['ed_scroll_top_button'] = 1;

        $revista_defaults['ed_ticker_bar']                  = 1;
        $revista_defaults['ed_ticker_bar_date']             = 1;
        $revista_defaults['ed_tags_wide_layout']             = 1;
        $revista_defaults['ed_post_tags']                   = 1;
        $revista_defaults['ed_post_read_later']             = 1;
        $revista_defaults['ed_ticker_bar_social_nav']             = 1;

        $revista_defaults['ed_mailchimp_newsletter_section'] = '';
        $revista_defaults['twp_newsletter_button_text'] = esc_html__('Subscribe Now', 'revista');
        $revista_defaults['twp_newsletter_title_section'] = esc_html__('Sign Up to Our Newsletter', 'revista');
        $revista_defaults['twp_newsletter_desc_section'] = esc_html__('Get notified about exclusive offers every week!', 'revista');
        // Pass through filter.
        $revista_defaults = apply_filters('revista_filter_default_theme_options', $revista_defaults);

        return $revista_defaults;

    }

endif;
