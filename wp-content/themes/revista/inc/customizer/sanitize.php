<?php
/**
* Custom Functions.
*
* @package Revista
*/


if( !function_exists( 'revista_sanitize_sidebar_option' ) ) :

    // Sidebar Option Sanitize.
    function revista_sanitize_sidebar_option( $revista_input ){

        $revista_metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $revista_input,$revista_metabox_options ) ){

            return $revista_input;

        }

        return;

    }

endif;

if( !function_exists( 'revista_sanitize_single_pagination_layout' ) ) :

    // Sidebar Option Sanitize.
    function revista_sanitize_single_pagination_layout( $revista_input ){

        $revista_single_pagination = array( 'no-navigation','norma-navigation','ajax-next-post-load' );
        if( in_array( $revista_input,$revista_single_pagination ) ){

            return $revista_input;

        }

        return;

    }

endif;

if( !function_exists( 'revista_sanitize_archive_layout' ) ) :

    // Sidebar Option Sanitize.
    function revista_sanitize_archive_layout( $revista_input ){

        $revista_archive_option = array( 'default','full','grid' );
        if( in_array( $revista_input,$revista_archive_option ) ){

            return $revista_input;

        }

        return;

    }

endif;

if( !function_exists( 'revista_sanitize_single_post_layout' ) ) :

    // Single Layout Option Sanitize.
    function revista_sanitize_single_post_layout( $revista_input ){

        $revista_single_layout = array( 'layout-1','layout-2' );
        if( in_array( $revista_input,$revista_single_layout ) ){

            return $revista_input;

        }

        return;

    }

endif;

if ( ! function_exists( 'revista_sanitize_checkbox' ) ) :

	/**
	 * Sanitize checkbox.
	 */
	function revista_sanitize_checkbox( $revista_checked ) {

		return ( ( isset( $revista_checked ) && true === $revista_checked ) ? true : false );

	}

endif;


if ( ! function_exists( 'revista_sanitize_select' ) ) :

    /**
     * Sanitize select.
     */
    function revista_sanitize_select( $revista_input, $revista_setting ) {

        // Ensure input is a slug.
        $revista_input = sanitize_text_field( $revista_input );

        // Get list of choices from the control associated with the setting.
        $choices = $revista_setting->manager->get_control( $revista_setting->id )->choices;

        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $revista_input, $choices ) ? $revista_input : $revista_setting->default );

    }

endif;

if ( ! function_exists( 'revista_sanitize_repeater' ) ) :
    
    /**
    * Sanitise Repeater Field
    */
    function revista_sanitize_repeater($input){
        $input_decoded = json_decode( $input, true );
        
        if(!empty($input_decoded)) {

            foreach ($input_decoded as $boxes => $box ){

                foreach ($box as $key => $value){

                    if( $key == 'section_ed' 
                        || $key == 'ed_tab' 
                        || $key == 'ed_arrows_carousel' 
                        || $key == 'ed_dots_carousel' 
                        || $key == 'ed_autoplay_carousel' 
                        || $key == 'ed_flip_column' 
                        || $key == 'ed_ribbon_bg'
                    ){

                        $input_decoded[$boxes][$key] = revista_sanitize_repeater_ed( $value );

                    }elseif( $key == 'home_section_type' ){

                        $input_decoded[$boxes][$key] = revista_sanitize_home_sections( $value );

                    }elseif( $key == 'ribbon_bg_color_schema' ){

                        $input_decoded[$boxes][$key] = revista_sanitize_ribbon_bg( $value );

                    }elseif( $key == 'category_color' ){

                        $input_decoded[$boxes][$key] = sanitize_hex_color( $value );

                    }elseif( $key == 'tiles_post_per_page' ){

                        $input_decoded[$boxes][$key] =  absint( $value );

                    }elseif( $key == 'advertise_image' || $key == 'advertise_link' ){

                         $input_decoded[$boxes][$key] = esc_url_raw( $value );

                    }elseif($key == 'section_category' || 
                            $key == 'section_post_slide_cat' || 
                            $key == 'section_post_cat_1' || 
                            $key == 'section_category_1' || 
                            $key == 'section_category_2' || 
                            $key == 'section_category_3' || 
                            $key == 'section_category_4' || 
                            $key == 'category'
                        ){

                        $input_decoded[$boxes][$key] =  revista_sanitize_category( $value );

                    }else{

                        $input_decoded[$boxes][$key] = sanitize_text_field( $value );

                    }
                    
                }

            }
           
            return json_encode($input_decoded);

        }

        return $input;
    }
endif;

/** Sanitize Enable Disable Checkbox **/
function revista_sanitize_repeater_ed( $input ) {

    $valid_keys = array('yes','no');
    if ( in_array( $input , $valid_keys ) ) {
        return $input;
    }
    return '';

}

function revista_sanitize_home_sections( $input ) {

    $home_sections = array(

        'main-banner' => esc_html__('Main Banner Slider','revista'),
        'banner-blocks-1' => esc_html__('Slider & Tab Block','revista'),
        'latest-posts-blocks' => esc_html__('Latest Posts Block','revista'),
        'slider-blocks' => esc_html__('Slider Block','revista'),
        'tiles-blocks' => esc_html__('Tiles Block','revista'),
        'advertise-blocks' => esc_html__('Advertise Block','revista'),
        'home-widget-area' => esc_html__('Widgets Area Block','revista'),
        'you-may-like-blocks' => esc_html__('You May Like Block','revista'),

    );
    if ( array_key_exists( $input , $home_sections ) ) {
        return $input;
    }
    return '';

}

/** Sanitize Category **/
function revista_sanitize_category( $input ) {

   $revista_post_category_list = revista_post_category_list();
    if ( array_key_exists( $input , $revista_post_category_list ) ) {
        return $input;
    }
    return '';

}

function revista_sanitize_ribbon_bg( $input ) {

    $ribbon_bg = array( 
                    '1' =>  array(
                                    'title' =>  esc_html__( 'Blue', 'revista' ),
                                    'color' =>  '#3061ff',
                                ),
                    '2' =>  array(
                                    'title' =>  esc_html__( 'Orange', 'revista' ),
                                    'color' =>  '#fa9000',
                                ),
                    '3' =>  array(
                                    'title' =>  esc_html__( 'Royal Blue', 'revista' ),
                                    'color' =>  '#00167a',
                                ),
                    '4' =>  array(
                                    'title' =>  esc_html__( 'Pink', 'revista' ),
                                    'color' =>  '#ff2d55',
                                ),
                );

    if ( array_key_exists( $input , $ribbon_bg ) ) {
        return $input;
    }
    return '';

}