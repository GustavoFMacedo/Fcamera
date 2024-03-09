<?php
/**
 * Header Layout 2
 *
 * @package Revista
 */
$revista_default = revista_get_default_theme_options();
$ed_header_new_entry_posts = get_theme_mod( 'ed_header_new_entry_posts', $revista_default['ed_header_new_entry_posts'] );
$revista_header_bg_size = get_theme_mod( 'revista_header_bg_size', $revista_default['revista_header_bg_size'] );
$ed_header_bg_fixed = get_theme_mod( 'ed_header_bg_fixed', $revista_default['ed_header_bg_fixed'] );
$ed_header_bg_overlay = get_theme_mod( 'ed_header_bg_overlay', $revista_default['ed_header_bg_overlay'] ); ?>

<header id="site-header" class="theme-header <?php if( $ed_header_bg_overlay ){ echo 'header-overlay-enabled'; } ?>" role="banner">

    <div class="header-mainbar <?php if( get_header_image() ){ if( $ed_header_bg_fixed ){ echo 'data-bg-fixed'; } ?> data-bg header-bg-<?php echo esc_attr( $revista_header_bg_size ); ?> <?php } ?> "  <?php if( get_header_image() ){ ?> data-background="<?php echo esc_url(get_header_image()); ?>" <?php } ?>>
        <div class="wrapper header-wrapper">
            <div class="header-item header-item-left">
                <div class="header-titles">
                    <?php
                    revista_site_logo();
                    revista_site_description();
                    ?>
                </div>
            </div>
            <?php  if ($ed_header_new_entry_posts) { ?>
                <div class="header-item header-item-right hidden-sm-element ">
                    <div class="header-latest-entry">
                        <?php revista_content_new_entry_news_render(); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php revista_date_ticker_bar(); ?>
    
    <div class="header-navbar">
        <div class="wrapper header-wrapper">
            <div class="header-item header-item-left">

                <div class="header-navigation-wrapper">
                    <div class="site-navigation">
                        <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'revista'); ?>" role="navigation">
                            <ul class="primary-menu theme-menu">
                                <?php
                                if( has_nav_menu('revista-primary-menu') ){

                                    wp_nav_menu(
                                        array(
                                            'container' => '',
                                            'items_wrap' => '%3$s',
                                            'theme_location' => 'revista-primary-menu',
                                            'walker' => new revista\Revista_Walkernav(),
                                        )
                                    );

                                }else{

                                    wp_list_pages(
                                        array(
                                            'match_menu_classes' => true,
                                            'show_sub_menu_icons' => true,
                                            'title_li' => false,
                                            'walker' => new Revista_Walker_Page(),
                                        )
                                    );

                                } ?>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>

            <div class="header-item header-item-right">
                <?php revista_main_navigation_extras(); ?>
            </div>
        </div>
        <?php revista_content_trending_news_render(); ?>
    </div>

</header>
