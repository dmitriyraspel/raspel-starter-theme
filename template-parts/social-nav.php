<?php
/**
 * Displays Social menu
 *
 * @package my_first_theme_for-block
 */

?>
   <nav class="social-navigation reset-list-style" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'raspellab' ); ?>">
      <?php
      wp_nav_menu(
         array(
            'theme_location' => 'social',
            'link_before'    => '<span class="screen-reader-text">',
            'link_after'     => '</span>' . raspellab_get_icon_svg( 'link' ),
            'depth'          => 1,
            'container'       => '',
            )
      );
      ?>
   </nav><!-- .social-navigation -->