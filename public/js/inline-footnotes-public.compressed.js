!function(o){"use strict";var n=function(n){o(this).children(".footnoteContent").first().is(":visible")?o(".inline-footnote .footnoteContent").hide():(o(".inline-footnote .footnoteContent").hide(),o(this).children(".footnoteContent").toggle()),n.stopPropagation()};o(function(){console.log("inlineFootNotesVars",inlineFootNotesVars),inlineFootNotesVars.hover?o(".inline-footnote").hover(n):o(".inline-footnote").click(n),o("html").on("click",function(){o(".inline-footnote .footnoteContent").hide()})})}(jQuery);