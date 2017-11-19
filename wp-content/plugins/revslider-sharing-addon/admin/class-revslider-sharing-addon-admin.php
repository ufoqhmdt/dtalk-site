<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.themepunch.com
 * @since      1.0.0
 *
 * @package    Revslider_Sharing_Addon
 * @subpackage Revslider_Sharing_Addon/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Revslider_Sharing_Addon
 * @subpackage Revslider_Sharing_Addon/admin
 * @author     ThemePunch <info@themepunch.com>
 */
class Revslider_Sharing_Addon_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Revslider_Sharing_Addon_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Revslider_Sharing_Addon_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if(isset($_GET["page"]) && in_array($_GET["page"], array("rev_addon","revslider") ) ){ 
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/revslider-sharing-addon-admin.css', array(), $this->version, 'all' );
		}

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @version  1.1.1
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Revslider_Sharing_Addon_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Revslider_Sharing_Addon_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if(isset($_GET["page"]) && $_GET["page"]=="revslider" ){ 
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/revslider-sharing-addon-admin.js', array( 'jquery' ), $this->version, false );
		}
		elseif (isset($_GET["page"]) && $_GET["page"]=="rev_addon"){
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/revslider-sharing-addon-admin-configure.js', array( 'jquery' ), $this->version, false );
			wp_localize_script( $this->plugin_name, 'revslider_sharing_addon', array(
				'ajax_url' => admin_url( 'admin-ajax.php' )
			));
		}
	}

	/**
	 * Add Sharing Options to Actions selectbox in Backend
	 *
	 * @since    1.0.0
	 */
	public function rs_action_add_layer_actions (){
		echo '<option disabled></option>';
		echo '<option disabled>---- '.__("Social Sharing",'revslider-sharing-addon').' ----</option>';
		echo '<option <# if( data[\'action\'] == \'share_facebook\' ){ #>selected="selected" <# } #> value="share_facebook">'.__("Share on Facebook",'revslider-sharing-addon').'</option>';
		echo '<option <# if( data[\'action\'] == \'share_twitter\' ){ #>selected="selected" <# } #> value="share_twitter">'.__("Share on Twitter",'revslider-sharing-addon').'</option>';
		echo '<option <# if( data[\'action\'] == \'share_pinterest\' ){ #>selected="selected" <# } #> value="share_pinterest">'.__("Share on Pinterest",'revslider-sharing-addon').'</option>';
		echo '<option <# if( data[\'action\'] == \'share_linkedin\' ){ #>selected="selected" <# } #> value="share_linkedin">'.__("Share on LinkedIn",'revslider-sharing-addon').'</option>';
		echo '<option <# if( data[\'action\'] == \'share_googleplus\' ){ #>selected="selected" <# } #> value="share_googleplus">'.__("Share on Google Plus",'revslider-sharing-addon').'</option>';
		//echo '<option <# if( data[\'action\'] == \'share_email\' ){ #>selected="selected" <# } #> value="share_email">'.__("Share on Email",'revslider-sharing-addon').'</option>';
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
		$rev_slider_addon_values = get_option('revslider_sharing_addon_sizes');
		$rev_slider_addon_values = unserialize($rev_slider_addon_values);
		include_once( 'partials/revslider-sharing-addon-admin-display.php' );
	}

	/**
	 * Saves Values for this Add-On
	 *
	 * @since    1.0.0
	 */
	public function save_sharing() {
		// Verify that the incoming request is coming with the security nonce
		if( wp_verify_nonce( $_REQUEST['nonce'], 'ajax_revslider_sharing_addon_nonce' ) ) {
			$revslider_sharing_addon_sizes = array();
			if(isset($_REQUEST['revslider_sharing_addon_facebook_width'])){
				$revslider_sharing_addon_sizes["revslider-sharing-addon-facebook-width"] 	= sanitize_text_field( $_REQUEST['revslider_sharing_addon_facebook_width'] );
				$revslider_sharing_addon_sizes["revslider-sharing-addon-facebook-height"] 	= sanitize_text_field($_REQUEST['revslider_sharing_addon_facebook_height'] );
				$revslider_sharing_addon_sizes["revslider-sharing-addon-twitter-width"] 	= sanitize_text_field($_REQUEST['revslider_sharing_addon_twitter_width'] );
				$revslider_sharing_addon_sizes["revslider-sharing-addon-twitter-height"] 	= sanitize_text_field($_REQUEST['revslider_sharing_addon_twitter_height'] );
				$revslider_sharing_addon_sizes["revslider-sharing-addon-pinterest-width"] 	= sanitize_text_field($_REQUEST['revslider_sharing_addon_pinterest_width'] );
				$revslider_sharing_addon_sizes["revslider-sharing-addon-pinterest-height"] 	= sanitize_text_field($_REQUEST['revslider_sharing_addon_pinterest_height'] );
				$revslider_sharing_addon_sizes["revslider-sharing-addon-linkedin-width"] 	= sanitize_text_field($_REQUEST['revslider_sharing_addon_linkedin_width'] );
				$revslider_sharing_addon_sizes["revslider-sharing-addon-linkedin-height"] 	= sanitize_text_field($_REQUEST['revslider_sharing_addon_linkedin_height'] );
				$revslider_sharing_addon_sizes["revslider-sharing-addon-googleplus-width"] 	= sanitize_text_field($_REQUEST['revslider_sharing_addon_googleplus_width'] );
				$revslider_sharing_addon_sizes["revslider-sharing-addon-googleplus-height"] = sanitize_text_field($_REQUEST['revslider_sharing_addon_googleplus_height'] );

				update_option( 'revslider_sharing_addon_sizes', serialize($revslider_sharing_addon_sizes) );

				die( '1' );
			}
			else{
				die( '0' );
			}
		} 
		else {
			die( '-1' );
		}
	}

	/**
	 * Add Detial Options to Actions
	 *
	 * @since    1.0.0
	 */
	public function rs_action_add_layer_actions_details ($slider){?>
		<?php $slider_type_nogal = $slider->getParam("source_type","gallery") == "gallery" ? false : true ; ?>
		<!-- Facebook Fields -->
		<span class="action-facebookfields" <# if( data['action'] != 'share_facebook' ){ #> style="margin-right:10px;display: none; white-space:nowrap" <# } #>>
			<!--<span><?php _e("Link Url",'revslider-sharing-addon'); ?></span>
			<span class="rs-layer-toolbar-space"></span>-->
			<input type="text" placeholder="<?php _e("Link Url",'revslider-sharing-addon'); ?>" class="input-deepselects text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php _e("Select the Source you want to share",'revslider'); ?>" style="width:150px"  name="<# if(data['edit'] == false){ #>no_<# } #>facebook_link[]" value="{{ data['facebook_link'] }}" data-deepwidth="125" data-selects="Parent Site<?php if ($slider_type_nogal) { ?>||Post URL<?php } ?>||No URL" data-svalues ="%site_url%<?php if ($slider_type_nogal) { ?>||%post_url%<?php } ?>||" 		data-icons="link<?php if ($slider_type_nogal) { ?>||doc<?php } ?>||minus">
		</span>
		<!-- Twitter Fields -->
		<span class="action-twitterfields" <# if( data['action'] != 'share_twitter' ){ #> style="display: none; white-space:nowrap" <# } #>>
			<!--<span><?php _e("Link Url",'revslider-sharing-addon'); ?></span>
			<span class="rs-layer-toolbar-space"></span>-->
			<input type="text" placeholder="<?php _e("Link Url",'revslider-sharing-addon'); ?>" class="input-deepselects text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php _e("Select the Source you want to share",'revslider'); ?>" style="width:150px;margin-right:10px" name="<# if(data['edit'] == false){ #>no_<# } #>twitter_link[]" value="{{ data['twitter_link'] }}" data-deepwidth="125" data-selects="Parent Site<?php if ($slider_type_nogal) { ?>||Post URL<?php } ?>||No URL" data-svalues ="%site_url%<?php if ($slider_type_nogal) { ?>||%post_url%<?php } ?>||" data-icons="link<?php if ($slider_type_nogal) { ?>||doc<?php } ?>||minus">
			<span class="twitter_link_details">
				<!--<span><?php _e("Text",'revslider-sharing-addon'); ?></span>
				<span class="rs-layer-toolbar-space" ></span>-->
				<span class="revslider_sharing_metaduo">
					<textarea style="width:250px;margin-right:10px; padding:0px 5px;resize:horizontal" placeholder="<?php _e("Text",'revslider-sharing-addon'); ?>" class="twitter_text revslider_dialog_input <# if(data['edit'] == false){ #>rs_disabled_field <# } #>textbox-caption rs-layer-input-field" name="<# if(data['edit'] == false){ #>no_<# } #>twitter_text[]">{{ data['twitter_text'] }}</textarea>
					<?php if ($slider_type_nogal) { ?>
					<span class="revslider-sharing-addon-meta">
						<i class="eg-icon-filter"></i>
					</span>
					<?php  } ?>
				</span>
			</span>
		</span>
		<!-- Google Plus Fields -->
		<span class="action-googleplusfields" <# if( data['action'] != 'share_googleplus' ){ #> style="display: none; white-space:nowrap" <# } #>>
			<!--<span><?php _e("Link Url",'revslider-sharing-addon'); ?></span>
			<span class="rs-layer-toolbar-space"></span>-->
			<input type="text" placeholder="<?php _e("Link Url",'revslider-sharing-addon'); ?>" class="input-deepselects text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php _e("Select the Source you want to share",'revslider'); ?>" style="width:150px;margin-right:10px;" name="<# if(data['edit'] == false){ #>no_<# } #>googleplus_link[]" value="{{ data['googleplus_link'] }}" data-deepwidth="125" data-selects="Parent Site<?php if ($slider_type_nogal) { ?>||Post URL<?php } ?>||No URL" data-svalues ="%site_url%||%post_url%||" data-icons="link<?php if ($slider_type_nogal) { ?>||doc<?php } ?>||minus">
		</span>
		<!-- LinkedIn Fields -->
		<span class="action-linkedinfields" <# if( data['action'] != 'share_linkedin' ){ #> style="display: none; white-space:nowrap" <# } #>>
			<!--<span><?php _e("Link Url",'revslider-sharing-addon'); ?></span>
			<span class="rs-layer-toolbar-space"></span>-->
			<input type="text" placeholder="<?php _e("Link Url",'revslider-sharing-addon'); ?>" class="input-deepselects text-sidebar rs-layer-input-field tipsy_enabled_top linkedin_source" title="<?php _e("Select the Source you want to share",'revslider'); ?>" style="width:150px;margin-right:10px" name="<# if(data['edit'] == false){ #>no_<# } #>linkedin_link[]" value="{{ data['linkedin_link'] }}" data-deepwidth="125" data-selects="Parent Site<?php if ($slider_type_nogal) { ?>||Post URL<?php } ?>||No URL" data-svalues ="%site_url%<?php if ($slider_type_nogal) { ?>||%post_url%<?php } ?>||" data-icons="link<?php if ($slider_type_nogal) { ?>||doc<?php } ?>||minus">
			<span class="linkedin_link_details" <# if( data['linkedin_link'] == 'post' ){ #> style="display: none; white-space:nowrap" <# } #>>
				
				<span class="revslider_sharing_metaduo" style="white-space:nowrap;">
					<!--<span><?php _e("Title",'revslider-sharing-addon'); ?></span>
					<span class="rs-layer-toolbar-space"></span>-->
					<input type="text" placeholder="<?php _e("Title",'revslider-sharing-addon'); ?>" style="width:150px;margin-right:10px;" class="<# if(data['edit'] == false){ #>rs_disabled_field <# } #>textbox-caption revslider_dialog_input rs-layer-input-field linkedin_link_title" name="<# if(data['edit'] == false){ #>no_<# } #>linkedin_link_title[]" value="{{ data['linkedin_link_title'] }}">
					<?php if ($slider_type_nogal) { ?>
					<span class="revslider-sharing-addon-meta">
						<i class="eg-icon-filter"></i>
					</span>
					<?php  } ?>
				</span>
			</span>
			
			<span class="revslider_sharing_metaduo" style="white-space: nowrap;">
				<!--<span><?php _e("Summary",'revslider-sharing-addon'); ?></span>
				<span class="rs-layer-toolbar-space"></span>-->
				<textarea placeholder="<?php _e("Summary",'revslider-sharing-addon'); ?>" style="width:250px;resize:horizontal;margin-right: 10px" class="<# if(data['edit'] == false){ #>rs_disabled_field <# } #>textbox-caption revslider_dialog_input rs-layer-input-field linkedin_link_summary" name="<# if(data['edit'] == false){ #>no_<# } #>linkedin_link_summary[]">{{ data['linkedin_link_summary'] }}</textarea>
				<?php if ($slider_type_nogal) { ?>
					<span class="revslider-sharing-addon-meta">
						<i class="eg-icon-filter"></i>
					</span>
				<?php  } ?>
			</span>
		</span>
		<!-- Pinterest Fields -->
		<span class="action-pinterestfields" <# if( data['action'] != 'share_pinterest' ){ #> style="display: none; white-space:nowrap" <# } #>>
			<!--<span><?php _e("Link Url",'revslider-sharing-addon'); ?></span>
			<span class="rs-layer-toolbar-space"></span>-->
			<input type="text" placeholder="<?php _e("Link Url",'revslider-sharing-addon'); ?>" class="input-deepselects text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php _e("Select the Source you want to share",'revslider'); ?>" style="width:150px;margin-right:10px" name="<# if(data['edit'] == false){ #>no_<# } #>pinterest_link[]" value="{{ data['pinterest_link'] }}" data-deepwidth="125" data-selects="Parent Site<?php if ($slider_type_nogal) { ?>||Post URL<?php } ?>||No URL" data-svalues ="%site_url%<?php if ($slider_type_nogal) { ?>||%post_url%<?php } ?>||" data-icons="link<?php if ($slider_type_nogal) { ?>||doc<?php } ?>||minus">
			
			<!--<span><?php _e("Image",'revslider-sharing-addon'); ?></span>
			<span class="rs-layer-toolbar-space"></span>-->
			<input type="text" placeholder="<?php _e("Image",'revslider-sharing-addon'); ?>" class="input-deepselects text-sidebar rs-layer-input-field tipsy_enabled_top" title="<?php _e("Select the Source you want to share",'revslider'); ?>" style="width:150px;margin-right:10px" name="<# if(data['edit'] == false){ #>no_<# } #>pinterest_image[]" value="{{ data['pinterest_image'] }}" data-deepwidth="175" data-selects="Slide Background||Custom Image URL" data-svalues ="%background_image%||" data-icons="picture||minus">
			
			<span class="pinterest_link_details" style="white-space:nowrap">
				<!--<span><?php _e("Description",'revslider-sharing-addon'); ?></span>
				<span class="rs-layer-toolbar-space"></span>-->
				<span class="revslider_sharing_metaduo">
					<textarea style="width:250px;resize:horizontal;margin-right:10px;" placeholder="<?php _e("Description",'revslider-sharing-addon'); ?>" class="<# if(data['edit'] == false){ #>rs_disabled_field <# } #>textbox-caption revslider_dialog_input rs-layer-input-field" name="<# if(data['edit'] == false){ #>no_<# } #>pinterest_link_description[]">{{ data['pinterest_link_description'] }}</textarea>
					<?php if ($slider_type_nogal) { ?>
					<span class="revslider-sharing-addon-meta">
						<i class="eg-icon-filter"></i>
					</span>
					<?php  } ?>
				</span>
			</span>
		</span>
		<#			
			tpLayerTimelinesRev.deepSelection(true);		
		#>
		<?php
	}
}
