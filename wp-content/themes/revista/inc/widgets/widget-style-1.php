<?php

/**
 * Article Widget Layout 1
 *
 * @package Revista
 */
if (!function_exists('revista_widgets_style_1')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function revista_widgets_style_1()
    {
        register_widget('Revista_widget_Style_1');
    }
endif;
add_action('widgets_init', 'revista_widgets_style_1');
// Article Widget Layout 1
if (!class_exists('Revista_widget_Style_1')) :
    /**
     * Article Widget Layout 1
     *
     * @since 1.0.0
     */
    class Revista_widget_Style_1 extends Revista_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'revista_widget_style_1',
                'description' => esc_html__('Displays post form selected category in different styles', 'revista'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => esc_html__('Section Title:', 'revista'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => esc_html__('Select Category:', 'revista'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => esc_html__('All Categories', 'revista'),
                ),
                'post_number' => array(
                    'label' => esc_html__('Number of Posts:', 'revista'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 9,
                ),
                'display_orientation' => array(
                    'label' => esc_html__('Display Orientation:', 'revista'),
                    'type' => 'select',
                    'default' => 'vertical',
                    'options' => array(
                        'vertical' => esc_html__('Vertical', 'revista'),
                        'horizontal' => esc_html__('Horizontal', 'revista'),
                    ),
                ),
                'enable_meta' => array(
                    'label' => esc_html__('Enable Categories:', 'revista'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'enable_meta_1' => array(
                    'label' => esc_html__('Enable Date & Author:', 'revista'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'hide_feature_image' => array(
                    'label' => esc_html__('Featured Image:', 'revista'),
                    'default' => 'style-1',
                    'type' => 'radio',
                    'css' => 'display:block;',
                    'options' => array(
                        'style-1' => esc_html__('Show Featured Image', 'revista'),
                        'style-2' => esc_html__('Hide Featured Image', 'revista'),
                        'style-3' => esc_html__('Hide Sub Post Featured Post', 'revista'),
                    ),
                ),
                'post_description' => array(
                    'label' => esc_html__('Description:', 'revista'),
                    'default' => 'post-3',
                    'type' => 'radio',
                    'css' => 'display:block;',
                    'options' => array(
                        'post-1' => esc_html__('Show Description', 'revista'),
                        'post-2' => esc_html__('Hide Description', 'revista'),
                        'post-3' => esc_html__('Hide Sub Post Description', 'revista'),
                    ),
                ),
            );
            parent::__construct('revista-widget-style-1', esc_html__('Revista: Post Widget 1', 'revista'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         * @since 1.0.0
         *
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            echo $args['before_widget'];
            if (!empty($params['title'])) {
                echo $args['before_title'] . esc_html($params['title']) . $args['after_title'];
            }

            $display_orientation = esc_attr($params['display_orientation']);
            if ($display_orientation == 'vertical') {
                $div_class = 'post-vertical';
                $article_class_list = 'news-article-default';
            } elseif ($display_orientation == 'horizontal') {
                $div_class = 'post-horizontal';
                $article_class_list = 'news-article-inlined';
            }
            $post_number = isset($params['post_number']) ? $params['post_number'] : '';
            $qargs = array(
                'post_type' => 'post',
                'posts_per_page' => absint($post_number),
                'post__not_in' => get_option("sticky_posts"),
            );
            if (absint($params['post_category']) > 0) {
                $qargs['cat'] = absint($params['post_category']);
            }
            $style_1_posts_query = new WP_Query($qargs);
            if ($style_1_posts_query->have_posts()) : ?>
                <div class="wrapper-inner <?php echo $div_class; ?>">
                    <?php
                    $count = 1;
                    while ($style_1_posts_query->have_posts()) :
                        $style_1_posts_query->the_post(); ?>
                        <?php if ($count == 1) { ?>
                            <div class="column column-12 column-sm-6 column-xs-12 column-upper">
                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article widget-news-article news-article-jacketed ' . $article_class_list); ?>>

                                    <?php if (has_post_thumbnail()) { ?>
                                        <?php $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                        $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                        <?php
                                        $hide_feature_image = $params['hide_feature_image'];
                                        switch ($hide_feature_image) {
                                            case "style-1": ?>
                                                <div class="data-bg data-bg-widget thumb-overlay img-hover-slide" data-background="<?php echo esc_url($featured_image); ?>">
                                                    <?php
                                                    $format = get_post_format(get_the_ID()) ?: 'standard';
                                                    $icon = revista_post_format_icon($format);
                                                    if (!empty($icon)) { ?>
                                                        <span class="top-right-icon"><?php echo revista_svg_escape($icon); ?></span>
                                                    <?php } ?>
                                                    <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                                </div>
                                            <?php break;
                                            case "style-2":
                                                break;
                                            case "style-3": ?>
                                                <div class="data-bg data-bg-widget thumb-overlay img-hover-slide" data-background="<?php echo esc_url($featured_image); ?>">
                                                    <?php
                                                    $format = get_post_format(get_the_ID()) ?: 'standard';
                                                    $icon = revista_post_format_icon($format);
                                                    if (!empty($icon)) { ?>
                                                        <span class="top-right-icon"><?php echo revista_svg_escape($icon); ?></span>
                                                    <?php } ?>
                                                    <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                                </div>
                                        <?php break;
                                            default:
                                                break;
                                        }
                                        ?>
                                    <?php } ?>

                                    <div class="article-content widget-article-content">
                                        <h3 class="entry-title entry-title-medium line-clamp-2">
                                            <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                        <?php if (($params['enable_meta_1']) == 1) { ?>
                                            <div class="entry-meta">
                                                <?php revista_posted_by(); ?>
                                            </div>
                                        <?php } ?>
                                        <?php
                                        $post_description = $params['post_description'];
                                        switch ($post_description) {
                                            case "post-1": ?>
                                                <div class="entry-content hidden-xs-element line-clamp-2">
                                                    <?php
                                                    if (has_excerpt()) {
                                                        the_excerpt();
                                                    } else {
                                                        echo '<p>';
                                                        echo esc_html(wp_trim_words(get_the_content(), 20, '...'));
                                                        echo '</p>';
                                                    } ?>
                                                </div>
                                            <?php break;
                                            case "post-2":
                                                break;
                                            case "post-3": ?>
                                                <div class="entry-content hidden-xs-element line-clamp-2">
                                                    <?php
                                                    if (has_excerpt()) {
                                                        the_excerpt();
                                                    } else {
                                                        echo '<p>';
                                                        echo esc_html(wp_trim_words(get_the_content(), 20, '...'));
                                                        echo '</p>';
                                                    } ?>
                                                </div>
                                        <?php break;
                                            default:
                                                break;
                                        } ?>
                                    </div>
                                </article>
                            </div>
                            <?php $count++; ?>
                            <div class="column column-12 column-sm-6 column-xs-12 column-lower">
                            <?php } else { ?>
                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article widget-news-article news-article-nonjacketed ' . $article_class_list); ?>>

                                    <?php if (has_post_thumbnail() && $params['hide_feature_image'] == 'style-1') { ?>
                                        <?php $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                        $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                        <div class="data-bg data-bg-widget thumb-overlay img-hover-slide" data-background="<?php echo esc_url($featured_image); ?>">
                                            <?php
                                            $format = get_post_format(get_the_ID()) ?: 'standard';
                                            $icon = revista_post_format_icon($format);
                                            if (!empty($icon)) { ?>
                                                <span class="top-right-icon"><?php echo revista_svg_escape($icon); ?></span>
                                            <?php } ?>
                                            <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                        </div>
                                    <?php } ?>

                                    <div class="article-content widget-article-content">

                                        <h3 class="entry-title entry-title-small line-clamp-2">
                                            <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>

                                        <?php if (($params['enable_meta_1']) == 1) { ?>
                                            <div class="entry-meta">
                                                <?php revista_posted_by(); ?>
                                            </div>
                                        <?php } ?>

                                        <?php if (($params['post_description']) == 'post-1') { ?>
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
                                        <?php } ?>

                                    </div>

                                </article>
                        <?php }
                        $count++;
                        if ($style_1_posts_query->current_post + 1 == $style_1_posts_query->post_count) {
                            echo '</div>';
                        }
                    endwhile; ?>
                            </div>
            <?php wp_reset_postdata();
            endif;
            echo $args['after_widget'];
        }
    }
endif;
