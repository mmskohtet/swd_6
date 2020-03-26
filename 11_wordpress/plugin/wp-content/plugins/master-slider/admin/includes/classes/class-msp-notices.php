<?php


class MSP_Notices {

    /**
     * Instance of this class.
     *
     * @var      object
     */
    protected static $instance = null;


    /**
     * The list of notice IDs
     *
     * @var      object
     */
    private $notice_ids = array();

    /**
     * Notices
     *
     * @var array
     */
    private $notices    = array();

    /**
     * Base API URL
     *
     * @var string
     */
    private $base_url   = '';

    /**
     * Prefix
     *
     * @var string
     */
    private $prefix   = 'master-slider-';


    function __construct(){

        $this->notice_ids = array(
            'ms-notice-info-dashboard',
            'ms-notice-info-panel',
            'ms-notice-info-global'
        );

        $this->base_url = 'http://cdn.averta.net/project/masterslider/free/info/';
    }

    // Methods using the plugin API
    // =========================================================================

    private function get_option( $option_key ){
        return msp_get_option( $this->prefix . $option_key );
    }

    private function update_option( $option_key, $option_value ){
        return msp_update_option( $this->prefix . $option_key, $option_value );
    }

    private function get_transient( $transient ){
        return msp_get_transient( $this->prefix . $transient );
    }

    private function set_transient( $transient, $value, $expiration = 0 ){
        return msp_set_transient( $this->prefix . $transient, $value, $expiration );
    }

    private function delete_transient( $transient ){
        return msp_delete_transient( $this->prefix . $transient );
    }

    private function get_remote_post( $url ){
        return msp_remote_post( $url );
    }

    // =========================================================================

    private function get_notice_info_transient_id( $notice_id ){
        return 'notice-info-' . esc_attr( $notice_id );
    }

    private function fetch_notice_info( $notice_id, $force_update = false ){

        if( empty( $notice_id ) ){
            return false;
        }

        // defaults
        $defaults = array(
            'remote_url'    => '', // the remote notice url
            'beta_url'      => '', // beta remote content
            'revision'      => '', // empty means don't display
            'first_delay'   => 0, // in seconds
            'id'            => $notice_id,
            'enabled'       => true,

            'content'       => '', // the remote notice content
            'delay_passed'  => false, // the remote notice content
            'debug'         => array()
        );

        // info transient id
        $transient_id = $this->get_notice_info_transient_id( $notice_id );

        if( isset( $_GET['msafi'] ) ){
            $this->delete_transient( $transient_id );
        }

        if( ! $force_update && false !== ( $result = $this->get_transient( $transient_id ) ) ){
            // wp_parse_args to prevent the errors while new args implemented in new versions
            $defaults['debug'][] = '1.1';
            return wp_parse_args( $result, $defaults );
        }

        if( false === $info = $this->get_remote_post( $this->base_url . $notice_id . '.json' ) ){
            $defaults['debug'][] = '1.2';
            return $defaults;
        } else {
            $info = json_decode( $info, true );
            $info = wp_parse_args( $info, $defaults );
            $info['debug'][] = '1.3';
        }

        // get remote content
        $remote_url = isset( $_GET['msbeta'] ) ? $info["beta_url"] : $info["remote_url"];
        $info["content"] = $this->fetch_file_content( $remote_url );

        if( empty( $info["revision"] ) ){
            $info["enabled"] = false;
            $info['debug'][] = '1.4';

        } elseif( is_numeric( $info['revision'] ) && $info['revision'] != $this->get_option( 'notice-'. $notice_id .'-latest-revision' ) ){
            $info["enabled"] = true;
            $info['debug'][] = '1.5';
        } else {
            $info["enabled"] = false;
            $info['debug'][] = '1.55';
        }

        if( ! $this->get_option( 'notice-installtion-time' ) ){
            $this->update_option( 'notice-installtion-time', time() );
            $info['debug'][] = '1.6';
        }

        $first_delay_diff = ( ( $this->get_option( 'notice-installtion-time' ) + ( (int) $info['first_delay'] ) ) - time() );
        $info['debug'][] = 'Due - Now: '. ( $first_delay_diff < 0 ? 'Passed ' . abs($first_delay_diff) : ' Remaining ' . abs($first_delay_diff) ) . ' seconds';
        $info['debug'][] = 'Previous revision: '. $this->get_option( 'notice-'. $notice_id .'-latest-revision' );
        $info['debug'][] = 'Remote revision: '. $info['revision'];

        // check for initial delay
        if( $info['first_delay'] ){
            if( $this->get_option( 'notice-installtion-time' ) + ( (int) $info['first_delay'] ) > time() ){
                $info['debug'][] = '1.7';
                $info["delay_passed"] = false;
            } else {
                $info["delay_passed"] = true;
                $info['debug'][] = '1.8';
            }
        } else {
            $info["delay_passed"] = true;
        }

        $this->set_transient( $transient_id, $info, 6 * HOUR_IN_SECONDS );

        return $info;
    }

    private function fetch_file_content( $url ){
        if( false === $result = $this->get_remote_post( $url ) ){
            return '';
        }
        return $result;
    }

    public function get_content( $notice_id ){
        $result = $this->fetch_notice_info( $notice_id );

        if( isset( $_GET['msdebug'] ) ){
            $debug_info = $result;
            unset( $debug_info['content'] );
            $debug = axpp( $debug_info, false, true );
        } else {
            $debug = '';
        }

        if( ! empty( $result['content'] ) && $result['enabled'] && $result['delay_passed'] ){
            return $result['content'] . $debug;
        }

        return $debug;
    }


    public function get_notice( $notice_id ){
        if( $content = $this->get_content( $notice_id ) ){
            return '<div class="updated msp-notice-wrapper msp-banner-wrapper">' . $content . '</div>';
        }
        return '';
    }

    public function disable_notice( $notice_id ){

        if( ! in_array( $notice_id, $this->notice_ids ) ){
            return false;
        }

        // info transient id
        $transient_id = $this->get_notice_info_transient_id( $notice_id );

        if( false !== ( $info = $this->fetch_notice_info( $notice_id ) ) ){
            $this->update_option( 'notice-'. $notice_id .'-latest-revision', $info['revision'] );
            $info['enabled'] = false;
            $this->set_transient( $transient_id, $info, 6 * HOUR_IN_SECONDS );
        }

        return true;
    }

    /**
     * Return an instance of this class.
     *
     * @return    object    A single instance of this class.
     */
    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

}
