=== Poet Tips Recommendations Widget ===
Contributors: robertpeake, robert.peake
Tags: poetry, poems, recommendations, jsonp
Requires at least: 2.1
Tested up to: 5.0
Stable tag: 2.0.5
License: GPL2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Displays recommended poets from the Poet Tips crowd-sourced recommendations website.

== Description ==

Displays recommended poets from the Poet Tips crowd-sourced recommendations website. Use the `[poettips]` short code with the `name=` parameter to display a graph of similar poets. Add the Poet Tips Recommendations widgets to your sidebar wherever tags and categories are displayed, and if the tag or category is the name of a poet on the Poet Tips website, it will automatically display recommendations for that poet.

== Installation ==

Install as normal for WordPress plugins. Uses the free/open Poet Tips API at: http://poet.tips/api/

== Frequently Asked Questions ==

= What parameters can I use with the shortcode? =

 - name (required): the name of the poet
 - type (default: 2D): one of `list`, `2D`, or `3D` - the type to display  
 - show_title (default: false): whether to show "Poets similar to [name]" above the list/graph

== Screenshots ==

1. Using the shortcode
2. Displaying the result

== Changelog ==

 * 2.0.5 Tested with 5.0
 * 2.0.4 Switch to https for all URLs
 * 2.0.2 Better handling of special chars in generated URLs
 * 2.0.1 Default no border on iframe
 * 2.0 Support for displaying 2D/3D graphs using the `[poettips]` shortcode
 * 1.0 Initial Release
