<?php

/**
 * Advertise
 *
 * @package Revista
 */
if (!function_exists('revista_main_banner')) :
    function revista_main_banner($revista_home_section, $repeat_times)
    {
        $section_post_slide_cat = esc_html(isset($revista_home_section->section_post_slide_cat) ? $revista_home_section->section_post_slide_cat : '');
        $section_post_grid_post_cat = esc_html(isset($revista_home_section->section_post_grid_post_cat) ? $revista_home_section->section_post_grid_post_cat : '');
        $section_post_cat_1 = esc_html(isset($revista_home_section->section_post_cat_1) ? $revista_home_section->section_post_cat_1 : '');
        $section_vertical_list_category = esc_html(isset($revista_home_section->section_vertical_list_category) ? $revista_home_section->section_vertical_list_category : '');

        $slider_arrows = esc_html(isset($revista_home_section->ed_arrows_carousel) ? $revista_home_section->ed_arrows_carousel : '');
        $slider_dots = esc_html(isset($revista_home_section->ed_dots_carousel) ? $revista_home_section->ed_dots_carousel : '');
        $slider_autoplay = esc_html(isset($revista_home_section->ed_autoplay_carousel) ? $revista_home_section->ed_autoplay_carousel : '');
        $home_section_title_4 = isset($revista_home_section->home_section_title_4) ? $revista_home_section->home_section_title_4 : '';
        $home_section_title_1 = isset($revista_home_section->home_section_title_1) ? $revista_home_section->home_section_title_1 : '';
        $home_section_title_3 = isset($revista_home_section->home_section_title_3) ? $revista_home_section->home_section_title_3 : '';

        if ($slider_arrows == 'yes' || $slider_arrows == '') {
            $arrow = 'true';
        } else {
            $arrow = 'false';
        }
        if ($slider_autoplay == 'yes' || $slider_autoplay == '') {
            $autoplay = 'true';
        } else {
            $autoplay = 'false';
        }
        if ($slider_dots == 'yes') {
            $dots = 'true';
        } else {
            $dots = 'false';
        }
        if (is_rtl()) {
            $rtl = 'true';
        } else {
            $rtl = 'false';
        }
        $banner_query_1 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 5, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_post_cat_1)));
        $banner_query_2 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 4, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_post_slide_cat)));

        $banner_query_4 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 6, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_post_grid_post_cat)));

        $banner_query_3 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 8, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_vertical_list_category))); ?>
        <div id="theme-block-<?php echo esc_attr($repeat_times); ?>" class="theme-block theme-main-banner">
            <div class="wrapper">
                <div class="wrapper-inner">
                    <div class="column column-6 column-lg-12 column-sm-12 mb-md-20 column-order-2 border-md-highlight">
                        <?php if ($banner_query_2->have_posts()) : ?>
                            <div class="block-sub-area block-upper-area">
                                <?php if ($home_section_title_1) { ?>
                                    <header class="block-title-wrapper">
                                        <?php if ($home_section_title_1) { ?>
                                            <h2 class="block-title">
                                                <span><?php echo esc_html($home_section_title_1); ?></span>
                                            </h2>
                                        <?php } ?>
                                        <?php if ($arrow == 'true') { ?>
                                            <div class="theme-heading-controls">
                                                <button type="button" class="slide-btn slide-btn-small slide-prev-lead">
                                                    <span class="screen-reader-text"><?php esc_html_e('Previous Slide', 'revista'); ?></span>
                                                    <?php revista_theme_svg('chevron-left'); ?>
                                                </button>
                                                <button type="button" class="slide-btn slide-btn-small slide-next-lead">
                                                    <span class="screen-reader-text"><?php esc_html_e('Next Slide', 'revista'); ?></span>
                                                    <?php revista_theme_svg('chevron-right'); ?>
                                                </button>
                                            </div>
                                        <?php } ?>
                                    </header>
                                <?php } ?>
                                <div class="theme-slider-wrapper">
                                    <div class="theme-main-slider-block" data-slick='{"arrows": <?php echo esc_attr($arrow); ?>,"autoplay": <?php echo esc_attr($autoplay); ?>, "dots": <?php echo esc_attr($dots); ?>, "rtl": <?php echo esc_attr($rtl); ?>}'>
                                        <?php
                                        
                                        while ($banner_query_2->have_posts()) {
                                            $banner_query_2->the_post();
                                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                            $featured_image = isset($featured_image[0]) ? $featured_image[0] : '';
                                            $no_image_class = '';
                                            if (!has_post_thumbnail()) {
                                                $no_image_class = 'twp-banner-no-image';
                                             } ?>
                                            <div class="theme-slider-item">
                                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>

                                                    <div class="data-bg data-bg-big thumb-overlay img-hover-slide <?php echo esc_attr($no_image_class); ?>" data-background="<?php echo esc_url($featured_image); ?>">
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
                                                        <div class="entry-meta">
                                                            <?php revista_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                        </div>
                                                        <h2 class="entry-title entry-title-big line-clamp-2">
                                                            <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                        </h2>

                                                        <div class="entry-footer">
                                                            <div class="entry-meta">
                                                                <?php revista_posted_by(); ?>
                                                                <?php revista_post_view_count(); ?>
                                                            </div>
                                                        </div>

                                                        <div class="entry-content hidden-xs-element entry-content-muted">
                                                            <?php
                                                            if (has_excerpt()) {
                                                                the_excerpt();
                                                            } else {
                                                                echo '<p>';
                                                                echo esc_html(wp_trim_words(get_the_content(), 25, '...'));
                                                                echo '</p>';
                                                            } ?>
                                                        </div>

                                                    </div>
                                                </article>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php wp_reset_postdata();
                        endif; ?>
                        <?php if ($banner_query_4->have_posts()) : ?>
                            <div class="block-sub-area block-middle-area">
                                <div class="wrapper-inner">
                                    <?php
                                    while ($banner_query_4->have_posts()) {
                                        $banner_query_4->the_post();
                                        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                        $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                        <div class="column column-6 column-xxs-12">
                                            <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>
                                                <?php if (has_post_thumbnail()) { ?>
                                                    <a href="<?php the_permalink(); ?>">
                                                        <div class="data-bg data-bg-medium" data-background="<?php echo esc_url($featured_image); ?>"></div>
                                                    </a>
                                                <?php } ?>
                                                <div class="article-content">

                                                    <h3 class="entry-title entry-title-xsmall">
                                                        <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                    </h3>
                                                    <div class="entry-meta">
                                                        <?php revista_posted_on($icon = true); ?>
                                                        <?php revista_post_view_count(); ?>
                                                    </div>

                                                    <div class="entry-content">
                                                        <?php
                                                        if (has_excerpt()) {
                                                            the_excerpt();
                                                        } else {
                                                            echo '<p>';
                                                            echo esc_html(wp_trim_words(get_the_content(), 40, '...'));
                                                            echo '</p>';
                                                        } ?>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    <?php
                                    } ?>
                                </div>
                            </div>
                        <?php wp_reset_postdata();
                        endif; ?>
                    </div>

                    <?php if ($banner_query_3->have_posts()) : ?>
                        <div class="column column-3 column-lg-6 column-sm-6 column-xs-12 mb-md-20 column-order-3">
                            <?php if ($home_section_title_3) { ?>
                                <header class="block-title-wrapper">
                                    <?php if ($home_section_title_3) { ?>
                                        <h2 class="block-title">
                                            <span><?php echo esc_html($home_section_title_3); ?></span>
                                        </h2>
                                    <?php } ?>
                                </header>
                            <?php } ?>
                            <div class="main-banner-right theme-make-sticky">
                                <?php
                                $count = 1;
                                while ($banner_query_3->have_posts()) {
                                    $banner_query_3->the_post();
                                    ?>

                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article theme-article-spacing'); ?>>

                                        <div class="article-content theme-article-content">
                                            <?php if ($count == 1 && has_post_thumbnail()) { ?>
                                                <?php
                                                $alt_text = get_the_title();
                                                the_post_thumbnail('medium_large', array(
                                                    'alt' => $alt_text,
                                                ));
                                                ?>
                                            <?php } ?>

                                            <h3 class="entry-title entry-title-xsmall">
                                                <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                            <div class="entry-meta">
                                                <?php revista_posted_on($icon = true); ?>
                                            </div>
                                        </div>

                                    </article>

                                <?php $count++;
                                } ?>
                            </div>
                        </div>
                    <?php
                        wp_reset_postdata();
                    endif;

                    if ($banner_query_1->have_posts()) : ?>
                        <div class="column column-3 column-lg-6 column-sm-6 column-xs-12 column-order-1">
                            <?php if ($home_section_title_4) { ?>
                                <header class="block-title-wrapper">
                                    <?php if ($home_section_title_4) { ?>
                                        <h2 class="block-title">
                                            <span><?php echo esc_html($home_section_title_4); ?></span>
                                        </h2>
                                    <?php } ?>
                                </header>
                            <?php } ?>
                            <div class="main-banner-left theme-make-sticky">
                                <?php
                                while ($banner_query_1->have_posts()) {
                                    $banner_query_1->the_post();
                                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
                                    $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>

                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article theme-article-grid theme-article-spacing'); ?>>
                                        <?php if (has_post_thumbnail()) { ?>
                                            <div class="data-bg data-bg-thumbnail thumb-overlay img-hover-slide" data-background="<?php echo esc_url($featured_image); ?>">
                                                <?php
                                                $format = get_post_format(get_the_ID()) ?: 'standard';
                                                $icon = revista_post_format_icon($format);
                                                if (!empty($icon)) { ?>
                                                    <span class="top-right-icon"><?php echo revista_svg_escape($icon); ?></span>
                                                <?php } ?>
                                                <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                            </div>
                                        <?php } ?>
                                        <div class="article-content theme-article-content">
                                            <h3 class="entry-title entry-title-xsmall line-clamp-3">
                                                <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                            <div class="entry-meta">
                                                <?php revista_posted_by(); ?>
                                                <?php revista_post_view_count(); ?>
                                            </div>
                                        </div>
                                    </article>

                                <?php
                                } ?>
                            </div>
                        </div>
                    <?php
                        wp_reset_postdata();
                    endif;

                    ?>
                </div>
            </div>
        </div>
<?php }
endif; ?>