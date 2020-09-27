<?php
/**
 * Displays header site branding
 *
 * @package Raspel
 * @since 1.0.0
 */
?>
<div class="site-branding">

	<?php if ( has_custom_logo() ) : ?>
		<div class="site-logo"><?php the_custom_logo(); ?></div>
	<?php else : 
				if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php 
				endif;
			endif; ?>

	<?php
	$description = get_bloginfo( 'description', 'display' );
	if ( $description || is_customize_preview() ) :
	?>
			<p class="site-description">
				<?php echo $description; ?>
			</p>
	<?php endif; ?>
</div><!-- .site-branding -->
