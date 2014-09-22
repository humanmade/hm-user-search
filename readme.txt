=== Extended User Search ===
Contributors: humanmade, pauldewouters
Tags: users, search, dashboard, admin
Requires at least: 3.8.4
Tested up to: 4.0
Stable tag: 0.1-alpha
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Search for users by first name, last name and nickname ( in addition to the default fields )

== Description ==

By default, the user search in the backend on the user list page only searches user_nicename and user_login.
This plugin modifies the user search by adding some meta queries to search first name, last name and nickname, which
are in the user meta table.
This can be a little slower than the regular search.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `<?php do_action('plugin_name_hook'); ?>` in your templates

== Frequently Asked Questions ==

= Can I search other meta fields? =

Yes, you can hook into `hm_user_search_meta_queries` and modify the meta queries array.


== Screenshots ==

== Changelog ==

= 0.1.0-alpha =

Initial commit.
