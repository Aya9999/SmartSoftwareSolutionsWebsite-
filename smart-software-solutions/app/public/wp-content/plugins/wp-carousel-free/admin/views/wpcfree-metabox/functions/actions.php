<?php
/**
 * Framework Actions
 *
 * @package WP Carousel
 * @subpackage wp-carousel-free/admin/views
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.


if ( ! function_exists( 'wpcf_get_option' ) ) {
	/**
	 * The wpcf_get_option function.
	 *
	 * @param string $option The option unique ID.
	 * @param mixed  $default The default value for the option.
	 * @return statement
	 */
	function wpcf_get_option( $option = '', $default = null ) {
		$options = get_option( 'sp_wpcp_settings' );
		return ( isset( $options[ $option ] ) ) ? $options[ $option ] : $default;
	}
}



if ( ! function_exists( 'spf_set_icons' ) ) {

	/**
	 *
	 * Set icons for wp dialog
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function spf_set_icons() {
		global $post_type;
		if ( 'sp_wp_carousel' === $post_type ) {
			?>
			<div id="spf-modal-icon" class="spf-modal spf-modal-icon">
				<div class="spf-modal-table">
				<div class="spf-modal-table-cell">
					<div class="spf-modal-overlay"></div>
					<div class="spf-modal-inner">
					<div class="spf-modal-title">
						<?php esc_html_e( 'Add Icon', 'wp-carousel-free' ); ?>
						<div class="spf-modal-close spf-icon-close"></div>
					</div>
					<div class="spf-modal-header spf-text-center">
						<input type="text" placeholder="<?php esc_html_e( 'Search a Icon...', 'wp-carousel-free' ); ?>" class="spf-icon-search" />
					</div>
					<div class="spf-modal-content">
						<div class="spf-modal-loading"><div class="spf-loading"></div></div>
						<div class="spf-modal-load"></div>
					</div>
					</div>
				</div>
				</div>
			</div>
			<?php
		}
	}
	add_action( 'admin_footer', 'spf_set_icons' );
	add_action( 'customize_controls_print_footer_scripts', 'spf_set_icons' );
}
