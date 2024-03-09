<?php
/**
* Sections Repeater Options.
*
* @package Revista
*/

$revista_post_category_list = revista_post_category_list();
$revista_defaults = revista_get_default_theme_options();
$home_sections = array(
        
        'main-banner' => esc_html__('Main Banner Slider','revista'),
        'banner-blocks-1' => esc_html__('Slider & Tab Block','revista'),
        'latest-posts-blocks' => esc_html__('Latest Posts Block','revista'),
        'tiles-blocks' => esc_html__('Tiles Block','revista'),
        'advertise-blocks' => esc_html__('Advertise Block','revista'),
        'home-widget-area' => esc_html__('Widgets Area Block','revista'),
        'you-may-like-blocks' => esc_html__('You May Like Block','revista'),

    );

// Slider Section.
$wp_customize->add_section( 'home_sections_repeater',
	array(
	'title'      => esc_html__( 'Homepage Sections', 'revista' ),
	'priority'   => 150,
	'capability' => 'edit_theme_options',
	)
);


// Recommended Posts Enable Disable.
$wp_customize->add_setting( 'twp_revista_home_sections_4', array(
    'sanitize_callback' => 'revista_sanitize_repeater',
    'default' => json_encode( $revista_defaults['twp_revista_home_sections_4'] ),
    // 'transport'           => 'postMessage',
));

