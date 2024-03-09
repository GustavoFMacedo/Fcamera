<?php
/**
* Mailchimp Newsletter Settings.
*
* @package Revista
*/

$revista_defaults = revista_get_default_theme_options();

// Mailchimp Newsletter Section.
$wp_customize->add_section( 'twp_mailchimp_newsletter',
	array(
	'title'      => esc_html__( 'Newsletter Setting', 'revista' ),
	'priority'   => 200,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Newsletter Enable Disable.
$wp_customize->add_setting('ed_mailchimp_newsletter_section',
    array(
        'default' => $revista_defaults['ed_mailchimp_newsletter_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'revista_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_mailchimp_newsletter_section',
    array(
        'label' => esc_html__('Enable Newsletter Section', 'revista'),
        'section' => 'twp_mailchimp_newsletter',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'twp_newsletter_button_text',
    array(
    'default'           => $revista_defaults['twp_newsletter_button_text'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'twp_newsletter_button_text',
    array(
    'label'    => esc_html__( 'Newsletter Button Text', 'revista' ),
    'section'  => 'twp_mailchimp_newsletter',
    'type'     => 'text',
    )

);
// Newsletter Image
$wp_customize->add_setting('twp_newsletter_image_section',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
);
$wp_customize->add_control( new WP_Customize_Image_Control(
    $wp_customize,
    'twp_newsletter_image_section',
        array(
            'label'      => esc_html__( 'Newsletter Section Background Image', 'revista' ),
            'section'    => 'twp_mailchimp_newsletter',
        )
    )
);


// Newsletter Title.
$wp_customize->add_setting( 'twp_newsletter_title_section',
    array(
    'default'           => $revista_defaults['twp_newsletter_title_section'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'twp_newsletter_title_section',
    array(
    'label'    => esc_html__( 'Newsletter Section Title', 'revista' ),
    'section'  => 'twp_mailchimp_newsletter',
    'type'     => 'text',
    )
);

// Newsletter Description.
$wp_customize->add_setting( 'twp_newsletter_desc_section',
    array(
    'default'           => $revista_defaults['twp_newsletter_desc_section'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'twp_newsletter_desc_section',
    array(
    'label'    => esc_html__( 'Newsletter Section Description', 'revista' ),
    'section'  => 'twp_mailchimp_newsletter',
    'type'     => 'text',
    )
);

// Mailchimp Shortcode.
$wp_customize->add_setting( 'twp_mailchimp_shortcode_section',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'twp_mailchimp_shortcode_section',
    array(
    'label'    => esc_html__( 'Mailchimp Shortcode', 'revista' ),
    'section'  => 'twp_mailchimp_newsletter',
    'type'     => 'textarea',
    )
);
