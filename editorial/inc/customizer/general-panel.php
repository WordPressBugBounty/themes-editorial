<?php
/**
 * Customizer settings for General purpose
 *
 * @package Mystery Themes
 * @subpackage Editorial
 * @since 1.0.0
 */

add_action( 'customize_register', 'editorial_general_settings_register' );

function editorial_general_settings_register( $wp_customize ) {

	$wp_customize->get_section( 'title_tagline' )->panel        = 'editorial_general_settings_panel';
    $wp_customize->get_section( 'title_tagline' )->priority     = '3';
    $wp_customize->get_section( 'colors' )->panel               = 'editorial_general_settings_panel';
    $wp_customize->get_section( 'colors' )->priority            = '4';
    $wp_customize->get_section( 'background_image' )->panel     = 'editorial_general_settings_panel';
    $wp_customize->get_section( 'background_image' )->priority  = '5';
    $wp_customize->get_section( 'static_front_page' )->panel    = 'editorial_general_settings_panel';
    $wp_customize->get_section( 'static_front_page' )->priority = '6';

    /**
     * Add General Settings Panel 
     */
    $wp_customize->add_panel( 
        'editorial_general_settings_panel', 
        array(
            'priority'       => 3,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'General Settings', 'editorial' ),
        ) 
    );

/*---------------------------------------------------------------------------------------------------------------*/
    //Theme color
    $wp_customize->add_setting(
        'editorial_theme_color',
        array(
            'default'           => '#f54337',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'editorial_theme_color',
            array(
                'label'         => __( 'Theme color', 'editorial' ),
                'section'       => 'colors',
                'priority'      => 5
            )
        )
    );

/*---------------------------------------------------------------------------------------------------------------*/
    /**
     * Website layout
     */
    $wp_customize->add_section(
        'editorial_site_layout',
        array(
            'title'         => __( 'Website Layout', 'editorial' ),
            'description'   => __( 'Choose a site to display your website more effectively.', 'editorial' ),
            'priority'      => 5,
            'panel'         => 'editorial_general_settings_panel',
        )
    );
    
    $wp_customize->add_setting(
        'site_layout_option',
        array(
            'default'           => 'fullwidth_layout',
            'sanitize_callback' => 'editorial_sanitize_site_layout',
        )       
    );
    $wp_customize->add_control(
        'site_layout_option',
        array(
            'type' => 'radio',
            'priority'    => 10,
            'label' => __( 'Site Layout', 'editorial' ),
            'section' => 'editorial_site_layout',
            'choices' => array(
                'fullwidth_layout'  => __( 'FullWidth Layout', 'editorial' ),
                'boxed_layout'      => __( 'Boxed Layout', 'editorial' )
            ),
        )
    );
    
    /**
     * Block based widget editor option.
     */
    $wp_customize->add_setting(
        'editorial_block_widget_editor_option', 
        array(
            'default'       => 'disable',
            'capability'    => 'edit_theme_options',
            'sanitize_callback' => 'editorial_enable_switch_sanitize'
        )
    );
    $wp_customize->add_control( new Editorial_Customize_Switch_Control(
        $wp_customize,
            'editorial_block_widget_editor_option', 
            array(
                'type'          => 'switch',
                'label'         => __( 'Block Widget Editor Option', 'editorial' ),
                'description'   => __( 'Enable/disable Block-based Widgets Editor(since WordPress 5.8).', 'editorial' ),
                'priority'      => 25,
                'section'       => 'editorial_site_layout',
                'choices'       => array(
                    'enable'          => __( 'Enable', 'editorial' ),
                    'disable'         => __( 'Disable', 'editorial' )
                )
            )
        )
    );
}