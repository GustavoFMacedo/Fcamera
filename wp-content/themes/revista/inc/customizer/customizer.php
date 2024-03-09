<?php
/**
 * Revista Theme Customizer
 *
 * @package Revista
 */

/** Sanitize Functions. **/
	require get_template_directory() . '/inc/customizer/default.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if (!function_exists('revista_customize_register')) :

function revista_customize_register( $wp_customize ) {

	require get_template_directory() . '/inc/customizer/active-callback.php';
	require get_template_directory() . '/inc/customizer/custom-classes.php';
	require get_template_directory() . '/inc/customizer/sanitize.php';
	require get_template_directory() . '/inc/customizer/layout.php';
	require get_template_directory() . '/inc/customizer/preloader.php';
	require get_template_directory() . '/inc/customizer/date-ticker-header.php';
	require get_template_directory() . '/inc/customizer/header.php';
	require get_template_directory() . '/inc/customizer/repeater.php';
	require get_template_directory() . '/inc/customizer/pagination.php';
	require get_template_directory() . '/inc/customizer/post.php';
	require get_template_directory() . '/inc/customizer/single.php';
	require get_template_directory() . '/inc/customizer/newsletter.php';
	require get_template_directory() . '/inc/customizer/footer.php';

	$wp_customize->get_section( 'colors' )->panel = 'theme_colors_panel';
	$wp_customize->get_section( 'colors' )->title = esc_html__('Color Options','revista');
	$wp_customize->get_section( 'title_tagline' )->panel = 'theme_general_settings';
	$wp_customize->get_section( 'header_image' )->panel = 'theme_general_settings';
	$wp_customize->get_section( 'background_image' )->panel = 'theme_general_settings';
    

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.header-titles .custom-logo-name',
			'render_callback' => 'revista_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'revista_customize_partial_blogdescription',
		) );
	}

	// Theme Options Panel.
	$wp_customize->add_panel( 'theme_option_panel',
		array(
			'title'      => esc_html__( 'Theme Options', 'revista' ),
			'priority'   => 150,
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_panel( 'theme_general_settings',
		array(
			'title'      => esc_html__( 'General Settings', 'revista' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_panel( 'theme_colors_panel',
		array(
			'title'      => esc_html__( 'Color Settings', 'revista' ),
			'priority'   => 15,
			'capability' => 'edit_theme_options',
		)
	);

	// Template Options
	$wp_customize->add_panel( 'theme_template_pannel',
		array(
			'title'      => esc_html__( 'Template Settings', 'revista' ),
			'priority'   => 150,
			'capability' => 'edit_theme_options',
		)
	);

	// Register custom section types.
	$wp_customize->register_section_type( 'Revista_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Revista_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Revista Pro', 'revista' ),
				'pro_text' => esc_html__( 'Upgrade To Pro', 'revista' ),
				'pro_url'  => esc_url('https://www.themeinwp.com/theme/revista-pro/'),
				'priority'  => 1,
			)
		)
	);

}

endif;
add_action( 'customize_register', 'revista_customize_register' );

/**
 * Customizer Enqueue scripts and styles.
 */

if (!function_exists('revista_customizer_scripts')) :

    function revista_customizer_scripts(){   
    	
    	wp_enqueue_script('jquery-ui-button');
    	wp_enqueue_style('revista-customizer', get_template_directory_uri() . '/assets/lib/custom/css/customizer.css');
        wp_enqueue_script('revista-customizer', get_template_directory_uri() . '/assets/lib/custom/js/customizer.js', array('jquery','customize-controls'), '', 1);

        $ajax_nonce = wp_create_nonce('revista_customizer_ajax_nonce');
        wp_localize_script( 
		    'revista-customizer', 
		    'revista_customizer',
		    array(
		        'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
		        'ajax_nonce' => $ajax_nonce,
		     )
		);
    }

endif;

add_action('customize_controls_enqueue_scripts', 'revista_customizer_scripts');
add_action('customize_controls_init', 'revista_customizer_scripts');

/**
 * Customizer Enqueue scripts and styles.
 */
function revista_customizer_repearer(){   
	
	wp_enqueue_style('revista-repeater', get_template_directory_uri() . '/assets/lib/custom/css/repeater.css');
    wp_enqueue_script('revista-repeater', get_template_directory_uri() . '/assets/lib/custom/js/repeater.js', array('jquery','customize-controls'), '', 1);

    $revista_post_category_list = revista_post_category_list();

    $cat_option = '';

    if( $revista_post_category_list ){
	    foreach( $revista_post_category_list as $key => $cats ){
	    	$cat_option .= "<option value='". esc_attr( $key )."'>". esc_html( $cats )."</option>";
	    }
	}

    wp_localize_script( 
        'revista-repeater', 
        'revista_repeater',
        array(
            'optionns'   => "
            				<option value='main-banner'>". esc_html__('Main Banner Slider','revista')."</option>
            				<option value='banner-blocks-1'>". esc_html__('Slider & Tab Block','revista')."</option>
            				<option value='latest-posts-blocks'>". esc_html__('Latest Posts Block','revista')."</option>
            				<option selected='selected' value='tiles-blocks'>". esc_html__('Tiles Block','revista')."</option>
        					<option value='advertise-blocks'>". esc_html__('Advertise Block','revista')."</option>
            				<option value='home-widget-area'>". esc_html__('Widgets Area Block','revista')."</option
        					<option value='you-may-like-blocks'>". esc_html__('You May Like Block','revista')."</option>",
           	'categories'   => $cat_option,
            'new_section'   =>  esc_html__('New Section','revista'),
            'upload_image'   =>  esc_html__('Choose Image','revista'),
            'use_image'   =>  esc_html__('Select','revista'),
         )
    );

    wp_localize_script( 
        'revista-customizer', 
        'revista_customizer',
        array(
            'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
         )
    );
}

add_action('customize_controls_enqueue_scripts', 'revista_customizer_repearer');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */

if (!function_exists('revista_customize_partial_blogname')) :

	function revista_customize_partial_blogname() {
		bloginfo( 'name' );
	}
endif;

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */

if (!function_exists('revista_customize_partial_blogdescription')) :

	function revista_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}

endif;

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function revista_customize_preview_js() {
	wp_enqueue_script( 'revista-customizer-preview', get_template_directory_uri() . '/assets/lib/custom/js/customizer-preview.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'revista_customize_preview_js' );