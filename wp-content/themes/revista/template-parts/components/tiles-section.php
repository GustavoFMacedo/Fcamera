<?php

/**
 * Tiles Blocks
 *
 * @package Revista
 */
if (!function_exists('revista_tiles_block_section')) :
    function revista_tiles_block_section($revista_home_section, $repeat_times)
    {

        $section_category = esc_html(isset($revista_home_section->section_category) ? $revista_home_section->section_category : '');
        $tiles_post_per_page = 11;
        $home_section_title = isset($revista_home_section->home_section_title) ? $revista_home_section->home_section_title : '';

        $tiles_post_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => $tiles_post_per_page, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_category)));
        if ($tiles_post_query->have_posts()) :

            if (empty($home_section_title) && $section_category) {

                $catObj = get_category_by_slug($section_category);
                if (isset($catObj->name) && $catObj->name) {
                    $home_section_title = $catObj->name;
                }
            } ?>
            <div id="theme-block-<?php echo esc_attr($repeat_times); ?>" class="theme-block theme-block-tiles">
                <div class="wrapper">
                    <div class="wrapper-inner">
                        <?php if ($home_section_title || $section_category) { ?>

                            <div class="column column-12 column-sm-12">
                                <header class="block-title-wrapper">

                                    <?php if ($home_section_title) { ?>

                                        <h2 class="block-title">
                                            <span><?php echo esc_html($home_section_title); ?></span>
                                        </h2>

                                    <?php } ?>

                                    <?php if ($section_category) {

                                        $catObj = get_category_by_slug($section_category);
                                        if (isset($catObj->name) && $catObj->name) {
                                            $cat_title = $catObj->name;
                                        }
                                        $cat_link = get_category_link($catObj->term_id); ?>

                                        <div class="theme-heading-controls">
                                            <a href="<?php echo esc_url($cat_link); ?>" class="view-all-link">
                                                <span class="view-all-icon"><?php revista_theme_svg('plus'); ?></span>
                                                <span class="view-all-label"><?php esc_html_e('View All', 'revista'); ?></span>
                                            </a>
                                        </div>

                                    <?php } ?>

                                </header>

                            </div>

                        <?php } ?>
                        <?php
                        $count = 1;
                        while ($tiles_post_query->have_posts()) {
                            $tiles_post_query->the_post();
                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                            $featured_image = isset($featured_image[0]) ? $featured_image[0] : '';
                            $featured_image_small = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
                            $featured_image_small = isset($featured_image_small[0]) ? $featured_image_small[0] : ''; ?>
                            <?php if ($count == 1) {
                                $count++; ?>

                                <div class="column column-4 column-lg-12 column-sm-12">

                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article mb-24'); ?>>
                                        <div class="data-bg data-bg-large thumb-overlay img-hover-slide" data-background="<?php echo esc_url($featured_image); ?>">

                                            <?php
                                            $format = get_post_format(get_the_ID()) ?: 'standard';
                                            $icon = revista_post_format_icon($format);
                                            if (!empty($icon)) { ?>
                                                <span class="top-right-icon">
                                                    <?php echo revista_svg_escape($icon); ?>
                                                </span>
                                            <?php } ?>

                                            <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>

                                        </div>

                                        <div class="article-content theme-article-content article-content-overlay">

                                            <h3 class="entry-title entry-title-big line-clamp-3">
                                                <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                            </h3>

                                            <div class="entry-meta">
                                                <?php revista_posted_by(); ?>
                                                <?php revista_post_view_count(); ?>
                                            </div>

                                            <div class="entry-content hidden-xs-element entry-content-muted">
                                                <?php
                                                if (has_excerpt()) {
                                                    the_excerpt();
                                                } else {
                                                    echo '<p>';
                                                    echo esc_html(wp_trim_words(get_the_content(), 10, '...'));
                                                    echo '</p>';
                                                } ?>
                                            </div>
                                        </div>
                                    </article>

                                </div>
                                <div class="column column-8 column-lg-12 column-sm-12">

                                    <div class="wrapper-inner">

                                    <?php } else { ?>
                                        <div class="column column-6 column-xxs-12">

                                            <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article theme-article-grid article-grid-big mb-24'); ?>>
                                                <div class="data-bg data-bg-xsmall thumb-overlay img-hover-slide" data-background="<?php echo esc_url($featured_image_small); ?>">

                                                    <?php
                                                    $format = get_post_format(get_the_ID()) ?: 'standard';
                                                    $icon = revista_post_format_icon($format);
                                                    if (!empty($icon)) { ?>
                                                        <span class="top-right-icon">
                                                            <?php echo revista_svg_escape($icon); ?>
                                                        </span>
                                                    <?php } ?>
                                                    <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                                </div>

                                                <div class="article-content theme-article-content">
                                                    <h3 class="entry-title entry-title-xsmall line-clamp-2">
                                                        <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                    </h3>
                                                    <div class="entry-meta">
                                                        <?php revista_posted_by(); ?>
                                                        <?php revista_post_view_count(); ?>
                                                    </div>
                                                </div>
                                            </article>

                                        </div>
                                    <?php } ?>

                                    <?php if ($tiles_post_query->current_post + 1 == $tiles_post_query->post_count) {
                                        echo '</div>';
                                        echo '</div>';
                                    } ?>

                                <?php } ?>

                                    </div>
                                </div>
                    </div>
        <?php
            wp_reset_postdata();
        endif;
    }
endif;
