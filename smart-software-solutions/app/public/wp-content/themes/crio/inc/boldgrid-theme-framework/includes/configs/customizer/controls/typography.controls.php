<?php
/**
 * Customizer Controls Configs.
 *
 * @package Boldgrid_Theme_Framework
 * @subpackage Boldgrid_Theme_Framework\Configs\Customizer\Controls
 *
 * @since 2.0.0
 *
 * @return array Controls to create in the WordPress Customizer.
 */

return array(
	'bgtfw_headings_color'             => array(
		'type'              => 'bgtfw-palette-selector',
		'transport'         => 'postMessage',
		'settings'          => 'bgtfw_headings_color',
		'label'             => esc_attr__( 'Heading Font Color', 'crio' ),
		'section'           => 'boldgrid_typography',
		'priority'          => 4,
		'default'           => '',
		'choices'           => array(
			'colors' => $bgtfw_formatted_palette,
			'size'   => $bgtfw_palette->get_palette_size( $bgtfw_formatted_palette ),
		),
		'sanitize_callback' => array( $bgtfw_color_sanitize, 'sanitize_palette_selector' ),
	),
	'bgtfw_headings_typography'        => array(
		'type'      => 'typography',
		'settings'  => 'bgtfw_headings_typography',
		'transport' => 'auto',
		'label'     => esc_attr__( 'Headings Typography', 'crio' ),
		'section'   => 'boldgrid_typography',
		'default'   => array(
			'font-family'    => 'Roboto',
			'variant'        => 'regular',
			'line-height'    => '1.5',
			'letter-spacing' => '0',
			'subsets'        => array( 'latin-ext' ),
			'text-transform' => 'none',
		),
		'priority'  => 2,
		'output'    => $bgtfw_typography->get_output_values( $bgtfw_configs ),
		'edit_vars' => array(
			array(
				'selector'    => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
				'label'       => esc_attr__( 'Heading Typography', 'crio' ),
				'description' => esc_attr__( 'Adjust heading typography styles', 'crio' ),
			),
		),
	),
	'bgtfw_headings_font_size'         => array(
		'type'      => 'slider',
		'transport' => 'postMessage',
		'settings'  => 'bgtfw_headings_font_size',
		'label'     => esc_attr__( 'Font Size', 'crio' ),
		'section'   => 'boldgrid_typography',
		'default'   => '14',
		'choices'   => array(
			'min'  => '6',
			'max'  => '42',
			'step' => '1',
		),
		'priority'  => 3,
	),
	'bgtfw_body_typography'            => array(
		'type'      => 'typography',
		'transport' => 'auto',
		'settings'  => 'bgtfw_body_typography',
		'label'     => esc_attr__( 'Main Text Typography', 'crio' ),
		'section'   => 'boldgrid_typography',
		'default'   => array(
			'font-family'    => 'Roboto',
			'variant'        => '100',
			'font-size'      => '18px',
			'line-height'    => '1.4',
			'letter-spacing' => '0',
			'subsets'        => array( 'latin-ext' ),
			'text-transform' => 'none',
		),
		'priority'  => 1,
		'output'    => array(
			array(
				'element' => '.widget, .site-content, .attribution-theme-mods-wrapper, .gutenberg .edit-post-visual-editor, .mce-content-body, .template-header',
			),
		),
		'edit_vars' => array(
			array(
				'selector'    => array(
					'.site-content p:first-of-type',
				),
				'label'       => esc_attr__( 'Main Text Typography', 'crio' ),
				'description' => esc_attr__( 'Adjust the typography of your main text', 'crio' ),
			),
		),
	),
	'bgtfw_body_link_color'            => array(
		'type'              => 'bgtfw-palette-selector',
		'transport'         => 'postMessage',
		'settings'          => 'bgtfw_body_link_color',
		'label'             => esc_attr__( 'Link Color', 'crio' ),
		'section'           => 'bgtfw_body_link_design',
		'default'           => 'color-1',
		'choices'           => array(
			'selectors' => Boldgrid_Framework_Links::$default_link_selectors,
			'colors'    => $bgtfw_formatted_palette,
			'size'      => $bgtfw_palette->get_palette_size( $bgtfw_formatted_palette ),
		),
		'sanitize_callback' => array( $bgtfw_color_sanitize, 'sanitize_palette_selector' ),
		'edit_vars'         => array(
			array(
				'selector'    => Boldgrid_Framework_Links::$edit_link_selectors,
				'label'       => esc_attr__( 'Body Links', 'crio' ),
				'description' => esc_attr__( 'Customize the style of your body links.', 'crio' ),
			),
		),
	),
	'bgtfw_body_link_decoration'       => array(
		'settings'          => 'bgtfw_body_link_decoration',
		'transport'         => 'postMessage',
		'label'             => esc_html__( 'Text Style', 'crio' ),
		'type'              => 'radio-buttonset',
		'section'           => 'bgtfw_body_link_design',
		'default'           => 'underline',
		'choices'           => array(
			'none'      => '<span class="dashicons dashicons-editor-textcolor"></span>' . __( 'None', 'crio' ),
			'underline' => '<span class="dashicons dashicons-editor-underline"></span>' . __( 'Underline', 'crio' ),
		),
		'sanitize_callback' => function( $value, $settings ) {
			return in_array( $value, array( 'none', 'underline' ), true ) ? $value : $settings->default;
		},
	),
	'bgtfw_body_link_color_hover'      => array(
		'type'      => 'slider',
		'transport' => 'postMessage',
		'settings'  => 'bgtfw_body_link_color_hover',
		'label'     => esc_attr__( 'Hover Color Brightness', 'crio' ),
		'section'   => 'bgtfw_body_link_design',
		'default'   => 0,
		'choices'   => array(
			'min'  => '-25',
			'max'  => '25',
			'step' => '1',
		),
	),
	'bgtfw_body_link_decoration_hover' => array(
		'settings'          => 'bgtfw_body_link_decoration_hover',
		'transport'         => 'postMessage',
		'label'             => esc_html__( 'Hover Text Style', 'crio' ),
		'type'              => 'radio-buttonset',
		'section'           => 'bgtfw_body_link_design',
		'default'           => 'underline',
		'choices'           => array(
			'none'      => '<span class="dashicons dashicons-editor-textcolor"></span>' . __( 'None', 'crio' ),
			'underline' => '<span class="dashicons dashicons-editor-underline"></span>' . __( 'Underline', 'crio' ),
		),
		'sanitize_callback' => function( $value, $settings ) {
			return in_array( $value, array( 'none', 'underline' ), true ) ? $value : $settings->default;
		},
	),
);
