(function($){
	$( document ).ready( function() {
		var $body = $( 'body' );

		$( '.et_dashboard_updates_save' ).click( function() {
			var $this_button = $( this ),
				$this_container = $this_button.closest( 'ul' ),
				$this_spinner = $this_container.find( 'span.spinner' ),
				username = $this_container.find( '.updates_option_username' ).val(),
				api_key = $this_container.find( '.updates_option_api_key' ).val();

			$.ajax({
				type: 'POST',
				url: builder_settings.ajaxurl,
				data: {
					action : 'et_builder_save_updates_settings',
					et_builder_nonce : builder_settings.et_builder_nonce,
					et_builder_updates_username : username,
					et_builder_updates_api_key : api_key
				},
				beforeSend: function( data ) {
					$this_spinner.addClass( 'et_dashboard_spinner_visible' );
				},

				success: function( data ) {
					$this_spinner.removeClass( 'et_dashboard_spinner_visible' );
				}
			});

			return false;
		});

		$( '.et_google_api_save' ).click( function() {
			var $this_button = $( this ),
				$this_container = $this_button.closest( 'ul' ),
				$this_spinner = $this_container.find( 'span.spinner' ),
				api_key = $this_container.find( '.google_api_key' ).val(),
				enqueue_google_maps_script = $this_container.find('.enqueue_google_maps_script').is(':checked') ? 'on' : false;
				use_google_fonts = $this_container.find('.use_google_fonts').is(':checked') ? 'on' : false;

			$.ajax({
				type: 'POST',
				url: builder_settings.ajaxurl,
				data: {
					action : 'et_builder_save_google_api_settings',
					et_builder_nonce : builder_settings.et_builder_nonce,
					et_builder_google_api_key : api_key,
					et_builder_enqueue_google_maps_script : enqueue_google_maps_script,
					et_builder_use_google_fonts : use_google_fonts
				},
				beforeSend: function( data ) {
					$this_spinner.addClass( 'et_dashboard_spinner_visible' );
				},

				success: function( data ) {
					$this_spinner.removeClass( 'et_dashboard_spinner_visible' );
				}
			});

			return false;
		});

		$( '#et_pb_save_plugin' ).click( function() {
			var $loading_animation = $( '#et_pb_loading_animation' ),
				$success_animation = $( '#et_pb_success_animation' ),
				options_fromform;

			tinyMCE.triggerSave();
			options_fromform = $( '.' + dashboardSettings.plugin_class + ' #et_dashboard_options' ).serialize();

			$.ajax({
				type: 'POST',
				url: builder_settings.ajaxurl,
				data: {
					action : 'et_builder_save_settings',
					options : options_fromform,
					options_sub_title : '',
					save_settings_nonce : builder_settings.save_settings
				},
				beforeSend: function ( xhr ) {
					$loading_animation.removeClass( 'et_pb_hide_loading' );
					$success_animation.removeClass( 'et_pb_active_success' );
					$loading_animation.show();
				},
				success: function( data ) {
					$loading_animation.addClass( 'et_pb_hide_loading' );
					$success_animation.addClass( 'et_pb_active_success' ).show();

					setTimeout( function(){
						$success_animation.fadeToggle();
						$loading_animation.fadeToggle();
					}, 1000 );
				}
			});

			return false;
		});

		$( '.et_builder_clear_static_css' ).on( 'click', function() {
			clear_static_css( $(this) );
		});

		$body.append( '<div id="et_pb_loading_animation"></div>' );
		$body.append( '<div id="et_pb_success_animation"></div>' );

		$( '#et_pb_loading_animation' ).hide();
		$( '#et_pb_success_animation' ).hide();

		function clear_static_css( $button ) {
			var $spinner = $button.closest( '.input' ).find( 'span.spinner' );
			var data     = {
				action: 'et_core_page_resource_clear',
				et_owner: 'all',
				et_post_id: 'all',
				clear_page_resources_nonce: builder_settings.et_core_nonces.clear_page_resources_nonce
			};

			$.ajax( {
				type: "POST",
				url: ajaxurl,
				data: data,
				beforeSend: function ( xhr ) {
					$spinner.addClass( 'et_dashboard_spinner_visible' );
				},
				success: function ( response ) {
					if ( $spinner.length > 0 ) {
						setTimeout( function () {
							$spinner.removeClass( 'et_dashboard_spinner_visible' );
						}, 500 );
					}

					if ( $.isFunction( callback ) ) {
						callback();
					}
				}
			} );
		}
	});
})(jQuery);
