<?php
// phpcs:ignoreFile
/**
 * DO NOT EDIT THIS FILE! Instead customize it via a theme override.
 *
 * Any edit will not be saved when this plugin is upgraded. Not upgrading will prevent you from receiving new features,
 * limit our ability to support your site and potentially expose your site to security risk that an upgrade has fixed.
 *
 * Theme overrides are easy too, so there's no excuse...
 *
 * https://sproutinvoices.com/support/knowledgebase/sprout-invoices/customizing-templates/
 *
 * You find something that you're not able to customize? We want your experience to be awesome so let support know and we'll be able to help you.
 *
 * @package sa_templates
 */

do_action( 'pre_si_estimate_view' ); ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<html>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<?php echo apply_filters( 'document_title_parts', array('title') ); ?>
		<link rel="profile" href="http://gmpg.org/xfn/11" />

		<script type="text/javascript" src="<?php echo site_url() ?>/wp-includes/js/jquery/jquery.js"></script>
		<script type="text/javascript" src="<?php echo site_url() ?>/wp-includes/js/jquery/jquery-migrate.min.js"></script>

		<?php si_head( true ); ?>

		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700,900">
		<meta name="robots" content="noindex, nofollow" />
	</head>

	<body id="estimate" <?php body_class( 'si_basic_theme' ); ?>>
				<header class="row" id="header">
			<div class="inner">

				<div class="row messages">
					<?php si_display_messages(); ?>
				</div>

				<div class="row intro">

					<div id="logo">
						<?php if ( get_theme_mod( 'si_logo' ) ) : ?>
							<img src="<?php echo esc_url( get_theme_mod( 'si_logo', si_doc_header_logo_url() ) ); ?>" alt="document logo" >
						<?php else : ?>
							<img src="<?php echo esc_url( si_doc_header_logo_url() ) ?>" alt="document logo" >
						<?php endif; ?>
					</div><!-- #logo -->


					<div id="title">

						<div class="current_status">
							<?php if ( 'temp' === si_get_estimate_status() ) : ?>
								<span><?php esc_html_e( 'Not Yet Published', 'crio' ) ?></span>
							<?php elseif ( 'approved' === si_get_estimate_status() ) : ?>
								<span><?php esc_html_e( 'Approved', 'crio' ) ?></span>
							<?php else : ?>
								<span><?php esc_html_e( 'Pending Approval', 'crio' ) ?></span>
							<?php endif; ?>
						</div>

						<h1><?php the_title() ?></h1>

					</div><!-- #title -->

				</div>
			</div>
		</header>



		<section class="row" id="intro">
			<div class="inner">
				<div class="column">

					<h2><?php _e( 'From', 'crio' ) ?></h2>

					<h3><?php si_company_name() ?></h3>

					<?php si_doc_address() ?>

					<?php if ( si_get_company_phone() ) : ?>
						<div class="company_info"><?php printf( __( 'Phone: %1$s', 'crio' ), si_get_company_phone() ) ?></div>
					<?php endif ?>

					<?php if ( si_get_company_fax() ) : ?>
						<div class="company_info"><?php printf( __( 'Fax: %1$s', 'crio' ), si_get_company_fax() ) ?></div>
					<?php endif ?>

					<?php if ( si_get_company_email() ) : ?>
						<div class="company_info"><?php printf( __( '%1$s', 'crio' ), si_get_company_email() ); ?></div>
					<?php endif ?>

					<?php if ( si_get_estimate_client_id() ) :  ?>

						<h2 class="client_to"><?php _e( 'To', 'crio' ) ?></h2>

						<div id="client_info">

							<h3><?php echo get_the_title( si_get_estimate_client_id() ) ?></h3>

							<?php si_client_address( si_get_estimate_client_id() ) ?>

							<?php if ( si_get_client_phone() ) : ?>
								<div class="company_info"><?php printf( __( 'Phone: %1$s', 'crio' ), si_get_client_phone() ) ?></div>
							<?php endif ?>

							<?php if ( si_get_client_fax() ) : ?>
								<div class="company_info"><?php printf( __( 'Fax: %1$s', 'crio' ), si_get_client_fax() ) ?></div>
							<?php endif ?>

							<?php do_action( 'si_document_client_addy' ) ?>


						</div><!-- #client_info -->

					<?php endif ?>
					<?php do_action( 'si_document_vcards' ) ?>

				</div>

				<div class="column">

					<div class="invoice_info"><?php printf( '<span class="info">%1$s</span> %2$s', __( 'Invoice #', 'crio' ), si_get_estimate_id() ) ?></div>

					<?php if ( si_get_estimate_po_number() ) : ?>
						<div class="invoice_info"><?php printf( '<span class="info">%1$s</span> %2$s', __( 'PO #', 'crio' ), si_get_estimate_po_number() ) ?></div>
					<?php endif ?>

					<div class="invoice_info"><?php printf( '<span class="info">%1$s</span> %2$s', __( 'Issued on', 'crio' ), date_i18n( get_option( 'date_format' ), si_get_estimate_issue_date() ) ) ?></div>

					<div class="invoice_info"><?php printf( '<span class="info">%1$s</span> %2$s', __( 'Expires on', 'crio' ), date_i18n( get_option( 'date_format' ), si_get_estimate_expiration_date() ) ) ?></div>

					<div id="total_due" class="invoice_info"><?php printf( '<span class="info">%1$s</span> <span class="total">%2$s</span>', __( 'Total Estimated', 'crio' ), sa_get_formatted_money( si_get_estimate_total() ) ) ?></div>

				</div>

			</div>
		</section>

		<section class="row" id="details">
			<div class="inner">
				<div class="row item">
					<?php do_action( 'si_document_more_details' ) ?>
				</div>
			</div>
		</section>

		<?php do_action( 'si_doc_line_items', get_the_id() ) ?>

		<section class="row" id="signature">
			<div class="inner">
				<div class="row item">
					<?php do_action( 'si_signature_section' ) ?>
				</div>
			</div>
		</section>


		<section class="row" id="notes">
			<div class="inner">
				<?php if ( strlen( si_get_estimate_notes() ) > 1 ) : ?>
					<div class="row title">
						<h2><?php esc_html_e( 'Info &amp; Notes', 'crio' ) ?></h2>
					</div>
					<div class="row content">
						<?php si_estimate_notes() ?>
					</div>
				<?php endif ?>

				<?php if ( strlen( si_get_estimate_terms() ) > 1 ) : ?>

					<div class="row title">
						<h2><?php esc_html_e( 'Terms &amp; Conditions', 'crio' ) ?></h2>
					</div>
					<div class="row content">
						<?php si_estimate_terms() ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="inner">
				<div class="row item">
					<div class="history_message">
						<?php if ( $last_updated = si_doc_last_updated() ) :  ?>
							<?php $days_since = si_get_days_ago( $last_updated ); ?>
							<?php if ( 2 > $days_since ) :  ?>
								<a class="open" href="#history"><?php printf( __( 'Recently Updated', 'crio' ), $days_since ) ?></a>
							<?php else : ?>
								<a class="open" href="#history"><?php printf( __( 'Updated %1$s Days Ago', 'crio' ), $days_since ) ?></a>
							<?php endif ?>
						<?php endif ?>
					</div>
				</div>
			</div>

		</section>

		<section class="row" id="paybar">
			<div class="inner">
				<?php
					$time_left = si_get_estimate_expiration_date() - current_time( 'timestamp' );
					$days_left = round( (($time_left / 24) / 60) / 60 );
						?>
				<?php if ( $time_left > 0 ) :  ?>

					<?php printf( __( 'Estimate expires in <strong>%1$s Days</strong>', 'crio' ), $days_left ); ?>

					<?php if ( si_is_estimate_declined() ) : ?>
						<a class="decline_estimate" href="javascript:void(0)"><?php _e( 'Estimate Declined', 'crio' ) ?></a>
					<?php else : ?>
						<a href="#decline" class="decline_estimate status_change" data-status-change="decline" data-id="<?php the_ID() ?>" data-nonce="<?php esc_attr_e( wp_create_nonce( SI_Controller::NONCE ), 'crio' ) ?>"><?php esc_html_e( 'Decline Estimate', 'crio' ) ?></a>
					<?php endif ?>

					<?php if ( si_is_estimate_approved() ) : ?>
						<a class="button accept_estimate" href="javascript:void(0)"><?php _e( 'Estimate Approved', 'crio' ) ?></a>
					<?php else : ?>
						<a href="#accept" class="button accept_estimate status_change" data-status-change="accept" data-id="<?php the_ID() ?>" data-nonce="<?php esc_attr_e( wp_create_nonce( SI_Controller::NONCE ), 'crio' ) ?>"><?php esc_html_e( 'Accept Estimate', 'crio' ) ?></a>
					<?php endif ?>

					<?php do_action( 'si_signature_button' ) ?>

				<?php else : ?>
					<a class="button" href="javascript:void(0)"><?php _e( 'Estimate is Expired', 'crio' ) ?></a>
				<?php endif ?>

				<?php do_action( 'si_pdf_button' ) ?>

			</div>
		</section>

		<?php if ( apply_filters( 'si_show_estimate_history', true ) ) : ?>
			 <section class="panel closed" id="history">
				<a class="close" href="#history">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
					<path d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"/>
				</svg>
				</a>

				<div class="inner">
					<h2><?php _e( 'Estimate History', 'crio' ) ?></h2>
					<div class="history">
						<?php foreach ( si_doc_history_records() as $item_id => $data ) : ?>
							<?php $days_since = (int) si_get_days_ago( strtotime( $data['post_date'] ) ); ?>
							<article class=" <?php echo esc_attr( $data['status_type'] ); ?>">
								<span class="posted">
									<?php
										$type = ( 'comment' === $data['status_type'] ) ? sprintf( __( 'Comment by %s ', 'crio' ), $data['type'] ) : $data['type'] ;
											?>
									<?php if ( 0 === $days_since ) :  ?>
										<?php printf( '%1$s today', $type ) ?>
									<?php elseif ( 2 > $days_since ) :  ?>
										<?php printf( '%1$s %2$s day ago', $type, $days_since ) ?>
									<?php else : ?>
										<?php printf( '%1$s %2$s days ago', $type, $days_since ) ?>
									<?php endif ?>
								</span>

								<?php if ( SI_Notifications::RECORD === $data['status_type'] ) : ?>
									<p>
										<?php echo esc_html( $update_title ) ?>
									</p>
								<?php elseif ( SI_Invoices::VIEWED_STATUS_UPDATE === $data['status_type'] ) : ?>
									<p>
										<?php echo $data['update_title']; ?>
									</p>
								<?php else : ?>
									<?php echo wpautop( $data['content'] ) ?>
								<?php endif ?>
							</article>
						<?php endforeach ?>
					</div>
				</div>
			</section>
		<?php endif ?>

		<div id="footer_credit">
			<?php do_action( 'si_document_footer_credit' ) ?>
			<!--<p><?php esc_html_e( 'Powered by Sprout Invoices', 'crio' ) ?></p>-->
		</div><!-- #footer_messaging -->
	<?php wp_footer(); ?>

	</body>
	<?php do_action( 'si_document_footer' ) ?>
	<?php si_footer() ?>

	<?php printf( '<!-- Template Version v%s -->', Sprout_Invoices::SI_VERSION ); ?>

</html>
<?php do_action( 'estimate_viewed' ) ?>