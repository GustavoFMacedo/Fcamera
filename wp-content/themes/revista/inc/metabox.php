<?php
/**
* Sidebar Metabox.
*
* @package Revista
*/
 
add_action( 'add_meta_boxes', 'revista_metabox' );

if( ! function_exists( 'revista_metabox' ) ):


    function  revista_metabox() {
        
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'revista' ),
            'revista_post_metafield_callback',
            'post', 
            'normal', 
            'high'
        );
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'revista' ),
            'revista_post_metafield_callback',
            'page',
            'normal', 
            'high'
        ); 
    }

endif;

$revista_page_layout_options = array(
    'layout-1' => esc_html__( 'Simple Layout', 'revista' ),
    'layout-2' => esc_html__( 'Banner Layout', 'revista' ),
);

$revista_post_sidebar_fields = array(
    'global-sidebar' => array(
                    'id'        => 'post-global-sidebar',
                    'value' => 'global-sidebar',
                    'label' => esc_html__( 'Global sidebar', 'revista' ),
                ),
    'right-sidebar' => array(
                    'id'        => 'post-left-sidebar',
                    'value' => 'right-sidebar',
                    'label' => esc_html__( 'Right sidebar', 'revista' ),
                ),
    'left-sidebar' => array(
                    'id'        => 'post-right-sidebar',
                    'value'     => 'left-sidebar',
                    'label'     => esc_html__( 'Left sidebar', 'revista' ),
                ),
    'no-sidebar' => array(
                    'id'        => 'post-no-sidebar',
                    'value'     => 'no-sidebar',
                    'label'     => esc_html__( 'No sidebar', 'revista' ),
                ),
);

$revista_post_layout_options = array(
    'global-layout' => esc_html__( 'Global Layout', 'revista' ),
    'layout-1' => esc_html__( 'Simple Layout', 'revista' ),
    'layout-2' => esc_html__( 'Banner Layout', 'revista' ),
);

$revista_header_overlay_options = array(
    'global-layout' => esc_html__( 'Global Layout', 'revista' ),
    'enable-overlay' => esc_html__( 'Enable Header Overlay', 'revista' ),
);


