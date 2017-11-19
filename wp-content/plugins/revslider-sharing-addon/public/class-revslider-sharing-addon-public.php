<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.themepunch.com
 * @since      1.0.0
 *
 * @package    Revslider_Sharing_Addon
 * @subpackage Revslider_Sharing_Addon/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Revslider_Sharing_Addon
 * @subpackage Revslider_Sharing_Addon/public
 * @author     ThemePunch <info@themepunch.com>
 */
class Revslider_Sharing_Addon_Public {

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

	private $slide;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/revslider-sharing-addon-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/revslider-sharing-addon-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'revslider_sharing_addon', array(
				'revslider_sharing_addon_sizes' => unserialize(get_option('revslider_sharing_addon_sizes')),
				'ajax_url' => admin_url( 'admin-ajax.php' )
			) );

	}

	/**
	 * Add Sharing Actions in Output
	 *
	 * @since    1.0.0
	 */
	public function rs_action_output_layer_simple_link( $html_simple_link="", $action, $all_actions, $num, $slide="", $slider, $a_events=""){
		$caller_url = plugin_dir_url( __FILE__ ).'revslider-sharing-addon-call.php';
		$slide_id = $slide->getID();
		$source = $slider->getParam("source_type");
		$url = $source == "post" ? urlencode(get_permalink($slide_id)) : $slide_id;

		 switch ($action) {
			case 'share_twitter':
				// Get Values
				$a_sharetext = RevSliderFunctions::cleanStdClassToArray(RevSliderFunctions::getVal($all_actions, 'twitter_text', array()));
				$a_sharelink = RevSliderFunctions::cleanStdClassToArray(RevSliderFunctions::getVal($all_actions, 'twitter_link', array()));

				// Attach link to text
				switch ($a_sharelink[$num]) {
					case '%site_url%':
						$sharelink = $this->curPageURL();
						break;
					case '%post_url%':
						//$a_sharetext[$num] = $a_sharetext[$num]."tp_revslider_sharing_get_the_title"; //get_the_title( $slide->getID() );
						$sharelink = "tp_revslider_sharing_get_permalink";//get_permalink($slide->getID());
						break;
					default:
						$sharelink = $a_sharelink[$num];
						break;
				}
				$sharetext = empty($a_sharetext[$num]) ? $sharelink : $a_sharetext[$num].' '.$sharelink;
				$html_simple_link = 'target="_blank" href="'.$caller_url.'?tpurl='.$url.'&share=
				https://twitter.com/home?status='.urlencode($sharetext).'&slider='.$slide->getSliderID().'&source='.$source.'"';
				break;
			case 'share_facebook':
				$a_sharelink = RevSliderFunctions::cleanStdClassToArray(RevSliderFunctions::getVal($all_actions, 'facebook_link', array()));
				$a_sharelink_custom = RevSliderFunctions::cleanStdClassToArray(RevSliderFunctions::getVal($all_actions, 'facebook_link_url', array()));

				switch ($a_sharelink[$num]) {
					case '%post_url%':
						$sharelink = "tp_revslider_sharing_get_permalink";
						break;
					case '%site_url%':
						$sharelink = $this->curPageURL();
						break;
					default:
						$sharelink = isset($a_sharelink[$num]) ? $a_sharelink[$num] : "";
						break;
				}
				$html_simple_link = 'target="_blank" href="'.$caller_url.'?tpurl='.$url.'&share=https://www.facebook.com/sharer/sharer.php?u='.urlencode($sharelink).'&slider='.$slide->getSliderID().'&source='.$source.'"';
				break;
			case 'share_googleplus':
				$a_sharelink = RevSliderFunctions::cleanStdClassToArray(RevSliderFunctions::getVal($all_actions, 'googleplus_link', array()));
				$a_sharelink_custom = RevSliderFunctions::cleanStdClassToArray(RevSliderFunctions::getVal($all_actions, 'googleplus_link_url', array()));

				switch ($a_sharelink[$num]) {
					case '%site_url%':
						$sharelink = $this->curPageURL();
						break;
					case '%post_url%':
						$sharelink = "tp_revslider_sharing_get_permalink";
						break;
					default:
						$sharelink = isset($a_sharelink[$num]) ? $a_sharelink[$num] : "";
						break;
				}
				$html_simple_link = 'target="_blank" href="'.$caller_url.'?tpurl='.$url.'&share=https://plus.google.com/share?url='.urlencode($sharelink).'&slider='.$slide->getSliderID().'&source='.$source.'"';
				break;
			case 'share_pinterest':
				$a_sharelink = RevSliderFunctions::cleanStdClassToArray(RevSliderFunctions::getVal($all_actions, 'pinterest_link', array()));
				$a_sharelink_custom = RevSliderFunctions::cleanStdClassToArray(RevSliderFunctions::getVal($all_actions, 'pinterest_link_url', array()));
				$a_shareimage = RevSliderFunctions::cleanStdClassToArray(RevSliderFunctions::getVal($all_actions, 'pinterest_image', array()));
				$a_shareimage_url = RevSliderFunctions::cleanStdClassToArray(RevSliderFunctions::getVal($all_actions, 'pinterest_image_url', array()));
				$a_sharedesc = RevSliderFunctions::cleanStdClassToArray(RevSliderFunctions::getVal($all_actions, 'pinterest_link_description', array()));

				switch ($a_sharelink[$num]) {
					case '%site_url%':
						$sharelink = $this->curPageURL();
						$sharedesc = $a_sharedesc[$num];
						break;
					case '%post_url%':
						$sharelink = 'tp_revslider_sharing_get_permalink';
						$sharedesc =  $a_sharedesc[$num];
						break;
					default:
						$sharelink = $a_sharelink[$num];
						$sharedesc = $a_sharedesc[$num];
						break;
				}

				if(isset($a_shareimage[$num])){
					switch ($a_shareimage[$num]) {
						case '%background_image%':
							$shareimage = $slide->getImageUrl();
							break;
						default:
							$shareimage = $a_shareimage[$num];
							break;
							
					}
				}
				else {
					$shareimage = '';
				}

				$html_simple_link = 'target="_blank" href="'.$caller_url.'?tpurl='.$url.'&share=https://pinterest.com/pin/create/button/?url='.urlencode($sharelink).',media='.urlencode($shareimage).',description='.urlencode($sharedesc).'&slider='.$slide->getSliderID().'&source='.$source.'"';
				break;
			case 'share_linkedin':
				$a_sharelink = RevSliderFunctions::cleanStdClassToArray(RevSliderFunctions::getVal($all_actions, 'linkedin_link', array()));
				$a_sharelink_custom = RevSliderFunctions::cleanStdClassToArray(RevSliderFunctions::getVal($all_actions, 'linkedin_link_url', array()));
				$a_share_title = RevSliderFunctions::cleanStdClassToArray(RevSliderFunctions::getVal($all_actions, 'linkedin_link_title', array()));
				$a_share_summary = RevSliderFunctions::cleanStdClassToArray(RevSliderFunctions::getVal($all_actions, 'linkedin_link_summary', array()));

				if(isset($a_sharelink[$num])){	
					switch ($a_sharelink[$num]) {
						case '%site_url%':
							$sharelink 	= $this->curPageURL();
							break;
						case '%post_url%':
							$sharelink 	= 'tp_revslider_sharing_get_permalink';
							break;
						default:
							$sharelink 	= empty($a_sharelink[$num]) ? '' : $a_sharelink[$num];
							break;
					}
					$sharetitle 	= empty($a_share_title[$num]) ? '' : $a_share_title[$num];
					$sharesummary 	= empty($a_share_summary[$num]) ? '' : $a_share_summary[$num];
				}
				else {
					$sharelink 	= '';
					$sharetitle 	= '';
					$sharesummary 	= '';
				}

				$html_simple_link = 'target="_blank" href="'.$caller_url.'?tpurl='.$url.'&share=https://www.linkedin.com/shareArticle?mini=true,url='.urlencode($sharelink).',title='.urlencode($sharetitle).',summary='.urlencode($sharesummary).'&slider='.$slide->getSliderID().'&source='.$source.'"';
				break;
			default:
				break;
		}
		$this->slide = $slide;
		add_action('revslider_fe_javascript_output', array($this, 'add_sharing_javascript'), 10, 2);
		return $html_simple_link;
	}

	/**
	 * Call Javascript from within RevSlider Frontend JS via Filter
	 *
	 * @version  1.1.1
	 * @since    1.0.0
	 * 
	 */
	public function add_sharing_javascript(){
		echo ('try {initSocialSharing("'.$this->slide->getSliderID().'");} catch(err){}');
	}

	/**
	 * Returns Current URL
	 *
	 * @since    1.0.0
	 */
	public function curPageURL() {
		$pageURL = 'http';

		if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
			$pageURL .= "s";
		}
		$pageURL .= "://";
		
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} 
		else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}

		return esc_url($pageURL);
	}

	/**
	 * Get Post Information
	 *
	 * @since    1.0.0
	 */
	public function get_post_info() {
		if( isset($_REQUEST['revslider_sharing_addon_post_id']) ){
			$post_id = urlencode($_REQUEST['revslider_sharing_addon_post_id']);
			$revslider_sharing_addon_link = $_REQUEST['revslider_sharing_addon_link'];
			die($revslider_sharing_addon_link);
		} 
		else {
			die( '-1' );
		}
	}

	public static function mediaid_to_shortcode($mediaid){

	    if(strpos($mediaid, '_') !== false){
	        $pieces = explode('_', $mediaid);
	        $mediaid = $pieces[0];
	        $userid = $pieces[1];
	    }

	    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_';
	    $shortcode = '';
	    while($mediaid > 0){
	        $remainder = $mediaid % 64;
	        $mediaid = ($mediaid-$remainder) / 64;
	        $shortcode = $alphabet{$remainder} . $shortcode;
	    };
	    return $shortcode;
	}

	public function get_photo_info($photo_id,$app_id,$app_secret){
	    $oauth = wp_remote_fopen("https://graph.facebook.com/oauth/access_token?type=client_cred&client_id=".$app_id."&client_secret=".$app_secret);
	    $url = "https://graph.facebook.com/$photo_id/?".$oauth."&fields=name,link,created_time,updated_time,from,likes,picture,images";

	    $transient_name = 'revslider_' . md5($url);

	    if ($this->transient_sec > 0 && false !== ($data = get_transient( $transient_name)))
	      return ($data);

	    return $url;
	  }

}
