<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Revista
 * @since 1.0.0
 */
get_header();

$revista_default = revista_get_default_theme_options();
$sidebar = esc_attr(get_theme_mod('global_sidebar_layout', $revista_default['global_sidebar_layout']));
$revista_archive_layout = esc_attr(get_theme_mod('revista_archive_layout', $revista_default['revista_archive_layout'])); ?>

<div class="theme-block theme-block-archive">

    <header class="page-header theme-page-header theme-search-header">
        <div class="wrapper">
            <?php revista_breadcrumb_with_title_block(); ?>
        </div>
    </header>
    <div class="wrapper">
        <div class="wrapper-inner">

            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">

                    <?php
                    if (have_posts()) : ?>

                        <div class="article-wraper archive-layout <?php echo 'archive-layout-' . esc_attr($revista_archive_layout); ?>">

                            <?php while (have_posts()) :
                                the_post();

                                get_template_part('template-parts/content', '');

                            endwhile; ?>

                        </div>

                    <?php the_posts_pagination();

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
get_footer();
