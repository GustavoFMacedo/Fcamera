<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...
 *
 * @package Revista
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses revista_header_style()
 */
function revista_custom_header_setup()
{
    add_theme_support('custom-header',
        apply_filters('revista_custom_header_args', array(
            'default-image' => '',
            'default-text-color' => '000000',
            'width' => 1920,
            'height' => 400,
            'flex-height' => true,
            'flex-width' => true,
            'wp-head-callback' => 'revista_header_style',
        )));
}

add_action('after_setup_theme', 'revista_custom_header_setup');

if (!function_exists('revista_header_style')) :
    /**
     * Styles the header image and text displayed on the blog
     *
     * @see revista_custom_header_setup().
     */
    function revista_header_style()
    {
        $header_text_color = get_header_textcolor();

        // If no custom options for text are set, let's bail
        // get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value.
        if (get_theme_support('custom-header', 'default-text-color') === $header_text_color) {
            return;
        }

        // If we get this far, we have custom styles. Let's do this.
        ?>
        <style type="text/css">
            <?php
                // Has the text been hidden?
                if ( 'blank' == $header_text_color ) :
            ?>
            .header-titles .custom-logo-name,
            .site-description {
                display: none;
                position: absolute;
                clip: rect(1px, 1px, 1px, 1px);
            }

            <?php
                // If the user has set a custom color for the text use that.
                else :
            ?>
            .header-titles .custom-logo-name,
            .site-description,
            .header-latest-entry,
            .header-latest-entry a:not(:hover):not(:focus) {
                color: #<?php echo esc_attr( $header_text_color ); ?>;
            }

            <?php endif; ?>
        </style>
        <?php
    }
endif; // revista_header_style