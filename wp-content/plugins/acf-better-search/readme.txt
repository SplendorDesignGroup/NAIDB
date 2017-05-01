=== Plugin Name ===
Contributors: mateuszgbiorczyk
Donate link: https://www.paypal.me/mateuszgbiorczyk/
Tags: search, acf, advanced custom fields, add-on, admin
Requires at least: 4.6
Tested up to: 4.7
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

This plugin adds to default WordPress search engine the ability to search by content from selected fields of Advanced Custom Fields plugin.

== Description ==

This plugin adds to default WordPress search engine the ability to search by content from selected fields of Advanced Custom Fields plugin.

Everything works automatically, no need to add any additional code.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/acf-better search` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the `Plugins` screen in WordPress
3. Use the `Settings -> ACF Search` screen to configure the plugin

== Frequently Asked Questions ==

= How does this work? =

Plugin changes all SQL queries by extending the standard search to selected fields of Advanced Custom Fields.

= Where working advanced search? =

It works for both WP_Query class and get_posts functions.

= Do I need to add some arguments to the function to init the advanced search? =

On search page this works automatically. For custom queries and get_posts function you need add [Search Parameter](https://codex.wordpress.org/Class_Reference/WP_Query#Search_Parameter).

== Screenshots ==

1. Screenshot of the options panel

== Changelog ==

= 1.0.0 =
* The first stable release

== Upgrade Notice ==

This is first stable release, no upgrade.