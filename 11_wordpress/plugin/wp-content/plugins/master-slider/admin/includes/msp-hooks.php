<?php

function msp_filter_masterslider_admin_menu_title( $menu_title ){
  $current = get_site_transient( 'update_plugins' );

    if ( ! isset( $current->response[ MSWP_AVERTA_BASE_NAME ] ) )
    return $menu_title;

  return $menu_title . '&nbsp;<span class="update-plugins"><span class="plugin-count">1</span></span>';
}

add_filter( 'masterslider_admin_menu_title', 'msp_filter_masterslider_admin_menu_title');


function after_master_slider_row_meta( $plugin_meta, $plugin_file, $plugin_data, $status ){
  if( MSWP_AVERTA_BASE_NAME == $plugin_file ) {
    $plugin_meta[] = '<a href="http://wordpress.org/support/view/plugin-reviews/' . MSWP_SLUG . '?rating=5#postform" target="_blank" title="' . esc_attr__( 'Rate this plugin', 'master-slider' ) . '">' . __( 'Rate this plugin', 'master-slider' ) . '</a>';
    $plugin_meta[] = '<a href="http://masterslider.com/doc/wp/free/#donate" target="_blank" title="' . esc_attr__( 'Donate', 'master-slider' ) . '">' . __( 'Donate', 'master-slider' ) . '</a>';
  }
  return $plugin_meta;
}

add_filter( "plugin_row_meta", 'after_master_slider_row_meta', 10, 4 );


// Check to make sure the user "rich_editing" is enabled

function msp_admin_notice_rich_editing(){
    printf('<div class="update-nag">%s</div>', __( 'Warning: the [rich editing] capability is disabled for this user which might lead to some potential issues. Please enable it.', 'default' ) );
}

function msp_check_vital_user_capabilities(){
    $current_user = wp_get_current_user();
    if( ! get_user_meta( $current_user->ID, 'rich_editing', true ) ){
        add_action( 'admin_notices', 'msp_admin_notice_rich_editing' );
    }
}
add_action( 'admin_init', 'msp_check_vital_user_capabilities' );





/**
 * Function to get sample sliders from remote demo site
 *
 * @param  boolean $force_to_fetch  Whether to force to fetch sample sliders or rely on cache
 * @return array                    An array containing remote sample sliders
 */
function msp_request_remote_sample_sliders( $force_to_fetch = false ) {

    $request_body = array();

    if ( ! defined( 'MSWP_SLUG' ) ) {
        return false;
    }

    if ( 'masterslider' == MSWP_SLUG ) {
        if ( '1' == get_option( 'masterslider_is_license_actived', false ) ) {
            $request_body['slider_type'] = 'pro-registered';
        } else {
            $request_body['slider_type'] = 'pro-all';
        }
    } else {
        $request_body['slider_type'] = 'free';
    }

    // try to use cached data
    if( ! $force_to_fetch && false !== ( $result = msp_get_transient( 'msp_get_remote_sample_sliders' ) ) && ! empty( $result ) ){
        return $result;
    }

    $response = wp_remote_get( 'http://api.averta.net/products/masterslider/samples/' ,
        array(
            'body'    => $request_body,
            'timeout' => 30
        )
    );


    if ( ! is_wp_error( $response ) ) {

        if( ! empty( $response['body'] ) ){
            $result = json_decode( $response['body'], true );

            if( empty( $result ) ){
                echo '<div class="ms-modal-msg msg-error"><p>'.
                    __( 'Unfortunately an Error occurred while fetching the remote sample sliders. Please reload the page to try again.', MSWP_TEXT_DOMAIN ) .
                    "<br><br><strong>" . __( 'Error', MSWP_TEXT_DOMAIN ) . '</strong>: [ ' . __( 'No data was received.', MSWP_TEXT_DOMAIN ) . ' ]'.
                '</p></div>';

            } else {
                msp_set_transient( 'msp_get_remote_sample_sliders', $result, 3 * HOUR_IN_SECONDS );
                return $result;
            }
        }

    } else {
        echo '<div class="ms-modal-msg msg-error"><p>'.
            __( 'Unfortunately an Error occurred while fetching the remote sample sliders. Please reload the page to try again.', MSWP_TEXT_DOMAIN ) .
            "<br><br><strong>" . __( 'Error', MSWP_TEXT_DOMAIN ) . '</strong>: [ ' . $response->get_error_message() . ' ]'.
        '</p></div>';
    }

    return false;
}


/**
 * Adds Master Slider specific classes to admin body
 * @param  string $classes The CSS classes for admin body
 * @return string          The CSS classes for admin body
 */
function msp_add_master_admin_class( $classes ){
    if( ! empty( $_GET['page'] ) && MSWP_SLUG == $_GET['page'] ){
        $classes .= ' msp';
    }
    if( empty( $_GET['slider_id'] ) ||
       ( ! empty( $_GET['action'] ) && in_array( $_GET['action'], array( 'duplicate', 'delete' ) ) )
       ){
        $classes .= ' master-list';
    }
    return $classes;
}
add_filter( 'admin_body_class', 'msp_add_master_admin_class' );


/**
 * Function to show premium sliders in "premium sliders" section
 */
function msp_premium_sliders( $demos ) {

    if ( $online_demos = msp_request_remote_sample_sliders() ) {
        foreach ( $online_demos as $demo ) {
            if ( 'custom' == $demo['slidertype'] ) {
                $demos['masterslider_pro_custom_samples1'][] = $demo;
            } elseif( in_array( $demo['slidertype'], array( 'post', 'wc-product', 'flickr' ) ) ) {
                $demos['masterslider_dynamic_group'][] = $demo;
            } else {
                $demos['masterslider_pro_post_samples1'][] = $demo;
            }
        }
    }

    return $demos;
}
add_filter( 'masterslider_starter_fields', 'msp_premium_sliders' );


 /**
  * Expires/Flushes all sliders cache after publishing new post
  *
  * @param  int     $post_id Post ID
  * @param  WP_Post $post    Post object.
  * @param  bool    $update  Whether this is an existing post being updated or not.
  */
 function msp_flush_cashe_after_publishing_new_post( $post_id, $post, $update ) {

     // If the cache is disabled, skip
     $is_cache_enabled = ( 'on' == msp_get_setting( '_enable_cache', 'msp_general_setting', 'off' ) );
     if( ! $is_cache_enabled ){
         return;
     }

     // If this is just a revision, skip
     if ( wp_is_post_revision( $post_id ) ){
         return;
     }

     $post_type = get_post_type( $post_id );

     // If this isn't a know post type, skip
     if ( ! in_array( $post_type, array( 'post', 'page', 'portfolio', 'product', 'news' ) ) ){
         return;
     }

     // Expires all sliders cache
     msp_flush_all_sliders_cache( array( 'post', 'wc-product' ) );
 }

 add_action( 'save_post', 'msp_flush_cashe_after_publishing_new_post', 10, 3 );

