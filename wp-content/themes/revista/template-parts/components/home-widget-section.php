<?php

/**
 * Homepage Main Widget Area
 *
 * @package Revista
 */

if (!function_exists('revista_case_home_widget_area_block')) :

    function revista_case_home_widget_area_block($revista_home_section, $repeat_times)
    {


?>
        <?php if (is_active_sidebar('front-page-3-column-col-1') || is_active_sidebar('front-page-3-column-col-2') || is_active_sidebar('front-page-3-column-col-3')) { ?>
            <div id="theme-block-<?php echo esc_attr($repeat_times); ?>" class="theme-block-widgetarea">
                <?php if (is_active_sidebar('front-page-3-column-col-1') || is_active_sidebar('front-page-3-column-col-2') || is_active_sidebar('front-page-3-column-col-3') || is_active_sidebar('front-page-2-column-col-1') || is_active_sidebar('front-page-2-column-col-2')) { ?>
                    <div class="theme-widget-area upper-widget-area">
                        <div class="wrapper">
                            <div class="wrapper-inner">

                                <?php
                                if (is_active_sidebar('front-page-3-column-col-1')) { ?>

                                    <div class="column column-5 column-sm-12">

                                        <?php dynamic_sidebar('front-page-3-column-col-1'); ?>

                                    </div>

                                <?php } ?>
                                <?php
                                if (is_active_sidebar('front-page-3-column-col-2')) { ?>

                                    <div class="column column-3 column-sm-12">

                                        <?php dynamic_sidebar('front-page-3-column-col-2'); ?>

                                    </div>

                                <?php } ?>
                                <?php
                                if (is_active_sidebar('front-page-3-column-col-3')) { ?>

                                    <div class="column column-4 column-sm-12">

                                        <?php dynamic_sidebar('front-page-3-column-col-3'); ?>

                                    </div>

                                <?php } ?>

                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if (is_active_sidebar('front-page-2-column-col-1') || is_active_sidebar('front-page-2-column-col-2')) { ?>
                    <div class="theme-widget-area lower-widget-area">
                        <div class="wrapper">
                            <div class="wrapper-inner">
                                <?php if (is_active_sidebar('front-page-2-column-col-1')) { ?>

                                    <div class="column column-6 column-sm-12">

                                        <?php dynamic_sidebar('front-page-2-column-col-1'); ?>

                                    </div>

                                <?php } ?>
                                <?php
                                if (is_active_sidebar('front-page-2-column-col-2')) { ?>

                                    <div class="column column-6 column-sm-12">

                                        <?php dynamic_sidebar('front-page-2-column-col-2'); ?>

                                    </div>

                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

<?php
    }

endif;
