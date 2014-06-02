<?php
/**
 * The template for displaying the footer
 *
 * @package rtPanel
 *
 * @since rtPanel 2.0
 */
global $rtp_general;

                    rtp_hook_end_content_row(); ?>

                </div> <!-- End of content-wrapper row -->

                <?php rtp_hook_end_content_wrapper(); ?>

            </div><!-- #content-wrapper -->

            <?php rtp_hook_after_content_wrapper(); ?>

            <?php rtp_hook_before_footer(); ?>

            <footer id="footer-wrapper" role="contentinfo" class="clearfix rtp-footer-wrapper rtp-section-wrapper">

                <?php rtp_hook_begin_footer(); ?>

                <?php
                /* Grid class for widget */
                $rtp_footer_widget_grid_class = apply_filters( 'rtp_set_footer_widget_grid_class', 'large-4 columns' ); ?>
				<?php if ( $rtp_general['first_footer_sidebar'] || $rtp_general['second_footer_sidebar'] || $rtp_general['third_footer_sidebar'] ) { ?>
					<div class="rtp-footer-wrapper-outer">
						<div class="rtp-footer-main rtp-section-container">
						<?php if ( $rtp_general['first_footer_sidebar'] ) { ?>
							<aside class="rtp-footerbar rtp-first-footerbar">
								<?php if ( !dynamic_sidebar( 'first-footer-widgets' ) && is_active_sidebar( 'first-footer-widgets' )  ) { 
									echo dynamic_sidebar( 'first-footer-widgets' ); 
								} ?>
							</aside><!-- #first-footerbar -->
						<?php } ?>
						<?php if ( $rtp_general['second_footer_sidebar'] ) { ?>
							<aside class="rtp-footerbar rtp-second-footerbar">
								<?php if ( !dynamic_sidebar( 'second-footer-widgets' ) && is_active_sidebar( 'second-footer-widgets' ) ) { 
									echo dynamic_sidebar( 'second-footer-widgets' ); 
								} ?>
							</aside><!-- #second-footerbar -->
						<?php } ?>
						<?php if ( $rtp_general['third_footer_sidebar'] ) { ?>
						<aside class="rtp-footerbar rtp-third-footerbar">
							<?php if ( !dynamic_sidebar( 'third-footer-widgets' ) && is_active_sidebar( 'third-footer-widgets' ) ) { 
									echo dynamic_sidebar( 'third-footer-widgets' ); 
								} ?>
						</aside><!-- #third-footerbar -->
						<?php } ?>
						</div>
					</div>
				<?php } ?>
                
                <?php rtp_hook_end_footer(); ?>
				<?php if ( $rtp_general['footer_sidebar'] ) { ?>
				<div class="footer-bottom">
					<aside role="complementary" id="rtp-footer-widgets-wrapper" class="rtp-footerbar rtp-section-container row"><?php
						// Default Widgets ( Fallback )
						if ( !dynamic_sidebar( 'footer-widgets' ) ) { ?>
							<div class="widget footerbar-widget <?php echo esc_attr($rtp_footer_widget_grid_class); ?>"><h3 class="widgettitle"><?php _e( 'Archives', 'rtPanel' ); ?></h3><ul><?php wp_get_archives( array( 'type' => 'monthly' ) ); ?></ul></div>
							<div class="widget footerbar-widget <?php echo esc_attr($rtp_footer_widget_grid_class); ?>"><h3 class="widgettitle"><?php _e( 'Tags', 'rtPanel' ); ?></h3><div class="tagcloud"><?php wp_tag_cloud(); ?></div></div>
							<div class="widget footerbar-widget <?php echo esc_attr($rtp_footer_widget_grid_class); ?>"><h3 class="widgettitle"><?php _e( 'Meta', 'rtPanel' ); ?></h3><ul><?php wp_register(); ?><li><?php wp_loginout(); ?></li><?php wp_meta(); ?></ul></div><?php
						} ?>
					</aside><!-- #footerbar -->
				</div><?php
				} ?>
            </footer><!-- #footer-wrapper-->
		

            <?php rtp_hook_after_footer(); ?>

            <?php rtp_hook_end_main_wrapper(); ?>

        </div><!-- #main-wrapper -->

        <?php wp_footer(); ?>
    </body>
</html>