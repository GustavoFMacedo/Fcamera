<?php

/**
 * Advertise
 *
 * @package Revista
 */

function revista_advertise_block($revista_home_section, $repeat_times)
{

	$advertise_image = esc_html(isset($revista_home_section->advertise_image) ? $revista_home_section->advertise_image : '');
	$advertise_link = esc_html(isset($revista_home_section->advertise_link) ? $revista_home_section->advertise_link : '');
	if ($advertise_image) {
?>
		<div id="theme-block-<?php echo esc_attr($repeat_times); ?>" class="theme-block theme-block-ava">
			<div class="wrapper">
				<div class="wrapper-inner">
					<div class="column column-12">
						<a href="<?php echo esc_url($advertise_link); ?>" target="_blank" class="home-lead-link">
							<img src="<?php echo esc_url($advertise_image); ?>" alt="<?php esc_attr_e('Advertise Image', 'revista'); ?>">
						</a>
					</div>
				</div>
			</div>
		</div>

<?php
	}
} ?>