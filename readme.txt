=== reach-connector ===
Contributors: David McWilliams, Phi Sanders
Tags: reach, connector, campaign, charity, child, sponorships, fundraising, donate, sugar, maple, interactive
Requires at least: 3.1
Tested up to: 4.2.1
Stable tag: 1.3
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin enables you to easily integrate your REACH campaigns and sponsorships with your WordPress site.

== Description ==
This plugin enables you to easily integrate your REACH with your WordPress site. Use short codes to embed all sponsorships or campaigns on pages or filter based on short code parameters.

== Installation ==
Copy the \"reach-connector\" folder and all of it\'s files in to your \"wp-content/plugins\" folder.

Edit the look of each widget by modifying the HTML attributes in reach-connector.php in the methods get_sponsorships and get_campaigns.

== Frequently Asked Questions ==
= Does this plugin require a REACH account? =
Yes, you can sign up for a REACH account at http://www.reachapp.co.

== Upgrade Notice ==
= 1.3 =
Please upgrade to the latest version to enable new enhancements to the plugin.

== Changelog ==
= 1.1 =
* This is the intial release to the public.

= 1.2 =
* This release switches to a more user-friendly format which provides pagination and filtering for sponsorships and campaigns.

= 1.3 =
* This release adds the new shortcode "donations" to display the general donation form on any page.

== Usage ==
To pull a list of sponsorships from REACH to display on your site use the shortcode [sponsorships] on any page. You can also pass conditional parameters to filter your sponsorship results similar to the dropdown filters on the Sponsorships page using the parameters:

sponsorship_type
location
project
sponsorship_categories
status

Example: [sponsorships sponsorship_type="children"]

To pull a list of campaigns from REACH to display on your site use the shortcode [campaigns] on any page.

To display the general donation page from REACH on your site use the shortcode [donations] on any page.