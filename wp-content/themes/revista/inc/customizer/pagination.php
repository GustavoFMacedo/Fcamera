<?php
/**
 * Pagination Settings
 *
 * @package Revista
 */

$revista_default = revista_get_default_theme_options();

// Pagination Section.
$wp_customize->add_section( 'revista_pagination_section',
	array(
	'title'      => esc_html__( 'Pagination Settings', 'revista' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
	'panel'		 => 'theme_option_panel',
	)
);

// Pagination Layout Settings
$wp_customize->add_setting( 'revista_pagination_layout',
	array(
	'default'           => $revista_default['revista_pagination_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'revista_pagination_layout',
	array(
	'label'       => esc_html__( 'Pagination Method', 'revista' ),
	'section'     => 'revista_pagination_section',
	'type'        => 'select',
	'choices'     => array(
		'next-prev' => esc_html__('Next/Previous Method','revista'),
		'numeric' => esc_html__('Numeric Method','revista'),
		'load-more' => esc_html__('Ajax Load More Button','revista'),
		'auto-load' => esc_html__('Ajax Auto Load','revista'),
	),
	)
);


// Breadcrumb Section.
$wp_customize->add_section( 'revista_breadcrumb_with_title_block_section',
	array(
	'title'      => esc_html__( 'Breadcrumb Settings', 'revista' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
	'panel'		 => 'theme_option_panel',
	)
);


$wp_customize->add_setting('ed_breadcrumb',
    array(
        'default' => $revista_default['ed_breadcrumb'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'revista_sanitize_checkbox',
    )
);

$wp_customize->add_control('ed_breadcrumb',
    array(
        'label' => esc_html__('Enable Breadcrumb', 'revista'),
        'section' => 'revista_breadcrumb_with_title_block_section',
        'type' => 'checkbox',
    )
);
