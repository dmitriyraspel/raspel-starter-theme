<?php
/**
 * my_first_theme_for-block Theme Customizer
 *
 * @package my_first_theme_for-block
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function raspellab_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial(
		'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'raspellab_customize_partial_blogname',
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'raspellab_customize_partial_blogdescription',	
		)
	);

	/* Display Logo and Title ---------------- */
	
	$wp_customize->add_setting(
		'site_logo_and_title',
		array(
			'default'	=> '',
		)
	);

	$wp_customize->add_control(
		'site_logo_and_title',
		array(
			'type'        => 'checkbox',
			'section'     => 'title_tagline',
			'priority'    => 10,
			'label'       => __( 'показывать логотип и заголовок', 'raspellab' ),
		)
	);

	/* Display Title and description ---------------- */
	$wp_customize->add_setting(
		'site_title_and_description',
		array(
			'default'	=> '',
		)
	);

	$wp_customize->add_control(
		'site_title_and_description',
		array(
			'type'        => 'checkbox',
			'section'     => 'title_tagline',
			'priority'    => 11,
			'label'       => __( 'показывать заголовок и описание', 'raspellab' ),
		)
	);

}
add_action( 'customize_register', 'raspellab_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function raspellab_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function raspellab_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function raspellab_customize_preview_js() {
	wp_enqueue_script( 'raspellab-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'raspellab_customize_preview_js' );
