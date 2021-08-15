$(document).ready(function() {

			$('img').bind("mouseenter", handleMouseEnter).bind("mouseout", handleMouseOut);

			function handleMouseEnter(e) {
				$(this).css( {
					"border": "thick solid green",
					"opacity": "0.5"
				});
			};

			function handleMouseOut(e) {
				$(this).css( {
					"border": "",
					"opacity": ""
				});
			};
		});