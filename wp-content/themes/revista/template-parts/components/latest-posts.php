<?php

/**
 * Latest Posts
 *
 * @package Revista
 */
if (!function_exists('revista_latest_blocks')) :

    function revista_latest_blocks($revista_home_section, $repeat_times)
    {

        global $post;
        $revista_default = revista_get_default_theme_options();
        $sidebar = esc_attr(get_theme_mod('global_sidebar_layout', $revista_default['global_sidebar_layout']));

        $revista_archive_layout = esc_attr(get_theme_mod('revista_archive_layout', $revista_default['revista_archive_layout'])); ?>
        <div id="theme-block-<?php echo esc_attr($repeat_times); ?>" class="theme-block theme-block-archive">
            <div class="wrapper">
                <div class="wrapper-inner">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main" role="main">

                            <?php
                            if (!is_front_page()) {
                                revista_breadcrumb_with_title_block();
                            }

                            if (have_posts()) : ?>

                                <div class="article-wraper archive-layout <?php echo 'archive-layout-' . esc_attr($revista_archive_layout); ?>">
                                    <?php while (have_posts()) :
                                        the_post();

                                        if (!is_page()) {

                                            get_template_part('template-parts/content', get_post_format());
                                        } else {
                                            get_template_part('template-parts/content', 'single');
                                        }


                                    endwhile; ?>
                                </div>

                            <?php if (!is_page()) : do_action('revista_archive_pagination');
                                endif;

                            else :

                                get_template_part('template-parts/content', 'none');

                            endif; ?>

                        </main><!-- #main -->
                    </div>

                    <?php if ($sidebar != 'no-sidebar') {

                        get_sidebar();
                    } ?>
                </div>
            </div>
        </div>

<?php
    }

endif;
