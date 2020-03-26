(function($){
	window.et_pb_salient_fix_loading_attempts_count = 0;

	function init_modules_when_ready() {
		window.et_pb_salient_fix_loading_attempts_count++;

		// check whether the loading screen is visible to determine when loading is finished
		if ( ! $( '#ajax-loading-screen' ).length || '0' === $( '#ajax-loading-screen' ).css( 'opacity' ) ) {
			$( document ).trigger( 'resize' );
			return;
		}

		// attempt to init our modules not more than 15 times to avoid extra resources usage.
		if ( window.et_pb_salient_fix_loading_attempts_count <= 15 ) {
			setTimeout( function() {
				init_modules_when_ready();
			}, 1000 );
		}
	}

	$(document).ready( function(){
		init_modules_when_ready();
	});
})(jQuery)