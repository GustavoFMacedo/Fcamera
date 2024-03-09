<?php
/**
 * Widget FUnctions.
 *
 * @package Revista
 */
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function revista_widgets_init(){

    $revista_default = revista_get_default_theme_options();

    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'revista'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'revista'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));

    $twp_revista_home_sections_4 = get_theme_mod('twp_revista_home_sections_4', json_encode($revista_default['twp_revista_home_sections_4']));
    $twp_revista_home_sections_4 = json_decode($twp_revista_home_sections_4);

    foreach( $twp_revista_home_sections_4 as $revista_home_section ){

        $home_section_type = isset( $revista_home_section->home_section_type ) ? $revista_home_section->home_section_type : '';

        switch( $home_section_type ){

            case 'home-widget-area':

                $ed_home_widget_area = isset( $revista_home_section->section_ed ) ? $revista_home_section->section_ed : '';

                if( $ed_home_widget_area == 'yes' ){

                    register_sidebar(array(
                        'name' => esc_html__('Front Page 3 Column - Col 1', 'revista'),
                        'id' => 'front-page-3-column-col-1',
                        'description' => esc_html__('Add widgets here.', 'revista'),
                        'before_widget' => '<div id="%1$s" class="widget %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<h2 class="widget-title"><span>',
                        'after_title' => '</span></h2>',
                    ));

                    register_sidebar(array(
                        'name' => esc_html__('Front Page 3 Column - Col 2', 'revista'),
                        'id' => 'front-page-3-column-col-2',
                        'description' => esc_html__('Add widgets here.', 'revista'),
                        'before_widget' => '<div id="%1$s" class="widget %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<h2 class="widget-title"><span>',
                        'after_title' => '</span></h2>',
                    ));

                    register_sidebar(array(
                        'name' => esc_html__('Front Page 3 Column - Col 3', 'revista'),
                        'id' => 'front-page-3-column-col-3',
                        'description' => esc_html__('Add widgets here.', 'revista'),
                        'before_widget' => '<div id="%1$s" class="widget %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<h2 class="widget-title"><span>',
                        'after_title' => '</span></h2>',
                    ));


                    register_sidebar(array(
                        'name' => esc_html__('Front Page 2 Column - Col 1', 'revista'),
                        'id' => 'front-page-2-column-col-1',
                        'description' => esc_html__('Add widgets here.', 'revista'),
                        'before_widget' => '<div id="%1$s" class="widget %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<h2 class="widget-title"><span>',
                        'after_title' => '</span></h2>',
                    ));

                    register_sidebar(array(
                        'name' => esc_html__('Front Page 2 Column - Col 2', 'revista'),
                        'id' => 'front-page-2-column-col-2',
                        'description' => esc_html__('Add widgets here.', 'revista'),
                        'before_widget' => '<div id="%1$s" class="widget %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<h2 class="widget-title"><span>',
                        'after_title' => '</span></h2>',
                    ));

                }

                break;

            default:

                break;

        }

    }

    $revista_default = revista_get_default_theme_options();
    $footer_column_layout = absint(get_theme_mod('footer_column_layout', $revista_default['footer_column_layout']));

    for( $i = 0; $i < $footer_column_layout; $i++ ){

        if ($i == 0) {
            $count = esc_html__('One', 'revista');
        }
        if ($i == 1) {
            $count = esc_html__('Two', 'revista');
        }
        if ($i == 2) {
            $count = esc_html__('Three', 'revista');
        }
        if ($i == 3) {
            $count = esc_html__('Four', 'revista');
        }

        register_sidebar(array(
            'name' => esc_html__('Footer Widget ', 'revista') . $count,
            'id' => 'revista-footer-widget-' . $i,
            'description' => esc_html__('Add widgets here.', 'revista'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
        ));

    }

}

add_action('widgets_init', 'revista_widgets_init');
require get_template_directory() . '/inc/widgets/widget-base.php';
require get_template_directory() . '/inc/widgets/author.php';
require get_template_directory() . '/inc/widgets/widget-style-1.php';
require get_template_directory() . '/inc/widgets/widget-style-2.php';
require get_template_directory() . '/inc/widgets/social-link.php';
require get_template_directory() . '/inc/widgets/featured-category-widget.php';