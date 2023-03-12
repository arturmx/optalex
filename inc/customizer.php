<?php

defined( 'ABSPATH' ) || exit;

/**
 * Implement Theme Customizer additions and adjustments.
 * https://codex.wordpress.org/Theme_Customization_API
 *
 * How do I "output" custom theme modification settings? https://developer.wordpress.org/reference/functions/get_theme_mod
 * echo get_theme_mod( 'copyright_info' );
 * or: echo get_theme_mod( 'copyright_info', 'Default (c) Copyright Info if nothing provided' );
 *
 * "sanitize_callback": https://codex.wordpress.org/Data_Validation
 */
function optalex_customize( $wp_customize ) {
	/**
	 * Initialize sections
	 */
	$wp_customize->add_section(
		'theme_header_section',
		array(
			'title'    => __( 'Header', 'optalex' ),
			'priority' => 1000,
		)
	);

	/**
	 * Section: Page Layout
	 */
	// Header Logo.
	$wp_customize->add_setting(
		'header_logo',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'header_logo',
			array(
				'label'       => __( 'Upload Header Logo', 'optalex' ),
				'description' => __( 'Height: &gt;80px', 'optalex' ),
				'section'     => 'theme_header_section',
				'settings'    => 'header_logo',
				'priority'    => 1,
			)
		)
	);

	// Predefined Navbar scheme.
	$wp_customize->add_setting(
		'navbar_scheme',
		array(
			'default'           => 'default',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'navbar_scheme',
		array(
			'type'     => 'radio',
			'label'    => __( 'Navbar Scheme', 'optalex' ),
			'section'  => 'theme_header_section',
			'choices'  => array(
				'navbar-light bg-light'  => __( 'Default', 'optalex' ),
				'navbar-dark bg-dark'    => __( 'Dark', 'optalex' ),
				'navbar-dark bg-primary' => __( 'Primary', 'optalex' ),
			),
			'settings' => 'navbar_scheme',
			'priority' => 1,
		)
	);

	// Fixed Header?
	$wp_customize->add_setting(
		'navbar_position',
		array(
			'default'           => 'static',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'navbar_position',
		array(
			'type'     => 'radio',
			'label'    => __( 'Navbar', 'optalex' ),
			'section'  => 'theme_header_section',
			'choices'  => array(
				'static'       => __( 'Static', 'optalex' ),
				'fixed_top'    => __( 'Fixed to top', 'optalex' ),
				'fixed_bottom' => __( 'Fixed to bottom', 'optalex' ),
			),
			'settings' => 'navbar_position',
			'priority' => 2,
		)
	);

	// Search?
	$wp_customize->add_setting(
		'search_enabled',
		array(
			'default'           => '1',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'search_enabled',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Show Searchfield?', 'optalex' ),
			'section'  => 'theme_header_section',
			'settings' => 'search_enabled',
			'priority' => 3,
		)
	);

	 /**
     * Initialize sections
     */
    $wp_customize->add_section(
        'theme_footer_section',
        array(
            'title' => __('Footer', 'optalex'),
            'priority' => 1001,
        )
    );

    /**
     * Section: Page Layout
     */
     	 /**
     * Initialize sections
     */
    $wp_customize->add_section(
        'alert_shoop_section',
        array(
            'title' => __('Komunikaty', 'optalex'),
            'priority' => 1001,
        )
    );

    /**
     * Section: Page Layout
     */

    $wp_customize->add_setting('footer_text_1', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('footer_text_1', array(
        'type' => 'text',
        'label' => __('Tekst nad stopką', 'optalex'),
        'description' => '',
        'section' => 'theme_footer_section',

        'settings' => 'footer_text_1',
        'priority' => 1,
    ));

    $wp_customize->add_setting('footer_text_2', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('footer_text_2', array(
        'type' => 'text',
        'label' => __('Nr telefonu', 'optalex'),
        'description' => '',
        'section' => 'theme_footer_section',

        'settings' => 'footer_text_2',
        'priority' => 2,
    ));
    $wp_customize->add_setting('footer_text_3', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('footer_text_3', array(
        'type' => 'text',
        'label' => __('Adres e-mail', 'optalex'),
        'description' => '',
        'section' => 'theme_footer_section',

        'settings' => 'footer_text_3',
        'priority' => 3,
    ));

    $wp_customize->add_setting('footer_menu_1', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('footer_menu_1', array(
        'type' => 'text',
        'label' => __('Nagłówek 1', 'optalex'),
        'description' => '',
        'section' => 'theme_footer_section',

        'settings' => 'footer_menu_1',
        'priority' => 4,
    ));

    $wp_customize->add_setting('footer_menu_2', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('footer_menu_2', array(
        'type' => 'text',
        'label' => __('Nagłówek  2', 'optalex'),
        'description' => '',
        'section' => 'theme_footer_section',

        'settings' => 'footer_menu_2',
        'priority' => 4,
    ));

    $wp_customize->add_setting('footer_menu_3', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('footer_menu_3', array(
        'type' => 'text',
        'label' => __('Nagłówek  3', 'optalex'),
        'description' => '',
        'section' => 'theme_footer_section',

        'settings' => 'footer_menu_3',
        'priority' => 4,
    ));

	$wp_customize->add_setting('alert_shoop', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('alert_shoop', array(
        'type' => 'text',
        'label' => __('Treść komunikatu ', 'optalex'),
        'description' => '',
        'section' => 'alert_shoop_section',

        'settings' => 'alert_shoop',
        'priority' => 4,
    ));
    
    $wp_customize->add_setting('alert_shoop_en', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('alert_shoop_en', array(
        'type' => 'text',
        'label' => __('Treść komunikatu EN ', 'optalex'),
        'description' => '',
        'section' => 'alert_shoop_section',

        'settings' => 'alert_shoop_en',
        'priority' => 4,
    ));
}
add_action( 'customize_register', 'optalex_customize' );


/**
 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function optalex_customize_preview_js() {
	wp_enqueue_script( 'customizer', get_template_directory_uri() . '/inc/customizer.js', array( 'jquery' ), null, true );
}
add_action( 'customize_preview_init', 'optalex_customize_preview_js' );
