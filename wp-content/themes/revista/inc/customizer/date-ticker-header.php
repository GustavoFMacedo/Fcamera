<?php
/**
* Header Options.
*
* @package Revista
*/

$revista_default = revista_get_default_theme_options();
$revista_post_category_list = revista_post_category_list();
$wp_customize->add_section( 'top_header_date_setting',
	array(
	'title'      => esc_html__( 'Header Extras Settings (date, clock)', 'revista' ),
	'priority'   => 13,
	'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
	)
);


$wp_customize->add_setting('ed_ticker_bar',
    array(
        'default' => $revista_default['ed_ticker_bar'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'revista_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_ticker_bar',
    array(
        'label' => esc_html__('Enable Ticker Bar', 'revista'),
        'section' => 'top_header_date_setting',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting('ed_ticker_bar_social_nav',
    array(
        'default' => $revista_default['ed_ticker_bar_social_nav'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'revista_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_ticker_bar_social_nav',
    array(
        'label' => esc_html__('Enable Social Nav', 'revista'),
        'section' => 'top_header_date_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_ticker_bar_date',
    array(
        'default' => $revista_default['ed_ticker_bar_date'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'revista_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_ticker_bar_date',
    array(
        'label' => esc_html__('Enable Current Date', 'revista'),
        'section' => 'top_header_date_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'ticker_date_format',
    array(
    'default'           => $revista_default['ticker_date_format'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'ticker_date_format',
    array(
    'label'       => esc_html__( 'Ticker Date Format', 'revista' ),
    'section'     => 'top_header_date_setting',
    'type'        => 'text',
    )
);
