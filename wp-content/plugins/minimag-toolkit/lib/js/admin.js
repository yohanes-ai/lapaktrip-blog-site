(function($) {

	"use strict";

	/* Event - Document Ready */
	$(document).on("ready",function() {

		if( $('[id*="_cf_metabox_page"]').length && $('[class*="-owlayout"]').length ) {

			$('[class*="-owlayout"] li input[type="radio"]:checked').parent().addClass("selected");
			
			$('[class*="-owlayout"] li input[type=radio]').on("change", function(e) {

				e.preventDefault();

				if( $(this).attr("name") == "minimag_cf_page_owlayout" ) {
					$('[class*="-owlayout"] li input[name="minimag_cf_page_owlayout"]').parent().removeClass("selected");
				}
				else if( $(this).attr("name") == "minimag_cf_sidebar_owlayout" ) {
					$('[class*="-owlayout"] li input[name="minimag_cf_sidebar_owlayout"]').parent().removeClass("selected");
				}
				else {
				}

				$(this).parent().addClass("selected");
			});
		}

	}); /* Event - Document Ready /- */

})(jQuery);