$wp_customize->add_control(  new Revista_Repeater_Controler( $wp_customize, 'twp_revista_home_sections_4', 
    array(
        'section' => 'home_sections_repeater',
        'settings' => 'twp_revista_home_sections_4',
        'revista_box_label' => esc_html__('New Section','revista'),
        'revista_box_add_control' => esc_html__('Add New Section','revista'),
        'revista_box_add_button' => false,
    ),
        array(
            'section_ed' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Section', 'revista' ),
                'class'       => 'home-section-ed'
            ),
            'home_section_type' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Section Type', 'revista' ),
                'options'     => $home_sections,
                'class'       => 'home-section-type'
            ),
            'home_section_title' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title', 'revista' ),
                'class'       => 'home-repeater-fields-hs tiles-blocks-fields you-may-like-blocks-fields'
            ),
            'section_slide_category' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Slider Post Category', 'revista' ),
                'options'     => $revista_post_category_list,
                'class'       => 'home-repeater-fields-hs'
            ),
            'section_category' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category', 'revista' ),
                'options'     => $revista_post_category_list,
                'class'       => 'home-repeater-fields-hs tiles-blocks-fields you-may-like-blocks-fields'
            ),
             'home_section_column_1' => array(
                  'type'        => 'seperator',
                  'seperator_text'       => esc_html__( 'Column 1', 'revista' ),
                  'class'       => 'home-repeater-fields-hs main-banner-fields'
              ),
              'home_section_title_4' => array(
                 'type'        => 'text',
                 'label'       => esc_html__( 'Block Title', 'revista' ),
                 'class'       => 'home-repeater-fields-hs main-banner-fields'
             ),

              'section_post_cat_1' => array(
                  'type'        => 'select',
                  'label'       => esc_html__( 'Select Category', 'revista' ),
                  'options'     => $revista_post_category_list,
                  'class'       => 'home-repeater-fields-hs main-banner-fields'
              ),
              'home_section_column_2' => array(
                   'type'        => 'seperator',
                   'seperator_text'       => esc_html__( 'Column 2', 'revista' ),
                   'class'       => 'home-repeater-fields-hs main-banner-fields'
               ),
             'home_section_title_1' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Slider Area Title', 'revista' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields main-banner-fields'
            ),
            'section_post_slide_cat' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Slider Post Category', 'revista' ),
                'options'     => $revista_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields main-banner-fields'
            ),


            'advertise_image' => array(
                'type'        => 'upload',
                'label'       => esc_html__( 'Advertise Image', 'revista' ),
                'description' => esc_html__( 'Recommended Image Size is 970x250 PX.', 'revista' ),
                'class'       => 'home-repeater-fields-hs advertise-blocks-fields'
            ),
            'advertise_link' => array(
                'type'        => 'link',
                'label'       => esc_html__( 'Advertise Image Link', 'revista' ),
                'class'       => 'home-repeater-fields-hs advertise-blocks-fields'
            ),
            'ed_arrows_carousel' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Arrows', 'revista' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields main-banner-fields'
            ),
            'ed_dots_carousel' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Dot', 'revista' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields main-banner-fields'
            ),

            'section_post_grid_post_cat' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Select Grid Post Category', 'revista' ),
                'options'     => $revista_post_category_list,
                'class'       => 'home-repeater-fields-hs main-banner-fields'
            ),

            'ed_autoplay_carousel' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Autoplay', 'revista' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields'
            ),
            'home_section_column_3' => array(
                 'type'        => 'seperator',
                 'seperator_text'       => esc_html__( 'Column 3', 'revista' ),
                 'class'       => 'home-repeater-fields-hs main-banner-fields'
             ),
            'home_section_title_2' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Tab Area Title', 'revista' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields'
            ),
            'home_section_title_3' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Block Title', 'revista' ),
                'class'       => 'home-repeater-fields-hs main-banner-fields'
            ),
            'ed_tab' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Tab', 'revista' ),
                'class'       => 'home-repeater-fields-hs ed-tabs-ac banner-blocks-1-fields'
            ),
            'cat_title_1' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title One', 'revista' ),
                'class'       => 'home-repeater-fields-hs '
            ),
            'section_category_1' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category One', 'revista' ),
                'options'     => $revista_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields'
            ),
            'cat_title_2' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title Two', 'revista' ),
                'class'       => 'home-repeater-fields-hs '
            ),
            'section_category_2' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category Two', 'revista' ),
                'options'     => $revista_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-block-1-tab-ac banner-blocks-1-fields'
            ),
            'cat_title_3' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title Three', 'revista' ),
                'class'       => 'home-repeater-fields-hs '
            ),
            'section_category_3' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category Three', 'revista' ),
                'options'     => $revista_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-block-1-tab-ac banner-blocks-1-fields'
            ),
            'section_category_4' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category Four', 'revista' ),
                'options'     => $revista_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-block-1-tab-ac banner-blocks-1-fields'
            ),
            'section_vertical_list_category' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Select Category', 'revista' ),
                'options'     => $revista_post_category_list,
                'class'       => 'home-repeater-fields-hs main-banner-fields'
            ),
            'ed_flip_column' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Flip Column Right to Left', 'revista' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields'
            ),
            'background_color' => array(
                'type'        => 'colorpicker',
                'label'       => esc_html__( 'Background Color', 'revista' ),
                'class'       => 'home-repeater-fields-hs main-banner-fields banner-blocks-1-fields latest-posts-blocks-fields tiles-blocks-fields advertise-blocks-fields you-may-like-blocks-fields'
            ),
            'section_text_color' => array(
                'type'        => 'colorpicker',
                'label'       => esc_html__( 'Text Color', 'revista' ),
                'class'       => 'home-repeater-fields-hs main-banner-fields banner-blocks-1-fields latest-posts-blocks-fields tiles-blocks-fields advertise-blocks-fields you-may-like-blocks-fields'
            ),
            'background_image' => array(
                'type'        => 'upload',
                'label'       => esc_html__( 'Background Image', 'revista' ),
                'class'       => 'home-repeater-fields-hs main-banner-fields banner-blocks-1-fields tiles-blocks-fields you-may-like-blocks-fields'
            ),
            'bg_image_size' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Background Image Size', 'revista' ),
                'options'     => array( 
                    'auto' => esc_html('Original','revista'),
                    'contain' => esc_html('Fit to Screen','revista'),
                    'cover' => esc_html('Fill Screen','revista'),
                ),
                'class'       => 'home-repeater-fields-hs main-banner-fields banner-blocks-1-fields tiles-blocks-fields you-may-like-blocks-fields'
            ),
            'background_image_repeat' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Repeat Background Image', 'revista' ),
                'class'       => 'home-repeater-fields-hs main-banner-fields banner-blocks-1-fields tiles-blocks-fields'
            ),
            'background_image_scroll' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Scroll with Page', 'revista' ),
                'class'       => 'home-repeater-fields-hs main-banner-fields banner-blocks-1-fields tiles-blocks-fields you-may-like-blocks-fields'
            ),
    )
));

// Info.
$wp_customize->add_setting(
    'revista_notiece_info',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new Revista_Info_Notiece_Control( 
        $wp_customize,
        'revista_notiece_info',
        array(
            'settings' => 'revista_notiece_info',
            'section'       => 'home_sections_repeater',
            'label'         => esc_html__( 'Info', 'revista' ),
        )
    )
);

$wp_customize->add_setting(
    'revista_premium_notiece',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new Revista_Premium_Notiece_Control( 
        $wp_customize,
        'revista_premium_notiece',
        array(
            'label'      => esc_html__( 'Home Page Blocks', 'revista' ),
            'settings' => 'revista_premium_notiece',
            'section'       => 'home_sections_repeater',
        )
    )
);