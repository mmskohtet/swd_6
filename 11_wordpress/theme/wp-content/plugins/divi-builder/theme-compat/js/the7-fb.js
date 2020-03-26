(function($){
	$(document).on('et_fb_shop_componentDidMount et_fb_shop_componentDidUpdate', function(event, data) {
		setTimeout(function() {
			var $container = data.$el.find('.wf-container'),
				containerWidth = $container.width(),
				columnsNumber = data.columnsNumber === "0" ? 2 : parseInt(data.columnsNumber),
				columnWidth = parseInt(containerWidth / columnsNumber);

			// Resetting inline style
			$container.find('.product').removeAttr('style').css({ width: columnWidth, display: 'inline-block' });

			// Init the7 masonry
			$container.masonry({
				itemSelector: '.product',
				fitWidth: true
			});

			// Init the7 lazy loading
			$container.IsoLayzrInitialisation();
		}, 0);
	});
})(jQuery)