<?php
/**
* Body Classes.
*
* @package Revista
*/
 
 if (!function_exists('revista_body_classes')) :

    function revista_body_classes($classes) {

        $revista_default = revista_get_default_theme_options();
        global $post;

        // Adds a class of hfeed to non-singular pages.
        if ( !is_singular() ) {
            $classes[] = 'hfeed';
        }

        // Adds a class of no-sidebar when there is no sidebar present.
        if ( !is_active_sidebar( 'sidebar-1' ) ) {
            $classes[] = 'no-sidebar';
        }
        
        if ( is_active_sidebar( 'sidebar-1' ) ) {

            $global_sidebar_layout = esc_html( get_theme_mod( 'global_sidebar_layout',$revista_default['global_sidebar_layout'] ) );

            if( is_single() || is_page() ){

                $revista_post_sidebar = esc_html( get_post_meta( $post->ID, 'revista_post_sidebar_option', true ) );

                if( $revista_post_sidebar == 'global-sidebar' || empty( $revista_post_sidebar ) ){

                    if( class_exists('WooCommerce') && ( is_cart() || is_checkout() ) ){
                        
                        $classes[] = 'no-sidebar';

                    }else{

                        $classes[] = esc_attr( $global_sidebar_layout );

                    }

                }else{

                    if( class_exists('WooCommerce') && ( is_cart() || is_checkout() ) ){
                        
                        $classes[] = 'no-sidebar';

                    }else{

                        $classes[] = esc_attr( $revista_post_sidebar );

                    }
                }
                
            }elseif( is_404() ){

                $classes[] = 'no-sidebar';

            }else{
                
                $classes[] = esc_attr( $global_sidebar_layout );
            }

        }

        if( is_page() ){

            $revista_header_trending_page = get_theme_mod( 'revista_header_trending_page' );
            $revista_header_popular_page = get_theme_mod( 'revista_header_popular_page' );

            if( $revista_header_trending_page == $post->ID || $revista_header_popular_page == $post->ID ){

                $revista_archive_layout = get_theme_mod( 'revista_archive_layout',$revista_default['revista_archive_layout'] );
                $ed_image_content_inverse = get_theme_mod( 'ed_image_content_inverse',$revista_default['ed_image_content_inverse'] );
                if( $revista_archive_layout == 'default' && $ed_image_content_inverse ){

                    $classes[] = 'twp-archive-alternative';

                }

                $classes[] = 'twp-archive-'.esc_attr( $revista_archive_layout );
                
            }

        }

        if( is_singular('post') ){

            $revista_post_layout = esc_html( get_post_meta( $post->ID, 'revista_post_layout', true ) );

            if( $revista_post_layout == '' || $revista_post_layout == 'global-layout' ){
                
                $revista_post_layout = get_theme_mod( 'revista_single_post_layout',$revista_default['revista_archive_layout'] );

            }

            $classes[] = 'twp-single-'.esc_attr( $revista_post_layout );

            if( $revista_post_layout == 'layout-2' ){
                
                $revista_header_overlay = esc_html( get_post_meta( $post->ID, 'revista_header_overlay', true ) );

                if( $revista_header_overlay == '' || $revista_header_overlay == 'global-layout' ){

                    $revista_post_layout2 = get_theme_mod( 'revista_single_post_layout',$revista_default['revista_archive_layout'] );

                    if( $revista_post_layout2 == 'layout-2' ){

                        $ed_header_overlay = esc_html( get_post_meta( $post->ID, 'ed_header_overlay', true ) );
                        if( $ed_header_overlay == '' || $ed_header_overlay == 'global-layout' ){
                            
                            $ed_header_overlay = get_theme_mod( 'ed_header_overlay',$revista_default['ed_header_overlay'] );
                        }

                    }else{

                        $ed_header_overlay = false;

                    }

                }else{

                    $ed_header_overlay = true;

                }
                if( $ed_header_overlay ){

                    $classes[] = 'twp-single-header-overlay';

                }

            }

        }

        if( is_singular('page') ){

            $revista_page_layout = get_post_meta( $post->ID, 'revista_page_layout', true );

            if( $revista_page_layout == ''  ){
                
                $revista_page_layout = 'layout-1';

            }

            $classes[] = 'theme-single-'.esc_attr( $revista_page_layout );

            if( $revista_page_layout == 'layout-2' ){
                
                $revista_ed_header_overlay = get_post_meta( $post->ID, 'revista_ed_header_overlay', true );
                if( $revista_ed_header_overlay ){
                    $classes[] = 'theme-single-header-overlay';
                }

            }

        }

        if( is_archive() || is_home() || is_search() ){

            $revista_archive_layout = get_theme_mod( 'revista_archive_layout',$revista_default['revista_archive_layout'] );
            $ed_image_content_inverse = get_theme_mod( 'ed_image_content_inverse',$revista_default['ed_image_content_inverse'] );
            if( $revista_archive_layout == 'default' && $ed_image_content_inverse ){

                $classes[] = 'twp-archive-alternative';

            }

            $classes[] = 'twp-archive-'.esc_attr( $revista_archive_layout );
            
        }

        if( is_singular('post') ){

            $revista_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'revista_ed_post_reaction', true ) );
            if( $revista_ed_post_reaction ){
                $classes[] = 'hide-comment-rating';
            }

        }

        return $classes;
    }

endif;

add_filter('body_class', 'revista_body_classes');