jQuery(document).ready(function ($) {
	if (!('ontouchstart' in window) && (dtLocal.themeSettings.smoothScroll == "on" || dtLocal.themeSettings.smoothScroll == "on_parallax" && $(".stripe-parallax-bg").length > 0)) {
		$("body").css({"scroll-behavior" : "smooth"});
	}

});



/*
Plugin: jQuery Parallax
Version 1.1.3
Author: Ian Lunn
Twitter: @IanLunn
Author URL: http://www.ianlunn.co.uk/
Plugin URL: http://www.ianlunn.co.uk/plugins/jquery-parallax/

Dual licensed under the MIT and GPL licenses:
http://www.opensource.org/licenses/mit-license.php
http://www.gnu.org/licenses/gpl.html
*/

jQuery(document).ready(function ($) {
	var $window = $(window);
	var windowHeight = $window.height();

	$window.resize(function () {
		windowHeight = $window.height();
	});

	$.fn.parallax = function(xpos, speedFactor, outerHeight) {
		var $this = $(this);
		var getHeight;
		var firstTop;
		var paddingTop = 0;
		var fixTimeout;
		
		//get the starting position of each element to have parallax applied to it    
		$this.each(function(){
				firstTop = $this.offset().top;
		});

		if (outerHeight) {
			getHeight = function(jqo) {
				return jqo.outerHeight(true);
			};
		} else {
			getHeight = function(jqo) {
				return jqo.height();
			};
		}
			
		// setup defaults if arguments aren't specified
		if (arguments.length < 1 || xpos === null) xpos = "50%";
		if (arguments.length < 2 || speedFactor === null) speedFactor = 0.1;
		if (arguments.length < 3 || outerHeight === null) outerHeight = true;
		
		// function to be called whenever the window is scrolled or resized
		function update(){
			var pos = dtGlobals.winScrollTop;        

			$this.each(function(){
				var $element = $(this);
				var top = $element.offset().top;
				var height = getHeight($element);

				// Check if totally above or totally below viewport
				if (top + height < pos || top > pos + windowHeight) {
					return;
				}

				$this.css('backgroundPosition', xpos + " " + Math.round((top - pos) * speedFactor) + "px");
			});
		}   

		$window.bind('scroll', update).resize(function() {
			update();
		}).bind("debouncedresize", function() {
			clearTimeout(fixTimeout);
			fixTimeout = setTimeout(function() {
				update();
			}, 20);
		});
		update();

		setTimeout(function() {
			if (!window.bgGlitchFixed && $.browser.webkit) {
				$window.scrollTop(dtGlobals.winScrollTop + 1);
				window.bgGlitchFixed = true;
			}
		}, 20);

	};
});

