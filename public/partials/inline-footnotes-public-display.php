<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://gavinr.com
 * @since      1.0.0
 *
 * @package    Inline_Footnotes
 * @subpackage Inline_Footnotes/public/partials
 */
?>

<style>
	.inline-footnote,
	.inline-footnote:hover,
	.inline-footnote:active,
	.inline-footnote:visited {
		background-color: <?php  echo get_option( 'inline_footnotes_background_color' ); ?>;
		color: <?php echo get_option( 'inline_footnotes_text_color'); ?> !important;
	}
	.inline-footnote span.footnoteContent {
		background-color: <?php  echo get_option( 'inline_footnotes_text_popup_background_color' ); ?>;
		color: <?php echo get_option( 'inline_footnotes_text_popup_text_color'); ?> !important;
	}
</style>
