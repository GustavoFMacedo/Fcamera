<?php
/**
* Header Options.
*
* @package Revista
*/

$revista_default = revista_get_default_theme_options();
$revista_page_lists = revista_page_lists();
$revista_post_category_list = revista_post_category_list();

// Header Advertise Area Section.
$wp_customize->add_section( 'main_header_setting',
	array(
	'title'      => esc_html__( 'Header Settings', 'revista' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
	)
);

$wp_customize->add_setting('ed_header_ad',
    array(
        'default' => $revista_default['ed_header_ad'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'revista_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_ad',
    array(
        'label' => esc_html__('Enable Top Advertisement Area', 'revista'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('header_ad_image',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
);
$wp_customize->add_control( new WP_Customize_Image_Control(
    $wp_customize,
    'header_ad_image',
        array(
            'label'      => esc_html__( 'Top Header AD Image', 'revista' ),
            'section'    => 'main_header_setting',
            'active_callback' => 'revista_header_ad_ac',
        )
    )
);

$wp_customize->add_setting('ed_header_link',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control('ed_header_link',
    array(
        'label' => esc_html__('AD Image Link', 'revista'),
        'section' => 'main_header_setting',
        'type' => 'text',
        'active_callback' => 'revista_header_ad_ac',
    )
);


$wp_customize->add_setting('ed_header_new_entry_posts',
    array(
        'default' => $revista_default['ed_header_new_entry_posts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'revista_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_new_entry_posts',
    array(
        'label' => esc_html__('Enable New Entry Posts', 'revista'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'ed_header_new_entry_posts_title',
    array(
    'default'           => $revista_default['ed_header_new_entry_posts_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'ed_header_new_entry_posts_title',
    array(
    'label'       => esc_html__( 'New Entry Section Title', 'revista' ),
    'section'     => 'main_header_setting',
    'type'        => 'text',
    )
);


$wp_customize->add_setting( 'revista_header_new_entry_cat',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'revista_sanitize_select',
    )
);
$wp_customize->add_control( 'revista_header_new_entry_cat',
    array(
    'label'       => esc_html__( 'New Entry Posts Category', 'revista' ),
    'section'     => 'main_header_setting',
    'type'        => 'select',
    'choices'     => $revista_post_category_list,
    )
);



// Archive Layout.
$wp_customize->add_setting(
    'revista_header_bg_size',
    array(
        'default'           => $revista_default['revista_header_bg_size'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control('revista_header_bg_size',
        array(
            'type'       => 'select',
            'section'       => 'header_image',
            'label'         => esc_html__( 'Header BG Size', 'revista' ),
            'choices'       => array(
                '1'  => esc_html__( 'Small', 'revista' ),
                '2'  => esc_html__( 'Medium', 'revista' ),
                '3'  => esc_html__( 'Large', 'revista' ),
            )
        )
);

$wp_customize->add_setting('ed_header_bg_fixed',
    array(
        'default' => $revista_default['ed_header_bg_fixed'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'revista_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_bg_fixed',
    array(
        'label' => esc_html__('Enable Fixed BG', 'revista'),
        'section' => 'header_image',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_header_bg_overlay',
    array(
        'default' => $revista_default['ed_header_bg_overlay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'revista_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_bg_overlay',
    array(
        'label' => esc_html__('Enable BG Overlay', 'revista'),
        'section' => 'header_image',
        'type' => 'checkbox',
    )
);

// Trending News Section
$wp_customize->add_section( 'header_news_section',
    array(
    'title'      => esc_html__( 'Main Navigation Area', 'revista' ),
    'priority'   => 15,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
    )
);

$wp_customize->add_setting('ed_header_trending_news',
    array(
        'default' => $revista_default['ed_header_trending_news'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'revista_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_trending_news',
    array(
        'label' => esc_html__('Enable Trending News', 'revista'),
        'section' => 'header_news_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'ed_header_trending_posts_title',
    array(
    'default'           => $revista_default['ed_header_trending_posts_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'ed_header_trending_posts_title',
    array(
    'label'       => esc_html__( 'Trending News Title', 'revista' ),
    'section'     => 'header_news_section',
    'type'        => 'text',
    )
);


$wp_customize->add_setting( 'revista_header_trending_cat',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'revista_sanitize_select',
    )
);
$wp_customize->add_control( 'revista_header_trending_cat',
    array(
    'label'       => esc_html__( 'Trending News Posts Category', 'revista' ),
    'section'     => 'header_news_section',
    'type'        => 'select',
    'choices'     => $revista_post_category_list,
    )
);