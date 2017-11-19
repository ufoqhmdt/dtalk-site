<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.themepunch.com
 * @since      1.0.0
 *
 * @package    Revslider_Sharing_Addon
 * @subpackage Revslider_Sharing_Addon/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div id="revslider_sharing_addon_settings_slideout" class="rs-sbs-slideout-wrapper" style="display:none">
	<div class="rs-sbs-header">
		<div class="rs-sbs-step"><i class="eg-icon-cog"></i></div>
		<div class="rs-sbs-title"><?php _e('How To use the Sharing', 'revslider-sharing-addon'); ?></div>
		<div class="rs-sbs-close"><i class="eg-icon-cancel"></i></div>
	</div>
	<div class="tp-clearfix"></div>
	<div class="rs-sbs-slideout-inner">
	<!-- Start Settings -->
		<h3 class="tp-steps wb"><span>1</span> <?php _e('Add "Sharing" click action to layer','revslider-sharing-addon'); ?></h3>
		<img src="<?php echo REV_ADDON_SHARING_URL . "admin/images/tutorial1.jpg"; ?>">
		<div class="wb-featuretext"><?php _e('Select your layer, add an action with the plus button, then select the wanted sharing action.','revslider-sharing-addon'); ?></div>

		<h3 class="tp-steps wb"><span>2</span> <?php _e('Select sharing URL','revslider-sharing-addon'); ?></h3>
		<img src="<?php echo REV_ADDON_SHARING_URL . "admin/images/tutorial2.jpg"; ?>">
		<div class="wb-featuretext"><?php _e('Select the placeholder for the URL you want to share or fill in a custom URL.','revslider-sharing-addon'); ?></div>

		<h3 class="tp-steps wb"><span>3</span> <?php _e('Fill out sharing defaults','revslider-sharing-addon'); ?></h3>
		<img src="<?php echo REV_ADDON_SHARING_URL . "admin/images/tutorial3.jpg"; ?>">
		<div class="wb-featuretext"><?php _e('Fill the defaults for the sharing options with help of placeholders(no placeholders for gallery sliders). The options differ for sharing services and slider sources.'); ?></div>
	<!-- End Settings -->
	</div>
</div>