(function( $ ) {
	'use strict';

	var showFootnote = function(evt) {
		// if the current footnote is showing, just hide it.
		// if we're clicking on a DIFFERNET footnote, first hide all
		// then show this one.
		if($(this).children('.footnoteContent').first().is(':visible')) {
			$(".inline-footnote .footnoteContent").hide();
		} else {
			$(".inline-footnote .footnoteContent").hide();
			$(this).children('.footnoteContent').toggle();
		}
		evt.stopPropagation();
	};

	 $(function() {
		 console.log('inlineFootNotesVars', inlineFootNotesVars);
		if(inlineFootNotesVars.hover) {
			$(".inline-footnote").hover(showFootnote);
		} else {
			$(".inline-footnote").click(showFootnote);
		}
	 	
	 	$('html').on('click', function() {
	 		$(".inline-footnote .footnoteContent").hide();
	 	});
	 });

})( jQuery );
