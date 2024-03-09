<?php

/**
 * Revista About Page
 * @package Revista
 *
 */

if (!class_exists('Revista_About_page')):

    class Revista_About_page
    {

        function __construct()
        {

            add_action('admin_menu', array($this, 'revista_backend_menu'), 999);

        }

        // Add Backend Menu
        function revista_backend_menu()
        {

            add_theme_page(esc_html__('Revista', 'revista'), esc_html__('Revista', 'revista'), 'activate_plugins', 'revista-about', array($this, 'revista_main_page'), 1);

        }

        // Settings Form
        function revista_main_page()
        {

            require get_template_directory() . '/classes/about-render.php';

        }

    }

    new Revista_About_page();

endif;