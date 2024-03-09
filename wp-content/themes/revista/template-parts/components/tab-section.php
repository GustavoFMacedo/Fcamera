<?php
/**
 * Banner Blocks One
 *
 * @package Revista
 */
if (!function_exists('revista_banner_block_1_section')) :
    function revista_banner_block_1_section($revista_home_section, $repeat_times)
    {
        $section_post_slide_cat = esc_html(isset($revista_home_section->section_post_slide_cat) ? $revista_home_section->section_post_slide_cat : '');
        $section_category_1 = esc_html(isset($revista_home_section->section_category_1) ? $revista_home_section->section_category_1 : '');
        $section_category_2 = esc_html(isset($revista_home_section->section_category_2) ? $revista_home_section->section_category_2 : '');
        $section_category_3 = esc_html(isset($revista_home_section->section_category_3) ? $revista_home_section->section_category_3 : '');
        $section_category_4 = esc_html(isset($revista_home_section->section_category_4) ? $revista_home_section->section_category_4 : '');
        $ed_tab = esc_html(isset($revista_home_section->ed_tab) ? $revista_home_section->ed_tab : '');
        $ed_flip_column = esc_html(isset($revista_home_section->ed_flip_column) ? $revista_home_section->ed_flip_column : '');
        $home_section_title_1 = esc_html(isset($revista_home_section->home_section_title_1) ? $revista_home_section->home_section_title_1 : '');
        $home_section_title_2 = esc_html(isset($revista_home_section->home_section_title_2) ? $revista_home_section->home_section_title_2 : '');
        $banner_post_slide_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 5, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_post_slide_cat)));
        $slider_arrows = esc_html(isset($revista_home_section->ed_arrows_carousel) ? $revista_home_section->ed_arrows_carousel : '');
        $slider_dots = esc_html(isset($revista_home_section->ed_dots_carousel) ? $revista_home_section->ed_dots_carousel : '');
        $slider_autoplay = esc_html(isset($revista_home_section->ed_autoplay_carousel) ? $revista_home_section->ed_autoplay_carousel : '');
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
        if ($ed_tab == 'yes' && ($section_category_1 || $section_category_2 || $section_category_3 || $section_category_4)) {
            $cat_array = array();
            if ($section_category_1) {
                $cat_array[] = $section_category_1;
            }
            if ($section_category_2) {
                $cat_array[] = $section_category_2;
            }
            if ($section_category_3) {
                $cat_array[] = $section_category_3;
            }
            if ($section_category_4) {
                $cat_array[] = $section_category_4;
            }
            $banner_query_all = new WP_Query(
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 7,
                    'post__not_in' => get_option("sticky_posts"),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'slug',
                            'terms' => $cat_array,
                        ),
                    ),
                )
            );
        } else {
            $banner_query_all = new WP_Query(
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 7,
                    'post__not_in' => get_option("sticky_posts"),
                    'category_name' => esc_html($section_category_1)
                )
            );
        }
        ?>
        <div id="theme-block-<?php echo esc_attr($repeat_times); ?>" class="theme-block theme-block-navtabs <?php
        if (empty($home_section_title_1)) {
            echo ' no-title-slide';
        }
        if (empty($home_section_title_2)) {
            echo ' no-title-tab';
        } ?>">
            <div class="wrapper">
                <div class="wrapper-inner">
                    <?php if ($banner_post_slide_query->have_posts()) : ?>
                        <div class="column column-6 column-lg-12 column-sm-12 column-xs-12 mb-md-20 <?php if ($ed_flip_column != 'yes') { ?>column-order-1<?php } else { ?>column-order-2<?php } ?>">
                            <?php if ($home_section_title_1) { ?>
                                <header class="block-title-wrapper">
                                    <h2 class="block-title">
                                        <span><?php echo esc_html($home_section_title_1); ?></span>
                                    </h2>
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
                            <div class="theme-slider-block"
                                 data-slick='{"arrows": <?php echo esc_attr($arrow); ?>,"autoplay": <?php echo esc_attr($autoplay); ?>, "dots": <?php echo esc_attr($dots); ?>, "rtl": <?php echo esc_attr($rtl); ?>}'>
                                <?php
                                while ($banner_post_slide_query->have_posts()) {
                                    $banner_post_slide_query->the_post();
                                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                    $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                    <div class="theme-slider-item">
                                        <article
                                                id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>
                                            <div class="data-bg data-bg-big thumb-overlay img-hover-slide"
                                                 data-background="<?php echo esc_url($featured_image); ?>">
                                                <?php
                                                $format = get_post_format(get_the_ID()) ?: 'standard';
                                                $icon = revista_post_format_icon($format);
                                                if (!empty($icon)) { ?>
                                                    <span class="top-right-icon">
                                                        <?php echo revista_svg_escape($icon); ?>
                                                    </span>
                                                <?php } ?>
                                                <a class="img-link" href="<?php the_permalink(); ?>"
                                                   aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                            </div>
                                            <div class="article-content theme-article-content article-content-overlay">
                                                <h2 class="entry-title entry-title-big line-clamp-3">
                                                    <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark"
                                                       title="<?php the_title_attribute(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h2>
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
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                        wp_reset_postdata();
                    endif; ?>
                    <div class="column column-6 column-lg-12 column-sm-12 column-xs-12 <?php if ($ed_flip_column != 'yes') { ?>column-order-2<?php } else { ?>column-order-1<?php } ?>">
                        <?php if ($home_section_title_2 || ($ed_tab == 'yes' && ($section_category_1 || $section_category_2 || $section_category_3 || $section_category_4))) { ?>
                            <header class="block-title-wrapper">
                                <?php if ($home_section_title_2) { ?>
                                    <h2 class="block-title">
                                        <span><?php echo esc_html($home_section_title_2); ?></span>
                                    </h2>
                                <?php }
                                if ($ed_tab == 'yes' && ($section_category_1 || $section_category_2 || $section_category_3 || $section_category_4)) { ?>
                                    <div class="theme-dropdown clear">
                                        <button class="tab-posts-toggle" type="button">
                                            <span class="tab-selected-category"><?php esc_html_e('All', 'revista'); ?></span>
                                            <span class="tab-selected-icon"><?php revista_theme_svg('chevron-down'); ?></span>
                                        </button>
                                        <ul class="tab-posts hide-no-js">
                                            <li><a cat-data="all" class="active-tab"
                                                   href="javascript:void(0)"><?php esc_html_e('All', 'revista'); ?></a>
                                            </li>
                                            <?php
                                            if ($section_category_1 && $ed_tab == 'yes') {
                                                $catObj = get_category_by_slug($section_category_1);
                                                if (isset($catObj->name) && $catObj->name) { ?>
                                                    <li><a cat-data="<?php echo esc_attr($section_category_1); ?>"
                                                           href="javascript:void(0)">
                                                            <?php echo esc_html($catObj->name); ?>
                                                        </a></li>
                                                <?php }
                                            }
                                            if ($section_category_2 && $ed_tab == 'yes') {
                                                $catObj = get_category_by_slug($section_category_2);
                                                if (isset($catObj->name) && $catObj->name) { ?>
                                                    <li><a cat-data="<?php echo esc_attr($section_category_2); ?>"
                                                           href="javascript:void(0)">
                                                            <?php echo esc_html($catObj->name); ?>
                                                        </a></li>
                                                <?php }
                                            }
                                            if ($section_category_3 && $ed_tab == 'yes') {
                                                $catObj = get_category_by_slug($section_category_3);
                                                if (isset($catObj->name) && $catObj->name) { ?>
                                                    <li><a cat-data="<?php echo esc_attr($section_category_3); ?>"
                                                           href="javascript:void(0)">
                                                            <?php echo esc_html($catObj->name); ?>
                                                        </a></li>
                                                <?php }
                                            }
                                            if ($section_category_4 && $ed_tab == 'yes') {
                                                $catObj = get_category_by_slug($section_category_4);
                                                if (isset($catObj->name) && $catObj->name) { ?>
                                                    <li><a cat-data="<?php echo esc_attr($section_category_4); ?>"
                                                           href="javascript:void(0)">
                                                            <?php echo esc_html($catObj->name); ?>
                                                        </a></li>
                                                <?php }
                                            } ?>
                                        </ul>
                                    </div>
                                <?php } ?>
                            </header>
                        <?php }
                        if ($banner_query_all->have_posts()) : ?>
                            <div class="tab-contents tab-content-all content-loaded content-active">
                                <div class="wrapper-inner">
                                    <div class="column column-6 column-xs-12">
                                        <?php
                                        $post_count = 1;
                                        while ($banner_query_all->have_posts()) {
                                            $banner_query_all->the_post();
                                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
                                            $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                            <article
                                                    id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article theme-article-grid theme-article-spacing'); ?>>
                                                <div class="data-bg data-bg-thumbnail thumb-overlay img-hover-slide"
                                                     data-background="<?php echo esc_url($featured_image); ?>">
                                                    <?php
                                                    $format = get_post_format(get_the_ID()) ?: 'standard';
                                                    $icon = revista_post_format_icon($format);
                                                    if (!empty($icon)) { ?>
                                                        <span class="top-right-icon">
                                                            <?php echo revista_svg_escape($icon); ?>
                                                        </span>
                                                    <?php } ?>
                                                    <a class="img-link" href="<?php the_permalink(); ?>"
                                                       aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                                </div>
                                                <div class="article-content theme-article-content">
                                                    <h3 class="entry-title entry-title-xsmall line-clamp-2">
                                                        <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark"
                                                           title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                    </h3>
                                                    <div class="entry-meta">
                                                        <?php revista_posted_by(); ?>
                                                        <?php revista_post_view_count(); ?>
                                                    </div>
                                                </div>
                                            </article>
                                            <?php
                                            if ($post_count == 4) {
                                                break;
                                            }
                                            $post_count++;
                                        } ?>
                                    </div>
                                    <div class="column column-6 column-xs-12 theme-tab-right">
                                        <?php
                                        while ($banner_query_all->have_posts()) {
                                            $banner_query_all->the_post();
                                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
                                            $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                            <article
                                                    id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article theme-article-spacing'); ?>>
                                                <?php if ($featured_image) { ?>
                                                    <div class="data-bg thumb-overlay img-hover-slide data-bg-small mb-16"
                                                         data-background="<?php echo esc_url($featured_image); ?>">
                                                        <?php
                                                        $format = get_post_format(get_the_ID()) ?: 'standard';
                                                        $icon = revista_post_format_icon($format);
                                                        if (!empty($icon)) { ?>
                                                            <span class="top-right-icon">
                                                                <?php echo revista_svg_escape($icon); ?>
                                                            </span>
                                                        <?php } ?>
                                                        <a class="img-link" href="<?php the_permalink(); ?>"
                                                           aria-label="<?php the_title_attribute(); ?>"
                                                           tabindex="0"></a>
                                                    </div>
                                                <?php } ?>
                                                <div class="article-content">
                                                    <h3 class="entry-title entry-title-xsmall line-clamp-2">
                                                        <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark"
                                                           title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                    </h3>
                                                    <div class="entry-meta">
                                                        <?php revista_posted_on($icon = true); ?>
                                                        <?php revista_post_view_count(); ?>
                                                    </div>
                                                </div>
                                            </article>
                                            <?php
                                        } ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            wp_reset_postdata();
                        endif; ?>
                        <?php if ($ed_tab == 'yes' && $section_category_1) { ?>
                            <div data-cat="<?php echo esc_attr($section_category_1); ?>"
                                 class="tab-contents tab-content-<?php echo esc_attr($section_category_1); ?>">
                                <?php revista_content_loading(); ?>
                            </div>
                        <?php } ?>
                        <?php if ($ed_tab == 'yes' && $section_category_2) { ?>
                            <div data-cat="<?php echo esc_attr($section_category_2); ?>"
                                 class="tab-contents tab-content-<?php echo esc_attr($section_category_2); ?>">
                                <?php revista_content_loading(); ?>
                            </div>
                        <?php } ?>
                        <?php if ($ed_tab == 'yes' && $section_category_3) { ?>
                            <div data-cat="<?php echo esc_attr($section_category_3); ?>"
                                 class="tab-contents tab-content-<?php echo esc_attr($section_category_3); ?>">
                                <?php revista_content_loading(); ?>
                            </div>
                        <?php } ?>
                        <?php if ($ed_tab == 'yes' && $section_category_4) { ?>
                            <div data-cat="<?php echo esc_attr($section_category_4); ?>"
                                 class="tab-contents tab-content-<?php echo esc_attr($section_category_4); ?>">
                                <?php revista_content_loading(); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
endif;
