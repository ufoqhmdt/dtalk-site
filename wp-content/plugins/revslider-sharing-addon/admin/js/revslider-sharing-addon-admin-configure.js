(function( $ ) {
	//'use strict';

	/*! Main Functionality for Settings SlideOut */
			jQuery('document').ready(function() {
				var a = jQuery('#revslider_sharing_addon_settings_slideout');
				punchgs.TweenLite.set(a,{xPercent:"+100%", autoAlpha:0, display:"none"});

				jQuery('body').on('click', '#rs-dash-addons-slide-out-trigger_revslider-sharing-addon', function() {
					//hide all wrappers
					jQuery('.rs-sbs-slideout-wrapper').each(function(){
						punchgs.TweenLite.to(jQuery(this),0.4,{xPercent:"+100%", autoAlpha:0, display:"none",overwrite:"auto",ease:punchgs.Power3.easeInOut});
					});

					//display slideout
					var a = jQuery('#revslider_sharing_addon_settings_slideout'),
						b = jQuery('.rs-dash-addons');						
					punchgs.TweenLite.to(a,0.4,{xPercent:"0%", autoAlpha:1, display:"block",overwrite:"auto",ease:punchgs.Power3.easeOut});
				});
				jQuery('body').on('click','#revslider_sharing_addon_settings_slideout .rs-sbs-close', function() {
					var a = jQuery('#revslider_sharing_addon_settings_slideout');				
					punchgs.TweenLite.to(a,0.4,{xPercent:"+100%", autoAlpha:0, display:"none",overwrite:"auto",ease:punchgs.Power3.easeInOut});
				});

				//enable Scrollbars
				jQuery('#revslider_sharing_addon_settings_slideout .rs-sbs-slideout-inner').css("max-height",$( window ).height()-300);
					setTimeout(function() {
						jQuery('#revslider_sharing_addon_settings_slideout .rs-sbs-slideout-inner').perfectScrollbar("update");
					},400);
				$(window).resize(function(){
					jQuery('#revslider_sharing_addon_settings_slideout .rs-sbs-slideout-inner').css("max-height",$( window ).height()-300);
					jQuery('#revslider_sharing_addon_settings_slideout .rs-sbs-slideout-inner').perfectScrollbar("update");
				});

				//call scrollbars
				jQuery('#revslider_sharing_addon_settings_slideout .rs-sbs-slideout-inner').perfectScrollbar({wheelPropagation:true, suppressScrollX:true});
			
				// Tabs for Content Source
				$('body').on('click','.rs-submenu-tabs li', function() {
					$('.rs-submenu-tabs li').removeClass("selected");
					$(this).addClass("selected");
					$('.subcat-wrapper').hide();
					$($(this).data('content')).show();
					// Show Hide Details per Type
					//check_for_posttype( $($(this).data('content')).find('select.rs-addon-rel-slider-switch') );
				});

			}); //end document ready

			// Show Hide Details per Type
			$('select.rs-addon-rel-slider-switch').change(function(){
				check_for_posttype(jQuery(this));
			});

			/*! Settings Save Function */
			// Setup a click handler to initiate the Ajax request and handle the response
			$('#revslider-sharing-addon-save').live("click",function(evt) {
				showWaitAMinute({fadeIn:300,text:rev_slider_addon.please_wait_a_moment});
				$.ajax({
					url : revslider_sharing_addon.ajax_url,
					type : 'post',
					data : {
						action : 'save_sharing',
						nonce: $('#ajax_revslider_sharing_addon_nonce').text(),// The security nonce
						revslider_sharing_addon_facebook_width: $('input[name=revslider-sharing-addon-facebook-width]').val(),
						revslider_sharing_addon_facebook_height: $('input[name=revslider-sharing-addon-facebook-height]').val(),
						revslider_sharing_addon_twitter_width: $('input[name=revslider-sharing-addon-twitter-width]').val(),
						revslider_sharing_addon_twitter_height: $('input[name=revslider-sharing-addon-twitter-height]').val(),
						revslider_sharing_addon_pinterest_width: $('input[name=revslider-sharing-addon-pinterest-width]').val(),
						revslider_sharing_addon_pinterest_height: $('input[name=revslider-sharing-addon-pinterest-height]').val(),
						revslider_sharing_addon_linkedin_width: $('input[name=revslider-sharing-addon-linkedin-width]').val(),
						revslider_sharing_addon_linkedin_height: $('input[name=revslider-sharing-addon-linkedin-height]').val(),
						revslider_sharing_addon_googleplus_width: $('input[name=revslider-sharing-addon-googleplus-width]').val(),
						revslider_sharing_addon_googleplus_height: $('input[name=revslider-sharing-addon-googleplus-height]').val()
					},
					success : function( response ) {
						switch(response){
							case "0":
									UniteAdminRev.showInfo({type: 'warning', hideon: '', event: '', content: 'Ajax Error', hidedelay: 3});
									break;
							case "1":
									UniteAdminRev.showInfo({type: 'success', hideon: '', event: '', content: rev_slider_addon.settings_saved, hidedelay: 3});
									break;
							case "-1":
									UniteAdminRev.showInfo({type: 'warning', hideon: '', event: '', content: 'Nonce missing', hidedelay: 3});
									break;
						}
						showWaitAMinute({fadeOut:300,text:rev_slider_addon.please_wait_a_moment});
					},
					error : function ( response ){
						UniteAdminRev.showInfo({type: 'warning', hideon: '', event: '', content: 'Ajax Error', hidedelay: 3});
					}
				}); // End Ajax
			}); // End Click
		

	
	

})( jQuery );
