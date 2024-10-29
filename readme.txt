=== Plugin Name ===
Contributors: Beampulse
Donate link: http://fr.beampulse.com/
Tags: @marketing, TestAB, RTM, Heatmaps, marketing comportemental, 
Requires at least: 4.6
Tested up to: 4.8
Stable tag: trunk
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

This plugin automatically injects the Beampulse javascript activation tag on all the pages of a Wordpress website.

== Description ==

Beampulse solution is a CRO (Conversion Rate Optimization) tool, a behavioral marketing product that offers many functionalities to help websites to understand their visitors behavior and optimize their conversion rate.

It is based on an anonymous tracking if the website visitors, through a Javascript tag that this plugin automatically injects on all the pages of a Wordpress website.
 
Among all functionalities :
 
* Heatmaps : Visual representations of data using a color scale to represent values
* Clickmaps : These heatmaps show the number and % of clicks on each element of a web page.
* Scrollmaps : The depth the visitors reached
* Segmentation : Filters to group visitors through many possible p-defined conditions
* Stimulation : Actions that will affect a percentage of visitors to see their effect on conversion goals
* A/B Testing : Campaigns to compare conversion goals between usual and stimulated visitors
* Heatmap export : Regular exports of heatmaps on pdf format
* Heatmap Player : Allows visualization of heatmaps evolution
* Session Recorder : Reply the visitors mouse moves and clicks
* Funnels : To analyse conversion paths followed by visitors
* Values : Extract specific values for statistics and clickmap rendering
* Heatmap values : Colourful rendering of clickmaps bullets to enhance importance order
* Visits course Sunburst : Visualize visits paths in a single snapshot and navigate through page groups
* ...

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings->beampulse screen to configure the plugin
1. Choose the kanguage through the 'Language' choice of the Beampulse plugin menu
1. Connect to the Beampulse Dashboard to get the tracker URL
1. Configure the URL in the 'Activation Code' of the Beampulse plugin menu

== Frequently Asked Questions ==

*Check the 'Tips&Hints' Beampulse plugin menu*

== Screenshots ==

1. screenshot-1.png - The Beampulse Plugin menu
2. screenshot-2.png - Beampulse Dashboard - URL location
3. screenshot-3.png - Beampulse Dashboard - Tag URL
4. screenshot-4.png - Beampulse Plugin - Tag injection

== Changelog ==

= 1.0.5 =
* Function names with prefix beampulse_taginjector_
* Quit function_exists test
* Style classes with prefix beampulse_taginjector_
 
= 1.0.4 =
* First registered stable version

== Upgrade Notice ==

= 1.0.5 =
* Prefixed names
 
= 1.0.4 =
* First registered stable version
