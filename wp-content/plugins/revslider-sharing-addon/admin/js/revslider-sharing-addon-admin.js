(function( $ ) {
	//'use strict';

	jQuery(document).ready(function(){
		
		jQuery('body').on('change', 'select[name="layer_action[]"], select[name="no_layer_action[]"]',function() {
			revslider_sharing_addon_showHideLinkActions(jQuery(this));			
		});

		jQuery('body').on('click','#rs-action-content-wrapper',function(){
			revslider_sharing_addon_showHideLinkActions(jQuery(this));
		});

		// Custom Settings for Sharing Options
		jQuery('body').on('change','select.sharing_link_select',function(){
			$this = jQuery(this);
		 	if($this.val()!='custom'){
		 		jQuery("." + $this.attr('name').replace(/[^a-z\_0-9\s]/gi, '') + '_custom').hide();
		 	}
		 	else {
		 		jQuery("." + $this.attr('name').replace(/[^a-z\_0-9\s]/gi, '') + '_custom').show();
		 	}
		 });	 

		// Custom LinkedIn Settings for Sharing Options
		jQuery('body').on('change','input.linkedin_source',function(){
			$this = jQuery(this);
			if($this.val()=='{{post_url}}'){
		 		if($this.closest('.action-linkedinfields').find(".linkedin_link_title").val()=="") $this.closest('.action-linkedinfields').find(".linkedin_link_title").val("{{title}}");
		 		if($this.closest('.action-linkedinfields').find(".linkedin_link_summary").val()=="") $this.closest('.action-linkedinfields').find(".linkedin_link_summary").val("{{excerpt}}");
		 	}
		 });

		jQuery('body').on('click',".revslider-sharing-addon-meta",function(){
		 	if(jQuery(this).hasClass("disabled"))
				return(false);
			
			add_meta_into = jQuery(this).closest('.revslider_sharing_metaduo').find('.revslider_dialog_input');
			
			var buttons = {"Cancel":function(){jQuery("#dialog_template_insert").dialog("close")}}
			jQuery("#dialog_template_insert").dialog({
				buttons:buttons,
				minWidth:700,
				dialogClass:"tpdialogs",
				modal:true,
				create:function(ui) {				
					jQuery(ui.target).parent().find('.ui-dialog-titlebar').addClass("tp-slider-new-dialog-title");
				},
			});

		});

		// Initialising Callbacks
		revslider_sharing_addon_layer_callbacks();
		revslider_sharing_addon_layer_add_callbacks();
		revslider_sharing_addon_layer_update_callbacks();
	});

	var revslider_sharing_addon_showHideLinkActions = function(v){
		 	var li = v.closest('li'),
			value = v.val();

			li.find('.action-facebookfields').hide();
			li.find('.action-twitterfields').hide();
			li.find('.action-googleplusfields').hide();
			li.find('.action-linkedinfields').hide();
			li.find('.action-pinterestfields').hide();
			
			switch(value){
		 		case 'share_facebook':
		 			li.find('.action-facebookfields').show();
		 			break;
		 		case 'share_twitter':
		 			li.find('.action-twitterfields').show();
		 			break;
		 		case 'share_googleplus':
		 			li.find('.action-googleplusfields').show();
		 			break;
		 		case 'share_linkedin':
		 			li.find('.action-linkedinfields').show();
		 			break;
		 		case 'share_pinterest':
		 			li.find('.action-pinterestfields').show();
		 			break;
		 		default:
		 			break;
		 	}

		 }

	var revslider_sharing_addon_layer_add_callbacks = function() {
		
		var call_sa_addActionCall = {
			callback : function(obj) {	
				//console.log("---------- revslider_sharing_addon_layer_add_callbacks ----------");		
				return obj;
			},		
			environment : "add_layer_to_stage",
			function_position : "data_definition"
		};
		UniteLayersRev.addon_callbacks.push(call_sa_addActionCall);
	}


	var revslider_sharing_addon_layer_callbacks = function() {
	
		var call_sa_addActionCall = {
			callback : function(data,obj,key) {			
				//console.log("---------- revslider_sharing_addon_layer_callbacks ----------");
				switch(data.action){
					case 'share_twitter':
						data.twitter_text = (obj['layer_action'].twitter_text !== undefined && obj['layer_action'].twitter_text[key] !== undefined) ? obj['layer_action'].twitter_text[key] : '';
						data.twitter_link = (obj['layer_action'].twitter_link !== undefined && obj['layer_action'].twitter_link[key] !== undefined) ? obj['layer_action'].twitter_link[key] : '{{site_url}}';
					break;
					case 'share_facebook':
						data.facebook_link = (obj['layer_action'].facebook_link !== undefined && obj['layer_action'].facebook_link[key] !== undefined) ? obj['layer_action'].facebook_link[key] : '{{site_url}}';
					break;
					case 'share_googleplus':
						data.googleplus_link = (obj['layer_action'].googleplus_link !== undefined && obj['layer_action'].googleplus_link[key] !== undefined) ? obj['layer_action'].googleplus_link[key] : '{{site_url}}';
					break;
					case 'share_pinterest':
						data.pinterest_link = (obj['layer_action'].pinterest_link !== undefined && obj['layer_action'].pinterest_link[key] !== undefined) ? obj['layer_action'].pinterest_link[key] : '{{site_url}}';
						data.pinterest_image = (obj['layer_action'].pinterest_image !== undefined && obj['layer_action'].pinterest_image[key] !== undefined) ? obj['layer_action'].pinterest_image[key] : '{{background_image}}';						
						data.pinterest_link_description = (obj['layer_action'].pinterest_link_description !== undefined && obj['layer_action'].pinterest_link_description[key] !== undefined) ? obj['layer_action'].pinterest_link_description[key] : '';
					break;
					case 'share_linkedin':
						data.linkedin_link = (obj['layer_action'].linkedin_link !== undefined && obj['layer_action'].linkedin_link[key] !== undefined) ? obj['layer_action'].linkedin_link[key] : '{{site_url}}';
						data.linkedin_link_title = (obj['layer_action'].linkedin_link_title !== undefined && obj['layer_action'].linkedin_link_title[key] !== undefined) ? obj['layer_action'].linkedin_link_title[key] : '';
						data.linkedin_link_summary = (obj['layer_action'].linkedin_link_summary !== undefined && obj['layer_action'].linkedin_link_summary[key] !== undefined) ? obj['layer_action'].linkedin_link_summary[key] : '';					
					break;
					case 'share_email':
						data.email_link = (obj['layer_action'].email_link !== undefined && obj['layer_action'].email_link[key] !== undefined) ? obj['layer_action'].email_link[key] : '{{site_url}}';
						data.email_link_subject = (obj['layer_action'].email_link_subject !== undefined && obj['layer_action'].email_link_subject[key] !== undefined) ? obj['layer_action'].email_link_subject[key] : '';
						data.email_link_body = (obj['layer_action'].email_link_body !== undefined && obj['layer_action'].email_link_body[key] !== undefined) ? obj['layer_action'].email_link_body[key] : '';					
					break;
					default:
					break;
				}
				
				return data;
			},		
			environment : "add_layer_actions",
			function_position : "data_definition"
		};
		UniteLayersRev.addon_callbacks.push(call_sa_addActionCall);
	}


	var revslider_sharing_addon_layer_update_callbacks = function() {
		
		var call_sa_addActionCall = {
			callback : function(objUpdate) {		
				//console.log("---------- revslider_sharing_addon_layer_update_callbacks ----------");	
				
				//Twitter
				objUpdate['layer_action'].twitter_text = [];
		        jQuery('textarea[name="twitter_text[]"]').each(function(){
		            objUpdate['layer_action'].twitter_text.push(jQuery(this).val());
		        });
		       objUpdate['layer_action'].twitter_link = [];
		        jQuery('input[name="twitter_link[]"]').each(function(){
		            objUpdate['layer_action'].twitter_link.push(jQuery(this).val());
		        });
		        
		        //Facebook
				objUpdate['layer_action'].facebook_link = [];
		        jQuery('input[name="facebook_link[]"]').each(function(){
		            objUpdate['layer_action'].facebook_link.push(jQuery(this).val());
		        });
		        
		        //Googleplus
				objUpdate['layer_action'].googleplus_link = [];
		        jQuery('input[name="googleplus_link[]"]').each(function(){
		            objUpdate['layer_action'].googleplus_link.push(jQuery(this).val());
		        });

		        //LinkedIn
				objUpdate['layer_action'].linkedin_link = [];
		        jQuery('input[name="linkedin_link[]"]').each(function(){
		            objUpdate['layer_action'].linkedin_link.push(jQuery(this).val());
		        });
		        objUpdate['layer_action'].linkedin_link_title = [];
		        jQuery('input[name="linkedin_link_title[]"]').each(function(){
		            objUpdate['layer_action'].linkedin_link_title.push(jQuery(this).val());
		        });
		        objUpdate['layer_action'].linkedin_link_summary = [];
		        jQuery('textarea[name="linkedin_link_summary[]"]').each(function(){
		            objUpdate['layer_action'].linkedin_link_summary.push(jQuery(this).val());
		        });

		        //Pinterest
				objUpdate['layer_action'].pinterest_link = [];
		        jQuery('input[name="pinterest_link[]"]').each(function(){
		            objUpdate['layer_action'].pinterest_link.push(jQuery(this).val());
		        });
		        objUpdate['layer_action'].pinterest_image = [];
		        jQuery('input[name="pinterest_image[]"]').each(function(){
		            objUpdate['layer_action'].pinterest_image.push(jQuery(this).val());
		        });
		        objUpdate['layer_action'].pinterest_link_description = [];
		        jQuery('textarea[name="pinterest_link_description[]"]').each(function(){
		            objUpdate['layer_action'].pinterest_link_description.push(jQuery(this).val());
		        });

		        //Email
				objUpdate['layer_action'].email_link = [];
		        jQuery('select[name="email_link[]"]').each(function(){
		            objUpdate['layer_action'].email_link.push(jQuery(this).val());
		        });
		        objUpdate['layer_action'].email_link_url = [];
		        jQuery('input[name="email_link_url[]"]').each(function(){
		            objUpdate['layer_action'].email_link_url.push(jQuery(this).val());
		        });
		        objUpdate['layer_action'].email_link_subject = [];
		        jQuery('input[name="email_link_subject[]"]').each(function(){
		            objUpdate['layer_action'].email_link_subject.push(jQuery(this).val());
		        });
		        objUpdate['layer_action'].email_link_body = [];
		        jQuery('textarea[name="email_link_body[]"]').each(function(){
		            objUpdate['layer_action'].email_link_body.push(jQuery(this).val());
		        });

				return objUpdate;
			},		
			environment : "updateLayerFromFields_Core",
			function_position : "end"
		};
		UniteLayersRev.addon_callbacks.push(call_sa_addActionCall);
	}

})( jQuery );


