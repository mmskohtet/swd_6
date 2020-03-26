<?php
// child style enqueue
add_action( 'wp_enqueue_scripts', 'eleto_styles' );
function eleto_styles(){
    $themeVersion = wp_get_theme()->get('Version');
    // Enqueue our style.css with our own version
    wp_enqueue_style('eleto-styles', get_template_directory_uri() . '/style.css',array(), $themeVersion);
}
//customizer
function eleto_blog( $wp_customize ){
define('ELETO_ZITA_LAYOUT', get_stylesheet_directory_uri() . "/images/eleto-layout.png");
$wp_customize->add_setting(
            'zita_blog_layout', array(
                'default'           => 'zta-blog-layout-1',
                'sanitize_callback' => 'zita_shop_sanitize_radio',
            )
        );
$wp_customize->add_control(
            new Zita_WP_Customize_Control_Radio_Image(
                $wp_customize, 'zita_blog_layout', array(
                    'label'    => esc_html__( 'Blog Layout', 'eleto' ),
                    'section'  => 'zita-blog-archive',
                    'choices'  => array(   
                        'zta-blog-layout-1' => array(
                            'url' => ZITA_BLOG_ARCHIVE_LAYOUT_1,
                        ),
                        'eleto-blog-layout' => array(
                            'url' => ELETO_ZITA_LAYOUT,
                        ),
                        
                    ),
                    'priority'   =>1,
                )
            )
);
}
add_action( 'customize_register', 'eleto_blog', 100 );