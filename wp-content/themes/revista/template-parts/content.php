<?php

/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Revista
 * @since 1.0.0
 */

$revista_default = revista_get_default_theme_options();
$revista_archive_layout = esc_attr(get_theme_mod('revista_archive_layout', $revista_default['revista_archive_layout']));
$global_sidebar_layout = esc_attr(get_theme_mod('global_sidebar_layout', $revista_default['global_sidebar_layout']));
$ed_post_read_later = get_theme_mod('ed_post_read_later', $revista_default['ed_post_read_later']);
$title_size = 'large';

if ($revista_archive_layout == 'default') {

    $image_size = 'medium';
    $title_size = 'big';
} elseif ($revista_archive_layout == 'grid') {

    $image_size = 'medium_large';
    $title_size = 'medium';
} else {

    if ($global_sidebar_layout == 'no-sidebar') {
        $image_size = 'full';
    } else {
        $image_size = 'large';
    }
} ?>

<div class="theme-article-area">
    <article id="post-<?php the_ID(); ?>" <?php post_class('news-article'); ?>>

        <?php
        $revista_default = revista_get_default_theme_options();
        $revista_archive_layout = get_theme_mod('revista_archive_layout', $revista_default['revista_archive_layout']);

        $bg_size = 'data-bg-xmedium';
        if ($revista_archive_layout == 'full') {
            $bg_size = 'data-bg-big';
        }

        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
        $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>

        <div class="post-thumbnail data-bg <?php echo esc_attr($bg_size); ?>" data-background="<?php echo esc_url($featured_image); ?>">

            <?php
            $format = get_post_format(get_the_ID()) ?: 'standard';
            $icon = revista_post_format_icon($format);

            if (!empty($icon)) { ?>
                <span class="top-right-icon"><?php echo revista_svg_escape($icon); ?></span>
            <?php } ?>

        </div>

        <div class="post-content">

            <header class="entry-header">

                <h2 class="entry-title entry-title-<?php echo $title_size; ?> line-clamp-2">

                    <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    <?php if (class_exists('Booster_Extension_Class') && $ed_post_read_later) : echo do_shortcode('[be-pp]');
                    endif; ?>
                </h2>

            </header>



            <div class="entry-content line-clamp-3">
                <?php
                if (has_excerpt()) {
                    the_excerpt();
                } else {
                    echo '<p>';
                    echo esc_html(wp_trim_words(get_the_content(), 25, '...'));
                    echo '</p>';
                } ?>

            </div>

            <?php if (!is_search()) { ?>


                <div class="entry-footer">
                    <?php revista_post_permalink(); ?>
                </div>

            <?php } ?>

        </div>

    </article>
</div>