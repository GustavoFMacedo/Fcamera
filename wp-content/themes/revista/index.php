<?php
/**
 *
 * Front Page
 *
 * @package Revista
 */

get_header();


    $revista_default = revista_get_default_theme_options();
    $revista_default = revista_get_default_theme_options();
    $sidebar = esc_attr( get_theme_mod( 'global_sidebar_layout', $revista_default['global_sidebar_layout'] ) );
    

    if( is_single() || is_page() ){

        $revista_post_sidebar = esc_attr( get_post_meta( $post->ID, 'revista_post_sidebar_option', true ) );
        if( $revista_post_sidebar == 'global-sidebar' || empty( $revista_post_sidebar ) ){

            $sidebar = $sidebar;
        }else{
            $sidebar = $revista_post_sidebar;
        }

    }
    $twp_revista_home_sections_4 = get_theme_mod( 'twp_revista_home_sections_4', json_encode( $revista_default['twp_revista_home_sections_4'] ) );
    $repeat_times = 1;
    $paged_active = false;

    if ( !is_paged() ) {
        $paged_active = true;
    }

    $twp_revista_home_sections_4 = json_decode( $twp_revista_home_sections_4 );

    if( $twp_revista_home_sections_4 ){ ?>

        <?php
        foreach ( $twp_revista_home_sections_4 as $revista_home_section ) {

            $home_section_type = isset( $revista_home_section->home_section_type ) ? $revista_home_section->home_section_type : '';

            switch ($home_section_type) {

                case 'main-banner':

                    $ed_slider_blocks = isset( $revista_home_section->section_ed ) ? $revista_home_section->section_ed : '';
                    if ( $ed_slider_blocks == 'yes' && $paged_active ) {
                        revista_main_banner( $revista_home_section , $repeat_times);
                    }

                break;

                case 'latest-posts-blocks':

                    $ed_latest_posts_blocks = isset( $revista_home_section->section_ed ) ? $revista_home_section->section_ed : '';
                    if ( $ed_latest_posts_blocks == 'yes' ) {
                        revista_latest_blocks( $revista_home_section  , $repeat_times);
                    }

                break;

                case 'tiles-blocks':

                    $ed_tiles_block = isset( $revista_home_section->section_ed ) ? $revista_home_section->section_ed : '';
                    if ( $ed_tiles_block == 'yes' && $paged_active ) {
                        revista_tiles_block_section( $revista_home_section , $repeat_times);
                    }

                break;

                case 'banner-blocks-1':

                    $ed_banner_blocks_1 = isset( $revista_home_section->section_ed ) ? $revista_home_section->section_ed : '';
                    if ( $ed_banner_blocks_1 == 'yes' && $paged_active ) {
                        revista_banner_block_1_section( $revista_home_section , $repeat_times);
                    }

                break;

                case 'advertise-blocks':

                    $ed_advertise_blocks = isset( $revista_home_section->section_ed ) ? $revista_home_section->section_ed : '';
                    if ( $ed_advertise_blocks == 'yes' && $paged_active ) {
                        revista_advertise_block( $revista_home_section , $repeat_times);
                    }
                    
                break;

                case 'home-widget-area':

                    $ed_home_widget_area = isset( $revista_home_section->section_ed ) ? $revista_home_section->section_ed : '';
                    if ( $ed_home_widget_area == 'yes' && $paged_active ) {
                        revista_case_home_widget_area_block( $revista_home_section , $repeat_times);
                    }
                    
                break;

                case 'you-may-like-blocks':

                    $ed_you_may_like_area = isset( $revista_home_section->section_ed ) ? $revista_home_section->section_ed : '';
                    if ( $ed_you_may_like_area == 'yes' && $paged_active ) {
                        revista_you_may_like_block_section( $revista_home_section , $repeat_times);
                    }
                    
                break;

                default:

                break;

            }

        $repeat_times++;
        } 
        ?>

    <?php
    }

get_footer();
