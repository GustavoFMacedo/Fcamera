<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Revista
 */

if (!is_active_sidebar('sidebar-1')) {
	return;
} ?>

<aside id="secondary" class="widget-area">
	<div class="theme-aside-content theme-make-sticky">
		<?php dynamic_sidebar('sidebar-1'); ?>
	</div>
</aside><!-- #secondary -->