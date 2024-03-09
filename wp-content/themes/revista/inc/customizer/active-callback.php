<?php
/**
 * Revista Customizer Active Callback Functions
 *
 * @package Revista
 */

function revista_header_archive_layout_ac( $control ){

    $revista_archive_layout = $control->manager->get_setting( 'revista_archive_layout' )->value();
    if( $revista_archive_layout == 'default' ){

        return true;
        
    }
    
    return false;
}

function revista_overlay_layout_ac( $control ){

    $revista_single_post_layout = $control->manager->get_setting( 'revista_single_post_layout' )->value();
    if( $revista_single_post_layout == 'layout-2' ){

        return true;
        
    }
    
    return false;
}

function revista_header_ad_ac( $control ){

    $ed_header_ad = $control->manager->get_setting( 'ed_header_ad' )->value();
    if( $ed_header_ad ){

        return true;
        
    }
    
    return false;
}