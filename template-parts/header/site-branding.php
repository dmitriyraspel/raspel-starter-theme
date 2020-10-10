<?php
/**
 * Displays header site branding
 *
 * @package Raspel
 * @since 1.0.0
 */
?>
<div class="site-branding">

<?php
	/* Show site logo ---------------------------------------------------- */
 	if ( has_custom_logo() ) : 
		the_custom_logo();
	endif; ?>

<?php
	/* Show site title ---------------------------------------------------- */
	$blog_info = get_bloginfo( 'name' );
	$site_logo_and_title = get_theme_mod ('site_logo_and_title');

	if ( ! empty( $blog_info ) && $site_logo_and_title ) : ?>
		<?php if ( is_front_page() && is_home() ) : ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php else : ?>
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		<?php endif;
	endif; ?>


<?php
	/* Show site description ---------------------------------------------------- */
	$description = get_bloginfo( 'description');
	$site_title_and_description = get_theme_mod ('site_title_and_description');

	if ( $description && $site_title_and_description ) : ?>
		<p class="site-description">
			<?php echo $description; ?>
		</p>
	<?php endif; ?>

</div><!-- .site-branding -->
