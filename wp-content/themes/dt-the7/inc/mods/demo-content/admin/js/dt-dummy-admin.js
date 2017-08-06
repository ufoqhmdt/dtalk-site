(function( $ ) {
	'use strict';

	$(function() {
	    function createFeedbackElement(text, $feedbackContainer) {
            var spinnerHTML = '<span class="spinner is-active" style="float: none; margin: 0"></span> ';
            var $feedbackElement = $('<p>' + spinnerHTML + text + '</p>');

            if (typeof $feedbackContainer !== 'undefined') {
                $feedbackContainer.append($feedbackElement);
            }

            return $feedbackElement;
        }

		// Demo installation.
		var importingDemo = false;

		$('.dt-dummy-control-buttons .dt-dummy-button-import').on('click', function(event) {
			event.preventDefault();

			if ( importingDemo ) {
				return false;
			}

            importingDemo = true;

			var $this = $(this);

            var splitStr = function(str) {
                if (!str) {
                    return [];
                }

                return str
                    .split(',')
                    .map(function(val) { return val.trim(); })
                    .filter(function(val) { return !!val; })
            };

            var getActions = function( $container ) {
                var actions = [];
                $('input[type="checkbox"]:checked', $container).each(function(){
                    actions.push( $(this).attr('name') );
                });

                return actions;
            };

            var getUser = function( $container ) {
                return [$('.dt-dummy-content-user', $container).first().val()];
            };

			var addInlineMsg = function(msg, type, wrap) {
				if ( typeof wrap === 'undefined' ) {
					wrap = true;
				}

				msg = ( wrap ? '<p>'+msg+'</p>' : msg );

				var $msg = $('<div class="dt-dummy-inline-msg hide-if-js inline ' + type + '">' + msg + '</div>');
				$this.closest('.dt-dummy-control-buttons').before($msg);
				$msg.fadeIn();
			};

			var removeInlineMsgs = function() {
				$this.closest('.dt-dummy-controls').find('.dt-dummy-inline-msg').fadeOut('400', function() {
					$(this).remove();
				});
			};

            var $spinner = $this.siblings('.spinner').first();
			var spinnerOn = function() {
				$spinner.addClass('is-active');
			};

            var originBtnTxt = $this.text();
			var spinnerOff = function() {
				$spinner.removeClass('is-active');
				$this.removeClass('button--importing');
				$this.text(originBtnTxt);
			};

			var setSataus__Default = function() {
				$this.removeClass( 'button--importing' );
				spinnerOff();
			};

			var setStatus__Importing = function() {
				removeInlineMsgs();
				setSataus__Default();
				$this.addClass('button--importing').text(dtDummy.import_msg.btn_import);
				spinnerOn();
			};

			var displayPHPStatus = function () {
				$.post(ajaxurl, {
					action: 'the7_demo_content_php_status',
					_wpnonce: dtDummy.status_nonce
				}, function(status) {
					if ( status.success && status.data ) {
						addInlineMsg(status.data, 'error', false);
					}
				})
					.fail(function() {
						addInlineMsg(dtDummy.import_msg.msg_import_fail, 'error');
					});
			};

			setStatus__Importing();

            // Add feedback container.
            var $feedbackContainer = $('<div class="the7-installation-status"></div>');
            $this.closest('.feature-section').append($feedbackContainer);

			var $blockContainer = $this.closest('.dt-dummy-content');
			var contentPartId = $blockContainer.attr( 'data-dummy-id' ) || '0';
			var actions = getActions($blockContainer);
			var users = getUser($blockContainer);
            var xhr = $.when();

            var pluginsInstalled = false;
            if (-1 !== actions.indexOf('install_plugins')) {
                // Remove plugins installation from actions list.
                actions = actions.filter(function(item) { return 'install_plugins' !== item; });
                pluginsInstalled = true;

                var pluginsToInstall = splitStr($blockContainer.find('input[name=plugins_to_install]').val());
                var pluginsToActivate = splitStr($blockContainer.find('input[name=plugins_to_activate]').val());
                xhr = installPlugins(xhr, $feedbackContainer, pluginsToInstall, pluginsToActivate);
            }

            if (actions.length > 0) {
                actions.unshift('download_package');
                actions.push('cleanup');
            }

			actions.forEach(function(action) {
                xhr = xhr.then(function() {
                    var actionName = action;
                    if (typeof dtDummy.import_msg[action] !== 'undefined') {
                        actionName = dtDummy.import_msg[action];
                    }

                    var $feedback = createFeedbackElement(actionName, $feedbackContainer);

                    return $.post(
                        ajaxurl,
                        {
                            action: 'the7_import_demo_content',
                            dummy: action,
                            _wpnonce: dtDummy.import_nonce,
                            imported_authors: ['admin'],
                            user_map: users,
                            content_part_id: contentPartId
                        }
                    )
                        .then(function(response) {
                            var filter = $.Deferred();

                            if ( response.success ) {
                                filter.resolve(response);
                            } else {
                                filter.reject(response);
                            }

                            return filter.promise();
                        })
                        .done(function(response) {
                            $feedback.replaceWith($('<p class="the7-updated">' + actionName + '</p>'));
                        } )
                        .fail(function() {
                            $feedback.replaceWith($('<p class="the7-error">' + actionName + '</p>'));
                        });
				});
			});

            xhr.done(function() {
                addInlineMsg(dtDummy.import_msg.msg_import_success, 'the7-updated');
            });

			xhr.fail(function(response) {
                if ( typeof response.data !== 'undefined' && typeof response.data.error_msg !== 'undefined' && response.data.error_msg ) {
                    addInlineMsg(response.data.error_msg, 'error');
                } else {
                    displayPHPStatus();
                }
            });

			xhr.always(function() {
                $feedbackContainer.remove();
                setSataus__Default();
                importingDemo = false;
			});

			if (pluginsInstalled) {
                // Reload page.
                xhr.then(function() { window.location.reload(); });
            }

			return false;
		});

		// Import settings deactivation toggle.
		$('#the7-dashboard input[name=install_plugins]').on('click', function() {
            var $this = $(this);
            var $controlBlocks = [
                $this.closest('.dt-dummy-field').siblings('.dt-dummy-import-settings'),
                $this.closest('.dt-dummy-controls').find('.dt-dummy-control-buttons')
            ];

            if ($this.is(':checked')) {
                $controlBlocks.map(function($block) {
                    $block.removeClass('disabled').find(':input').removeAttr('disabled');
                });
            } else {
                $controlBlocks.map(function($block) {
                    $block.addClass('disabled').find(':input').attr('disabled', 'disabled');
                });
            }
        });

        // Bulk install required plugins.
        function installPlugins(xhr, $feedbackContainer, pluginsToInstall, pluginsToActivate) {
            var ajaxUrl = dtDummy.plugins_page_url;
			var $failMsg = $('<p class="the7-error">' + dtDummy.import_msg.plugins_installation_error + '</p>');

            // Install plugins.
            pluginsToInstall.forEach(function(plugin) {
                xhr = xhr.then(function() {
                	var pluginName = plugin;
                	if ( typeof dtDummy.plugins[plugin] !== 'undefined' ) {
                		pluginName = dtDummy.plugins[plugin];
					}

					var $feedback = createFeedbackElement(dtDummy.import_msg.installing_plugin + ' ' + pluginName, $feedbackContainer);

                    return $.post(ajaxUrl, { action: 'tgmpa-bulk-install', just_install: true, noheader: true, plugin: plugin }).done(function(response) {
                    	var $message = $(response).find('.update-php div.error p, .update-php div.updated p').addClass('the7-updated');
                    	// Cleanup message.
                        $message.find('.js-update-details-toggle').remove();
                        $feedback.replaceWith($message);
                    }).fail(function() {
                        $feedback.replaceWith($failMsg);
                        window.location.reload();
					});
                });
            });

            // Activate plugins.
            $.merge(pluginsToActivate, pluginsToInstall);
            xhr = xhr.then(function() {
                var $feedback = createFeedbackElement(dtDummy.import_msg.activating_plugin, $feedbackContainer);

                return $.post(ajaxUrl, { action: 'tgmpa-bulk-activate', noheader: true, plugin: pluginsToActivate }).done(function(response) {
                    var $message = '<p class="the7-updated">' + dtDummy.import_msg.plugins_activated + '</p>';
                    $feedback.replaceWith($message);
                }).fail(function() {
                    $feedback.replaceWith($failMsg);
                    window.location.reload();
                });
            });

            // Catch redirection.
            xhr = xhr.then(function() {
                var $feedback = createFeedbackElement(dtDummy.import_msg.rid_of_redirects, $feedbackContainer);

                return $.get(ajaxUrl, {noheader: true}).done(function() {
                    var $message = '<p class="the7-updated">' + dtDummy.import_msg.rid_of_redirects + '</p>';
                    $feedback.replaceWith($message);
                }).fail(function() {
                    $feedback.replaceWith($failMsg);
                    window.location.reload();
                });
            });

            return xhr;
        }

        var $dummyContentBlocks = $('.dt-dummy-content');

        // Search demo.
        $('#dt-dummy-search-input').on('search keyup', function() {
            var val = $(this).val().toLowerCase();

            if (1 == val.length) {
                return;
            }

            $dummyContentBlocks.each(function() {
                var $block = $(this);
                var content = $block.find('h3').first().text().toLowerCase();
                if ( content.includes(val) ) {
                    $block.show();
                } else {
                    $block.hide();
                }
            });
        });
	});
})( jQuery );
