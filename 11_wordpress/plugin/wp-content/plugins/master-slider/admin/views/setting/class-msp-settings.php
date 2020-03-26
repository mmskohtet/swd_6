<?php

if ( ! class_exists('WeDevs_Settings_API' ) )
    require_once ( 'class-settings-api.php' );

/**
 * MasterSlider Setting page
 *
 * @author Tareq Hasan
 */
if ( !class_exists('MSP_Settings' ) ):

class MSP_Settings {

    private $settings_api;

    function __construct() {

        $this->settings_api = new WeDevs_Settings_API;

        add_action( 'admin_init', array( $this, 'admin_init' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu' ), 11 );
        add_action( 'admin_action_msp_envato_license', array( $this, 'envato_license_updated' ) );

        add_action( 'admin_footer-master-slider_page_masterslider-setting', array( $this, 'print_setting_script' ) );
        add_filter( 'axiom_wedev_setting_section_submit_button', array( $this, 'section_submit_button' ), 10, 2 );
    }


    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields  ( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();

        $this->flush_sliders_cache();
    }


    function flush_sliders_cache(){

        if( isset( $_POST['msp_general_setting'] ) ){
            if( isset( $_POST['msp_general_setting']['_enable_cache'] ) &&  'on' == $_POST['msp_general_setting']['_enable_cache'] ){
                msp_flush_all_sliders_cache();
            }
        }
    }


    function section_submit_button( $button_markup, $section ){
        if( isset( $section['id'] ) && 'msp_envato_license' == $section['id'] ){
            $is_license_actived = get_option( MSWP_SLUG . '_is_license_actived', 0 );
            return sprintf( '<a id="validate_envato_license" class="button button-primary button-large" data-activate="%1$s" data-isactive="%3$d" data-deactivate="%2$s" data-validation="%4$s" >%1$s</a>%5$s',
                            __( 'Activate License', 'master-slider' ), __( 'Deactivate License', 'master-slider' ), (int)$is_license_actived,
                            __( 'Validating ..', 'master-slider' ), '<div class="msp-msg-nag">is not actived</div>' );
        }
        return $button_markup;
    }


    function admin_menu() {

        add_submenu_page(
            MSWP_SLUG,
            __( 'Settings' , 'master-slider' ),
            __( 'Settings' , 'master-slider' ),
            apply_filters( 'masterslider_setting_capability', 'manage_options' ),
            MSWP_SLUG . '-setting',
            array( $this, 'render_setting_page' )
        );
    }

    function get_settings_sections() {
        $sections = array(

            array(
                'id' => 'msp_general_setting',
                'title' => __( 'General Settings', 'master-slider' )
            )
        );

        $sections[] = array(
            'id' => 'msp_advanced',
            'title' => __( 'Advanced Setting', 'master-slider' )
        );

        $sections[] = array(
            'id' => 'upgrade_to_pro',
            'title' => __( 'Upgrade to Pro version', 'master-slider' )
        );

        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {

        $settings_fields = array();

        $settings_fields['msp_general_setting'] = array(
            array(
                'name'  => 'hide_info_table',
                'label' => __( 'Hide info table', 'master-slider' ),
                'desc'  => __( 'If you want to hide "Latest video tutorials" table on master slider admin panel check this field.', 'master-slider' ),
                'type'  => 'checkbox'
            ),
            array(
                'name'  => '_enable_cache',
                'label' => __( 'Enable cache?', 'master-slider' ),
                'desc'  => __( 'Enable cache to make Masterslider even more faster!', 'master-slider' ),
                'type'  => 'checkbox'
            ),
            array(
                'name'  => '_cache_period',
                'label' => __( 'Cache period time', 'master-slider' ),
                'desc'  => __( 'The cache refresh time in hours. Cache is also cleared when you click on "Save Changes" in slider panel.', 'master-slider' ),
                'type'  => 'text',
                'default' => '12',
                'sanitize_callback' => 'floatval'
            )
        );

        $settings_fields['msp_advanced'] = array(
            array(
                'name'  => 'allways_load_ms_assets',
                'label' => __( 'Load assets on all pages?', 'master-slider' ),
                'desc'  => __( 'By default, Master Slider will load corresponding JavaScript files on demand. but if you need to load assets on all pages, check this option. ( For example, if you plan to load Master Slider via Ajax, you need to check this option ) ', 'master-slider' ),
                'type'  => 'checkbox'
            )
        );

        // AB test the pro features in setting pro tab
        if( 1 == get_option( 'master-slider_ab_pro_feature_setting_content_type', 2 ) ){

            $settings_fields['upgrade_to_pro'] = array(
                array(
                    'name' => 'upgrade_text',
                    'desc' => __( 'Upgrade to Pro version to unlock more features!', 'master-slider' ) . sprintf( ' <a href="http://avt.li/mslset" target="_blank">%s</a>', __( 'Checkout the list of features ..', 'master-slider' ) ),
                    'type' => 'plain_text',
                    'label'=> __( 'Need more features?', 'master-slider' )
                )
            );

        } else {

            ob_start();
?>
<div class="msp-metabox-row msp-new-pro-tab">
    <div class="msp-new-pro-header">
        <div class="msp-content-wrapper">
            <div class="msp-new-pro-logo">
                <h2>Boost Your Creativity by</h2>
                <h1> Master Slider PRO</h1>
            </div>
            <div class="msp-new-pro-headerBg">
                <p>BUNDLED WITH 70+ PREBUILT PREMIUM STARTER SLIDERS</p>
            </div>
        </div>
    </div>
    <div class="msp-new-pro-features">
        <div class="msp-content-wrapper">
            <h3>What's Included in Pro Edition?</h3>
            <p>You will have access to tons of premium features which help you to create professional looking sliders with ease. Some of the remarkable features:</p>

            <div class="msp-new-pro-flex-container">
                <div class="msp-new-pro-features-items">
                    <ul>
                        <li>
                            70+ Starter Sliders
                        </li>
                         <li>
                            Animated Layers
                        </li>
                         <li>
                            Parallax Effect
                        </li>
                         <li>
                            Fullscreen Layout
                        </li>
                    </ul>
                </div>
                <div class="msp-new-pro-features-items">
                    <ul>
                        <li>
                            8+ Slide Transitions
                        </li>
                         <li>
                            Post Slider
                        </li>
                         <li>
                            Facebook and Flickr Slider
                        </li>
                         <li>
                            WooCommerce Slider
                        </li>
                    </ul>
                </div>
                <div class="msp-new-pro-features-items">
                    <ul>
                        <li>
                            Video Background
                        </li>
                         <li>
                            Hotspots and Tooltips
                        </li>
                         <li>
                            Custom Slider Templates
                        </li>
                         <li>
                            Dedicated Support
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="msp-new-pro-testimonials">
        <div class="msp-content-wrapper">
            <h3>What Others Say</h3>

                  <ul class="tabs-content">
                    <li id="s1">
                        <p>We cannot believe how simple is using MasterSlider! The interface is so simple, easy to use and extraordinary intuitive. The sample sliders library and auto importing feature was our dream that came true by you guys! The documentation, video tutorials and variety of options for customizing everything was totally beyond our expectation! You really nailed it!</p>
                        <img class="msp-new-pro-avatar" src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/testimonials/pixflow.png" alt="">
                        <h4>PixFlow<br><span>WordPress Theme Author</span></h4>
                    </li>
                    <li id="s2">
                        <p>The best user experience I have ever had so far with a slideshow plugin for WordPress so far. Easy to learn, easy to set up, lots of predefined slides, fast growing, soon coming updates, lots of great features, I can go on for days and days about it, easily the best money I have spent on a project.</p>
                        <img class="msp-new-pro-avatar" src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/testimonials/captial-themes.jpg" alt="">
                        <h4>Capital Themes<br><span>WordPress Theme Author</span></h4>
                    </li>
                    <li id="s3">
                        <p>I've used all the best selling sliders and whilst you can achieve great things with them, I've always struggled when I pass the site over to a client. They are inundated with confusing interfaces. Master slider changes all that. I honestly feel I could give this to any of my clients and within minutes, they would be building their own sliders. I am going back over previous sites and swapping out revolution slider, with a big smile on my face. Thank you.</p>
                        <img class="msp-new-pro-avatar" src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/testimonials/massImpressions.png" alt="">
                        <h4>MassImpressions<br><span>Web Design Agency</span></h4>
                    </li>
                    <li id="s4">
                        <p>I've used all sliders available to WordPress and this is by far the easiest to use and with the best results.</p>
                        <img class="msp-new-pro-avatar" src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/testimonials/theorian.jpg" alt="">
                        <h4>TheOrian82</h4>
                    </li>
                    <li id="s5">
                        <p>Excellent plugin. Siemple and easy to use and understand. It offers freedom to configure. Highly recommended!</p>
                        <img class="msp-new-pro-avatar" src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/testimonials/pabloegrande.jpg" alt="">
                        <h4>Pabloegrande</h4>
                    </li>
                  </ul>
                  <ul class="tabs">
                    <li class="active"><a href="#s1"></a></li>
                    <li><a href="#s2"></a></li>
                    <li><a href="#s3"></a></li>
                    <li><a href="#s4"></a></li>
                    <li><a href="#s5"></a></li>
                  </ul>

        </div>
    </div>

    <div class="msp-new-pro-guarantee">
        <div class="msp-content-wrapper">
            <img src="<?php echo MSWP_AVERTA_ADMIN_URL . '/views/slider-panel'; ?>/images/pro-features/badge.png" alt="">
            <h3>10-Day Money Back Guarantee</h3>
            <p>To ensure your satisfaction, we offer 10 days money back guarantee with your purchase if you are not satisfied with Master Slider Pro, we kindly refund 100% of your money without any condition!</p>
        </div>
    </div>

    <div class="msp-new-pro-buy">
        <div class="msp-content-wrapper">
            <h2>Join the <?php echo msp_get_pro_users_num(); ?> Pro users today!</h2>
            <a href="http://avt.li/mspnpt" target="_blank" class="msp-new-pro-btn" target="_blank">Get a License Instantly</a>
        </div>
    </div>
</div>
<?php
            $pro_desciption = ob_get_clean();

            $settings_fields['upgrade_to_pro'] = array(
                array(
                    'name' => 'upgrade_text',
                    'desc' => $pro_desciption,
                    'type' => 'plain_text',
                    'label'=> ''
                )
            );
        }



        return $settings_fields;
    }

    function render_setting_page() {
        echo '<div class="wrap">';

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }


    /**
     * This code uses localstorage for displaying active tabs
     *
     */
    function print_setting_script() {
        ?>

        <style>
            .master-slider_page_masterslider-setting .wrap input[disabled] { background-color:#e0e0e0; }
            .msp-msg-nag {
                display: inline-block;
                line-height: 14px;
                padding: 8px 15px;
                font-size: 14px;
                text-align: left;
                margin: 0 20px;
                background-color: #fff;
                border-left: 4px solid #ffba00;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
                box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            }
        </style>
        <?php
    }

}

endif;

$settings = new MSP_Settings();
