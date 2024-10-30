=== Inline Footnotes ===
Contributors: gavinr
Donate link: http://www.gavinr.com/donate/
Tags: footnotes, shortcode
Requires at least: 3.0.1
Tested up to: 5.0
Stable tag: 2.3.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Enables adding footnotes via shortcodes in your content.

== Description ==

This allows you to easily add inline "footnotes" to your content. In places where you place the shortcode will appear a little number that is clickable to see the footnote content.

Example syntax: `[footnote]This is my footnote.[/footnote]`

== Installation ==

1. Upload `inline-footnotes` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `[footnote] ... [/footnote]` shortcodes in your content.

== Frequently Asked Questions ==

= Where can I get support? =

On my website: [gavinr.com/wordpress-plugins](http://www.gavinr.com/wordpress-plugins)

= What settings can I choose? =

1. Background Color
2. Text Color
3. Text Popup Background Color
4. Text Popup Text Color
5. Show Footnote on Hover

= I'm using this plugin to make money! How can I thank Gavin for creating this for me? =

Value-for-value donations are welcome at <a href="http://gavinr.com/donate">gavinr.com/donate</a>. Thanks!

= What shortcode settings are there? =

Right now the shortcode settings are:

1. `title` - this is what will display in the box inline of your content (instead of "1, 2, 3, etc" wich happens by default if this is not included). Example: `[footnote  title="..."]This is a footnote![/footnote]`. Note that you can use this to reset the numbers too, if you set title to a number like `title="3"` etc.
2. `symbol_background_color` - set the background color of the inline "symbol" that shows up.
3. `symbol_text_color` - set the text color of the inline "symbol" that shows up.
4. `background_color` - set the background color of a single footnote. 
5. `text_color` - set the text color of a single footnote.

All the colors above take <a href="https://developer.mozilla.org/en-US/docs/Web/CSS/color_value#colors_table">HTML Color Names</a> or HEX codes (include the # sign).

= Is this compatible with the Gutenberg Editor? =

Yes it is. Just use your shortcodes inline the paragraph block just as you always have.

== Screenshots ==

1. What the footnote looks like by default.
2. What the footnote looks like when open
3. Settings page

== Changelog ==

= 2.3.0 =
* Additional shortcode options "text_color", "symbol_text_color", and "symbol_background_color"
* 2018-12-15

= 2.2.0 =
* Works with Gutenberg and tested with version 5.
* 2018-08-27

= 2.1.0 =
* New "Hover" option
* Compressed JS and CSS files
* 2018-02-19

= 2.0.0 =
* Fixes mobile issues by showing the footnote content in the center of the screen when on mobile.
* Allows `background_color` attribute in the footnote tag.
* 2018-02-18

= 1.1.1 =
* Compatible with WordPress 4.9

= 1.1.0 =
* New "title" shortcode attribute to allow you to show different text in the inline footnote. See [the forums](https://wordpress.org/support/topic/suggestion-allow-alternative-footnote-tags-eg-rather-than-a-number) for more info.

= 1.0.2 =
* Compatible with WordPress 4.5

= 1.0.1 =
* Fixed CSS issues
* HTML links within footnotes now work

= 1.0.0 =
* Initial Version

== Upgrade Notice ==

= 1.0 =
No upgrade notice for v1.
