<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: radio
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'SP_WPCF_Field_radio' ) ) {
	class SP_WPCF_Field_radio extends SP_WPCF_Fields {

		/**
		 * Radio field constructor.
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

			if ( isset( $this->field['options'] ) ) {

				$options = $this->field['options'];
				$options = ( is_array( $options ) ) ? $options : array_filter( $this->field_data( $options ) );

				if ( ! empty( $options ) ) {

					echo '<ul' . $inline_class . '>';
					foreach ( $options as $option_key => $option_value ) {
						$checked = ( $option_key === $this->value ) ? ' checked' : '';
						echo '<li><label><input type="radio" name="' . esc_attr( $this->field_name() ) . '" value="' . esc_attr( $option_key ) . '"' . $this->field_attributes() . $checked . '/> ' . esc_html( $option_value ) . '</label></li>';// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
					echo '</ul>';

				} else {

					echo ! empty( $this->field['empty_message'] ) ? wp_kses_post( $this->field['empty_message'] ) : esc_html__( 'No data provided for this option type.', 'wp-carousel-free' );
				}
			} else {
					$label = ( isset( $this->field['label'] ) ) ? $this->field['label'] : '';
					echo '<label><input type="radio" name="' . esc_attr( $this->field_name() ) . '" value="1"' . $this->field_attributes() . checked( $this->value, 1, false ) . '/> ' . esc_html( $label ) . '</label>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			echo wp_kses_post( $this->field_after() );

		}

	}
}
