<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: code_editor
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'SP_WPCF_Field_code_editor' ) ) {
	class SP_WPCF_Field_code_editor extends SP_WPCF_Fields {

		/**
		 * Version
		 *
		 * @var string
		 */
		public $version = '5.41.0';
		/**
		 * Cdn_url
		 *
		 * @var string
		 */
		public $cdn_url = 'https://cdn.jsdelivr.net/npm/codemirror@';

		/**
		 * Code_editor field constructor.
		 *
		 * @param array  $field The field type.
		 * @param string $value The values of the field.
		 * @param string $unique The unique ID for the field.
		 * @param string $where To where show the output CSS.
		 * @param string $parent The parent args.
		 */
		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		/**
		 * Render field
		 *
		 * @return void
		 */
		public function render() {

			$default_settings = array(
				'tabSize'     => 2,
				'lineNumbers' => true,
				'theme'       => 'default',
				'mode'        => 'htmlmixed',
				'cdnURL'      => $this->cdn_url . $this->version,
			);

			$settings = ( ! empty( $this->field['settings'] ) ) ? $this->field['settings'] : array();
			$settings = wp_parse_args( $settings, $default_settings );
			$encoded  = htmlspecialchars( wp_json_encode( $settings ) );

			echo wp_kses_post( $this->field_before() );
			echo '<textarea name="' . esc_attr( $this->field_name() ) . '"' . $this->field_attributes() . ' data-editor="' . esc_attr( $encoded ) . '">' . wp_kses_post( $this->value ) . '</textarea>';// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo wp_kses_post( $this->field_after() );

		}

		/**
		 * Enqueue
		 *
		 * @return void
		 */
		public function enqueue() {

			// Do not loads CodeMirror in revslider page.
			if ( in_array( spf_get_var( 'page' ), array( 'revslider' ) ) ) {
				return; }

			if ( ! wp_script_is( 'spf-codemirror' ) ) {
				wp_enqueue_script( 'spf-codemirror', $this->cdn_url . $this->version . '/lib/codemirror.min.js', array( 'spf' ), $this->version, true );
				wp_enqueue_script( 'spf-codemirror-loadmode', $this->cdn_url . $this->version . '/addon/mode/loadmode.min.js', array( 'spf-codemirror' ), $this->version, true );
			}

			if ( ! wp_style_is( 'spf-codemirror' ) ) {
				wp_enqueue_style( 'spf-codemirror', $this->cdn_url . $this->version . '/lib/codemirror.min.css', array(), $this->version );
			}

		}

	}
}
