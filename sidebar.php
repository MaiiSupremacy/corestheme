<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CORES_Theme
 */

// If the sidebar-1 widget area is not active (has no widgets), do nothing.
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<!-- 
  This <aside> element will hold the widgets.
  We add some basic inline styles for spacing.
  You can move these to style.css if you plan to use the sidebar extensively.
-->
<aside id="secondary" class="widget-area" style="width: 300px; flex-shrink: 0; margin-left: 2rem;">
	<?php
	// This function renders all widgets added to the 'sidebar-1' widget area.
	dynamic_sidebar( 'sidebar-1' ); 
	?>
</aside><!-- #secondary -->