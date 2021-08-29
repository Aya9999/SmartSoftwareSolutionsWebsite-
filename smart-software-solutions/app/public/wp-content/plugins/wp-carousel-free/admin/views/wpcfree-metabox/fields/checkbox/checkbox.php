<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: checkbox
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'SP_WPCF_Field_checkbox' ) ) {
	class SP_WPCF_Field_checkbox extends SP_WPCF_Fields {

		/**
		 * Checkbox field constructor.
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
			$args = wp_parse_args(
				$this->field,
				array(
					'inline' => false,
				)
			);

			$inline_class = ( $args['inline'] ) ? ' class="spf--inline-list"' : '';

			echo wp_kses_post( $this->field_before() );

			if ( ! empty( $this->field['options'] ) ) {

				$value   = ( is_array( $this->value ) ) ? $this->value : array_filter( (array) $this->value );
				$options = $this->field['options'];
				$options = ( is_array( $options ) ) ? $options : array_filter( $this->field_data( $options ) );

				if ( ! empty( $options ) ) {
					echo ( $args['inline'] ) ? '<ul class="spf--inline-list">' : '<ul>';
					foreach ( $options as $option_key => $option_value ) {
						$checked = ( in_array( $option_key, $value ) ) ? ' checked' : '';
						echo wp_kses_post( '<li><label><input type="checkbox" name="' . $this->field_name( '[]' ) . '" value="' . $option_key . '"' . $this->field_attributes() . $checked . '/> ' . $option_value . '</label></li>' );
					}
					echo '</ul>';

				} else {
					echo ! empty( $this->field['empty_message'] ) ? esc_html( $this->field['empty_message'] ) : esc_html__( 'No data provided for this option type.', 'wp-carousel-free' );
				}
			} else {
				echo '<label class="spf-checkbox">';
				echo '<input type="hidden" name="' . esc_attr( $this->field_name() ) . '" value="' . esc_attr( $this->value ) . '" class="spf--input"' . $this->field_attributes() . '/>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo '<input type="checkbox" class="spf--checkbox"' . esc_attr( checked( $this->value, 1, false ) ) . '/>';
				echo ( ! empty( $this->field['label'] ) ) ? ' ' . esc_html( $this->field['label'] ) : '';
				echo '</label>';
			}

			echo wp_kses_post( $this->field_after() );

		}

	}
}
