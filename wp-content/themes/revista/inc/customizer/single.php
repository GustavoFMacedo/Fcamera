<?php
/**
* Single Post Options.
*
* @package Revista
*/

$revista_default = revista_get_default_theme_options();

$wp_customize->add_section( 'single_post_setting',
	array(
	'title'      => esc_html__( 'Single Post Settings', 'revista' ),
	'priority'   => 35,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);


$wp_customize->add_setting(
    'revista_single_post_layout',
    array(
        'default'           => $revista_default['revista_single_post_layout'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'revista_sanitize_single_post_layout'
    )
);
$wp_customize->add_control(
    new Revista_Custom_Radio_Image_Control(
        $wp_customize,
        'revista_single_post_layout',
        array(
            'settings'      => 'revista_single_post_layout',
            'section'       => 'single_post_setting',
            'label'         => esc_html__( 'Appearance Layout', 'revista' ),
            'choices'       => array(
                'layout-1'  => get_template_directory_uri() . '/assets/images/single-layout-style-1.png',
                'layout-2'  => get_template_directory_uri() . '/assets/images/single-layout-style-2.png',
            )
        )
    )
);

$wp_customize->add_setting('ed_header_overlay',
    array(
        'default' => $revista_default['ed_header_overlay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'revista_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_overlay',
    array(
        'label' => esc_html__('Enable Header Overlay', 'revista'),
        'section' => 'single_post_setting',
        'type' => 'checkbox',
        'active_callback' => 'revista_overlay_layout_ac',
    )
);


$wp_customize->add_setting('ed_post_thumbnail',
    array(
        'default' => $revista_default['ed_post_thumbnail'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'revista_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_thumbnail',
    array(
        'label' => esc_html__('Disable Featured Image', 'revista'),
        'section' => 'single_post_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_floating_next_previous_nav',
    array(
        'default' => $revista_default['ed_floating_next_previous_nav'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'revista_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_floating_next_previous_nav',
    array(
        'label' => esc_html__('Enable Fixed Floating Next/Previous Articles', 'revista'),
        'section' => 'single_post_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_related_post',
    array(
        'default' => $revista_default['ed_related_post'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'revista_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_related_post',
    array(
        'label' => esc_html__('Enable More Stories', 'revista'),
        'section' => 'single_post_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'related_post_title',
    array(
    'default'           => $revista_default['related_post_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'related_post_title',
    array(
    'label'    => esc_html__( 'More Stories Section Title', 'revista' ),
    'section'  => 'single_post_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting('twp_navigation_type',
    array(
        'default' => $revista_default['twp_navigation_type'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'revista_sanitize_single_pagination_layout',
    )
);
$wp_customize->add_control('twp_navigation_type',
    array(
        'label' => esc_html__('Single Post Navigation Type', 'revista'),
        'section' => 'single_post_setting',
        'type' => 'select',
        'choices' => array(
                'no-navigation' => esc_html__('Disable Navigation','revista' ),
                'norma-navigation' => esc_html__('Next Previous Navigation','revista' ),
                'ajax-next-post-load' => esc_html__('Ajax Load Next 3 Posts Contents','revista' )
            ),
    )
);