/**
 * Callback function for post option.
*/
if( ! function_exists( 'revista_post_metafield_callback' ) ):
    
    function revista_post_metafield_callback() {
        global $post, $revista_post_sidebar_fields, $revista_post_layout_options,  $revista_page_layout_options, $revista_header_overlay_options;
        $post_type = get_post_type($post->ID);
        wp_nonce_field( basename( __FILE__ ), 'revista_post_meta_nonce' ); ?>
        
        <div class="metabox-main-block">

            <div class="metabox-navbar">
                <ul>

                    <li>
                        <a id="metabox-navbar-general" class="metabox-navbar-active" href="javascript:void(0)">

                            <?php esc_html_e('General Settings', 'revista'); ?>

                        </a>
                    </li>

                    <li>
                        <a id="metabox-navbar-appearance" href="javascript:void(0)">

                            <?php esc_html_e('Appearance Settings', 'revista'); ?>

                        </a>
                    </li>

                    <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ): ?>
                        <li>
                            <a id="twp-tab-booster" href="javascript:void(0)">

                                <?php esc_html_e('Booster Extension Settings', 'revista'); ?>

                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>

            <div class="twp-tab-content">

                <div id="metabox-navbar-general-content" class="metabox-content-wrap metabox-content-wrap-active">

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Sidebar Layout','revista'); ?></h3>

                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <?php
                            $revista_post_sidebar = esc_html( get_post_meta( $post->ID, 'revista_post_sidebar_option', true ) ); 
                            if( $revista_post_sidebar == '' ){ $revista_post_sidebar = 'global-sidebar'; }

                            foreach ( $revista_post_sidebar_fields as $revista_post_sidebar_field) { ?>

                                <label class="description">

                                    <input type="radio" name="revista_post_sidebar_option" value="<?php echo esc_attr( $revista_post_sidebar_field['value'] ); ?>" <?php if( $revista_post_sidebar_field['value'] == $revista_post_sidebar ){ echo "checked='checked'";} if( empty( $revista_post_sidebar ) && $revista_post_sidebar_field['value']=='right-sidebar' ){ echo "checked='checked'"; } ?>/>&nbsp;<?php echo esc_html( $revista_post_sidebar_field['label'] ); ?>

                                </label>

                            <?php } ?>

                        </div>

                    </div>

                </div>


                <div id="metabox-navbar-appearance-content" class="metabox-content-wrap">

                    <?php if( $post_type == 'page' ): ?>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Appearance Layout','revista'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $revista_page_layout = esc_html( get_post_meta( $post->ID, 'revista_page_layout', true ) ); 
                                if( $revista_page_layout == '' ){ $revista_page_layout = 'layout-1'; }

                                foreach ( $revista_page_layout_options as $key => $revista_page_layout_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="revista_page_layout" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $revista_page_layout ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $revista_page_layout_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Overlay','revista'); ?></h3>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                <?php
                                $revista_ed_header_overlay = esc_attr( get_post_meta( $post->ID, 'revista_ed_header_overlay', true ) ); ?>

                                <input type="checkbox" id="revista-header-overlay" name="revista_ed_header_overlay" value="1" <?php if( $revista_ed_header_overlay ){ echo "checked='checked'";} ?>/>

                                <label for="revista-header-overlay"><?php esc_html_e( 'Enable Header Overlay','revista' ); ?></label>

                            </div>

                        </div>

                    <?php endif; ?>

                    <?php if( $post_type == 'post' ): ?>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Appearance Layout','revista'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $revista_post_layout = esc_html( get_post_meta( $post->ID, 'revista_post_layout', true ) ); 
                                if( $revista_post_layout == '' ){ $revista_post_layout = 'global-layout'; }

                                foreach ( $revista_post_layout_options as $key => $revista_post_layout_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="revista_post_layout" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $revista_post_layout ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $revista_post_layout_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Overlay','revista'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $revista_header_overlay = esc_html( get_post_meta( $post->ID, 'revista_header_overlay', true ) ); 
                                if( $revista_header_overlay == '' ){ $revista_header_overlay = 'global-layout'; }

                                foreach ( $revista_header_overlay_options as $key => $revista_header_overlay_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="revista_header_overlay" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $revista_header_overlay ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $revista_header_overlay_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                    <?php endif; ?>

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Feature Image Setting','revista'); ?></h3>

                        <div class="metabox-opt-wrap theme-checkbox-wrap">

                            <?php
                            $revista_ed_feature_image = esc_html( get_post_meta( $post->ID, 'revista_ed_feature_image', true ) );
                            ?>

                            <input type="checkbox" id="revista-ed-feature-image" name="revista_ed_feature_image" value="1" <?php if( $revista_ed_feature_image ){ echo "checked='checked'";} ?>/>
                            <label for="revista-ed-feature-image"><?php esc_html_e( 'Disable Feature Image','revista' ); ?></label>


                        </div>

                    </div>

                     <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Navigation Setting','revista'); ?></h3>

                        <?php $twp_disable_ajax_load_next_post = esc_attr( get_post_meta($post->ID, 'twp_disable_ajax_load_next_post', true) ); ?>
                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <label><b><?php esc_html_e( 'Navigation Type','revista' ); ?></b></label>

                            <select name="twp_disable_ajax_load_next_post">

                                <option <?php if( $twp_disable_ajax_load_next_post == '' || $twp_disable_ajax_load_next_post == 'global-layout' ){ echo 'selected'; } ?> value="global-layout"><?php esc_html_e('Global Layout','revista'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'no-navigation' ){ echo 'selected'; } ?> value="no-navigation"><?php esc_html_e('Disable Navigation','revista'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'norma-navigation' ){ echo 'selected'; } ?> value="norma-navigation"><?php esc_html_e('Next Previous Navigation','revista'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'ajax-next-post-load' ){ echo 'selected'; } ?> value="ajax-next-post-load"><?php esc_html_e('Ajax Load Next 3 Posts Contents','revista'); ?></option>

                            </select>

                        </div>
                    </div>

                </div>

                <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ):

                    
                    $revista_ed_post_views = esc_html( get_post_meta( $post->ID, 'revista_ed_post_views', true ) );
                    $revista_ed_post_read_time = esc_html( get_post_meta( $post->ID, 'revista_ed_post_read_time', true ) );
                    $revista_ed_post_like_dislike = esc_html( get_post_meta( $post->ID, 'revista_ed_post_like_dislike', true ) );
                    $revista_ed_post_author_box = esc_html( get_post_meta( $post->ID, 'revista_ed_post_author_box', true ) );
                    $revista_ed_post_social_share = esc_html( get_post_meta( $post->ID, 'revista_ed_post_social_share', true ) );
                    $revista_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'revista_ed_post_reaction', true ) );
                    $revista_ed_post_rating = esc_html( get_post_meta( $post->ID, 'revista_ed_post_rating', true ) );
                    ?>

                    <div id="twp-tab-booster-content" class="metabox-content-wrap">

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Booster Extension Plugin Content','revista'); ?></h3>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="revista-ed-post-views" name="revista_ed_post_views" value="1" <?php if( $revista_ed_post_views ){ echo "checked='checked'";} ?>/>
                                    <label for="revista-ed-post-views"><?php esc_html_e( 'Disable Post Views','revista' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="revista-ed-post-read-time" name="revista_ed_post_read_time" value="1" <?php if( $revista_ed_post_read_time ){ echo "checked='checked'";} ?>/>
                                    <label for="revista-ed-post-read-time"><?php esc_html_e( 'Disable Post Read Time','revista' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="revista-ed-post-like-dislike" name="revista_ed_post_like_dislike" value="1" <?php if( $revista_ed_post_like_dislike ){ echo "checked='checked'";} ?>/>
                                    <label for="revista-ed-post-like-dislike"><?php esc_html_e( 'Disable Post Like Dislike','revista' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="revista-ed-post-author-box" name="revista_ed_post_author_box" value="1" <?php if( $revista_ed_post_author_box ){ echo "checked='checked'";} ?>/>
                                    <label for="revista-ed-post-author-box"><?php esc_html_e( 'Disable Post Author Box','revista' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="revista-ed-post-social-share" name="revista_ed_post_social_share" value="1" <?php if( $revista_ed_post_social_share ){ echo "checked='checked'";} ?>/>
                                    <label for="revista-ed-post-social-share"><?php esc_html_e( 'Disable Post Social Share','revista' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="revista-ed-post-reaction" name="revista_ed_post_reaction" value="1" <?php if( $revista_ed_post_reaction ){ echo "checked='checked'";} ?>/>
                                    <label for="revista-ed-post-reaction"><?php esc_html_e( 'Disable Post Reaction','revista' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="revista-ed-post-rating" name="revista_ed_post_rating" value="1" <?php if( $revista_ed_post_rating ){ echo "checked='checked'";} ?>/>
                                    <label for="revista-ed-post-rating"><?php esc_html_e( 'Disable Post Rating','revista' ); ?></label>

                            </div>

                        </div>

                    </div>

                <?php endif; ?>
                
            </div>

        </div>  
            
    <?php }
endif;

// Save metabox value.
add_action( 'save_post', 'revista_save_post_meta' );

if( ! function_exists( 'revista_save_post_meta' ) ):

    function revista_save_post_meta( $post_id ) {

        global $post, $revista_post_sidebar_fields, $revista_post_layout_options, $revista_header_overlay_options,  $revista_page_layout_options;

        if ( !isset( $_POST[ 'revista_post_meta_nonce' ] ) || !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['revista_post_meta_nonce'] ) ), basename( __FILE__ ) ) ){

            return;

        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){

            return;

        }
            
        if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {  

            if ( !current_user_can( 'edit_page', $post_id ) ){  

                return $post_id;

            }

        }elseif( !current_user_can( 'edit_post', $post_id ) ) {

            return $post_id;

        }


        foreach ( $revista_post_sidebar_fields as $revista_post_sidebar_field ) {  
            

                $old = esc_html( get_post_meta( $post_id, 'revista_post_sidebar_option', true ) ); 
                $new = isset( $_POST['revista_post_sidebar_option'] ) ? revista_sanitize_sidebar_option_meta( wp_unslash( $_POST['revista_post_sidebar_option'] ) ) : '';

                if ( $new && $new != $old ){

                    update_post_meta ( $post_id, 'revista_post_sidebar_option', $new );

                }elseif( '' == $new && $old ) {

                    delete_post_meta( $post_id,'revista_post_sidebar_option', $old );

                }

            
        }

        $twp_disable_ajax_load_next_post_old = esc_html( get_post_meta( $post_id, 'twp_disable_ajax_load_next_post', true ) ); 
        $twp_disable_ajax_load_next_post_new = isset( $_POST['twp_disable_ajax_load_next_post'] ) ? revista_sanitize_meta_pagination( wp_unslash( $_POST['twp_disable_ajax_load_next_post'] ) ) : '';

        if( $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_new != $twp_disable_ajax_load_next_post_old ){

            update_post_meta ( $post_id, 'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_new );

        }elseif( '' == $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_old ) {

            delete_post_meta( $post_id,'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_old );

        }


        foreach ( $revista_post_layout_options as $revista_post_layout_option ) {  
            
            $revista_post_layout_old = esc_html( get_post_meta( $post_id, 'revista_post_layout', true ) ); 
            $revista_post_layout_new = isset( $_POST['revista_post_layout'] ) ? revista_sanitize_post_layout_option_meta( wp_unslash( $_POST['revista_post_layout'] ) ) : '';

            if ( $revista_post_layout_new && $revista_post_layout_new != $revista_post_layout_old ){

                update_post_meta ( $post_id, 'revista_post_layout', $revista_post_layout_new );

            }elseif( '' == $revista_post_layout_new && $revista_post_layout_old ) {

                delete_post_meta( $post_id,'revista_post_layout', $revista_post_layout_old );

            }
            
        }



        foreach ( $revista_header_overlay_options as $revista_header_overlay_option ) {  
            
            $revista_header_overlay_old = esc_html( get_post_meta( $post_id, 'revista_header_overlay', true ) ); 
            $revista_header_overlay_new = isset( $_POST['revista_header_overlay'] ) ? revista_sanitize_header_overlay_option_meta( wp_unslash( $_POST['revista_header_overlay'] ) ) : '';

            if ( $revista_header_overlay_new && $revista_header_overlay_new != $revista_header_overlay_old ){

                update_post_meta ( $post_id, 'revista_header_overlay', $revista_header_overlay_new );

            }elseif( '' == $revista_header_overlay_new && $revista_header_overlay_old ) {

                delete_post_meta( $post_id,'revista_header_overlay', $revista_header_overlay_old );

            }
            
        }



        $revista_ed_feature_image_old = esc_html( get_post_meta( $post_id, 'revista_ed_feature_image', true ) ); 
        $revista_ed_feature_image_new = isset( $_POST['revista_ed_feature_image'] ) ? absint( wp_unslash( $_POST['revista_ed_feature_image'] ) ) : '';

        if ( $revista_ed_feature_image_new && $revista_ed_feature_image_new != $revista_ed_feature_image_old ){

            update_post_meta ( $post_id, 'revista_ed_feature_image', $revista_ed_feature_image_new );

        }elseif( '' == $revista_ed_feature_image_new && $revista_ed_feature_image_old ) {

            delete_post_meta( $post_id,'revista_ed_feature_image', $revista_ed_feature_image_old );

        }



        $revista_ed_post_views_old = esc_html( get_post_meta( $post_id, 'revista_ed_post_views', true ) ); 
        $revista_ed_post_views_new = isset( $_POST['revista_ed_post_views'] ) ? absint( wp_unslash( $_POST['revista_ed_post_views'] ) ) : '';

        if ( $revista_ed_post_views_new && $revista_ed_post_views_new != $revista_ed_post_views_old ){

            update_post_meta ( $post_id, 'revista_ed_post_views', $revista_ed_post_views_new );

        }elseif( '' == $revista_ed_post_views_new && $revista_ed_post_views_old ) {

            delete_post_meta( $post_id,'revista_ed_post_views', $revista_ed_post_views_old );

        }



        $revista_ed_post_read_time_old = esc_html( get_post_meta( $post_id, 'revista_ed_post_read_time', true ) ); 
        $revista_ed_post_read_time_new = isset( $_POST['revista_ed_post_read_time'] ) ? absint( wp_unslash( $_POST['revista_ed_post_read_time'] ) ) : '';

        if ( $revista_ed_post_read_time_new && $revista_ed_post_read_time_new != $revista_ed_post_read_time_old ){

            update_post_meta ( $post_id, 'revista_ed_post_read_time', $revista_ed_post_read_time_new );

        }elseif( '' == $revista_ed_post_read_time_new && $revista_ed_post_read_time_old ) {

            delete_post_meta( $post_id,'revista_ed_post_read_time', $revista_ed_post_read_time_old );

        }



        $revista_ed_post_like_dislike_old = esc_html( get_post_meta( $post_id, 'revista_ed_post_like_dislike', true ) ); 
        $revista_ed_post_like_dislike_new = isset( $_POST['revista_ed_post_like_dislike'] ) ? absint( wp_unslash( $_POST['revista_ed_post_like_dislike'] ) ) : '';

        if ( $revista_ed_post_like_dislike_new && $revista_ed_post_like_dislike_new != $revista_ed_post_like_dislike_old ){

            update_post_meta ( $post_id, 'revista_ed_post_like_dislike', $revista_ed_post_like_dislike_new );

        }elseif( '' == $revista_ed_post_like_dislike_new && $revista_ed_post_like_dislike_old ) {

            delete_post_meta( $post_id,'revista_ed_post_like_dislike', $revista_ed_post_like_dislike_old );

        }



        $revista_ed_post_author_box_old = esc_html( get_post_meta( $post_id, 'revista_ed_post_author_box', true ) ); 
        $revista_ed_post_author_box_new = isset( $_POST['revista_ed_post_author_box'] ) ? absint( wp_unslash( $_POST['revista_ed_post_author_box'] ) ) : '';

        if ( $revista_ed_post_author_box_new && $revista_ed_post_author_box_new != $revista_ed_post_author_box_old ){

            update_post_meta ( $post_id, 'revista_ed_post_author_box', $revista_ed_post_author_box_new );

        }elseif( '' == $revista_ed_post_author_box_new && $revista_ed_post_author_box_old ) {

            delete_post_meta( $post_id,'revista_ed_post_author_box', $revista_ed_post_author_box_old );

        }



        $revista_ed_post_social_share_old = esc_html( get_post_meta( $post_id, 'revista_ed_post_social_share', true ) ); 
        $revista_ed_post_social_share_new = isset( $_POST['revista_ed_post_social_share'] ) ? absint( wp_unslash( $_POST['revista_ed_post_social_share'] ) ) : '';

        if ( $revista_ed_post_social_share_new && $revista_ed_post_social_share_new != $revista_ed_post_social_share_old ){

            update_post_meta ( $post_id, 'revista_ed_post_social_share', $revista_ed_post_social_share_new );

        }elseif( '' == $revista_ed_post_social_share_new && $revista_ed_post_social_share_old ) {

            delete_post_meta( $post_id,'revista_ed_post_social_share', $revista_ed_post_social_share_old );

        }



        $revista_ed_post_reaction_old = esc_html( get_post_meta( $post_id, 'revista_ed_post_reaction', true ) ); 
        $revista_ed_post_reaction_new = isset( $_POST['revista_ed_post_reaction'] ) ? absint( wp_unslash( $_POST['revista_ed_post_reaction'] ) ) : '';

        if ( $revista_ed_post_reaction_new && $revista_ed_post_reaction_new != $revista_ed_post_reaction_old ){

            update_post_meta ( $post_id, 'revista_ed_post_reaction', $revista_ed_post_reaction_new );

        }elseif( '' == $revista_ed_post_reaction_new && $revista_ed_post_reaction_old ) {

            delete_post_meta( $post_id,'revista_ed_post_reaction', $revista_ed_post_reaction_old );

        }



        $revista_ed_post_rating_old = esc_html( get_post_meta( $post_id, 'revista_ed_post_rating', true ) ); 
        $revista_ed_post_rating_new = isset( $_POST['revista_ed_post_rating'] ) ? absint( wp_unslash( $_POST['revista_ed_post_rating'] ) ) : '';

        if ( $revista_ed_post_rating_new && $revista_ed_post_rating_new != $revista_ed_post_rating_old ){

            update_post_meta ( $post_id, 'revista_ed_post_rating', $revista_ed_post_rating_new );

        }elseif( '' == $revista_ed_post_rating_new && $revista_ed_post_rating_old ) {

            delete_post_meta( $post_id,'revista_ed_post_rating', $revista_ed_post_rating_old );

        }

        foreach ( $revista_page_layout_options as $revista_post_layout_option ) {  
        
            $revista_page_layout_old = sanitize_text_field( get_post_meta( $post_id, 'revista_page_layout', true ) ); 
            $revista_page_layout_new = isset( $_POST['revista_page_layout'] ) ? revista_sanitize_post_layout_option_meta( wp_unslash( $_POST['revista_page_layout'] ) ) : '';

            if ( $revista_page_layout_new && $revista_page_layout_new != $revista_page_layout_old ){

                update_post_meta ( $post_id, 'revista_page_layout', $revista_page_layout_new );

            }elseif( '' == $revista_page_layout_new && $revista_page_layout_old ) {

                delete_post_meta( $post_id,'revista_page_layout', $revista_page_layout_old );

            }
            
        }

        $revista_ed_header_overlay_old = absint( get_post_meta( $post_id, 'revista_ed_header_overlay', true ) ); 
        $revista_ed_header_overlay_new = isset( $_POST['revista_ed_header_overlay'] ) ? absint( wp_unslash( $_POST['revista_ed_header_overlay'] ) ) : '';

        if ( $revista_ed_header_overlay_new && $revista_ed_header_overlay_new != $revista_ed_header_overlay_old ){

            update_post_meta ( $post_id, 'revista_ed_header_overlay', $revista_ed_header_overlay_new );

        }elseif( '' == $revista_ed_header_overlay_new && $revista_ed_header_overlay_old ) {

            delete_post_meta( $post_id,'revista_ed_header_overlay', $revista_ed_header_overlay_old );

        }

    }

endif;   