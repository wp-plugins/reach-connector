=== reach-connector ===
Contributors: David McWilliams, Phi Sanders
Tags: reach, connector, campaign, charity, child, sponsorships, fundraising, donate, sugar, maple, interactive
Requires at least: 3.1
Tested up to: 4.2.3
Stable tag: 1.7
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin enables you to easily integrate your REACH&#8480; campaigns and sponsorships with your WordPress site.

== Description ==
This plugin enables you to easily integrate your REACH&#8480; site with your WordPress site. Use short codes to embed all sponsorships or campaigns on pages or filter based on short code parameters.

== Installation ==
Copy the "reach-connector" folder and all of it's files in to your "wp-content/plugins" folder.

== Frequently Asked Questions ==
= Does this plugin require a REACH account? =
Yes, you can sign up for a REACH account at http://www.reachapp.co.

== Support ==
Please visit http://support.reachapp.co or email support@reachapp.co.

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

= 1.3.1 =
* Added documentation to simplify the setup process.

= 1.4 =
* This release adds optional parameters to customize the donations shortcode.

= 1.5 =
* This release adds shortcodes for projects, places, and individual pages for projects, places, and campaigns.

= 1.6 =
* Bug fix when accounts are using their own sub-domain on REACH.

= 1.7 =
* Scroll to the top of the page when a user clicks a link in the content.

== Usage ==
Sponsorship Shortcode Setup

To pull a list of sponsorships from REACH℠ to display on your site use the shortcode [sponsorships]. You can also pass optional parameters to filter your sponsorship results similar to the dropdown filters on the Sponsorships page using the parameters:
sponsorship_type
location
project
sponsorship_categories
status
Example: [sponsorships sponsorship_type="children"]

Campaigns Shortcode Setup

To pull a list of campaigns from REACH℠ to display on your site use the shortcode [campaigns].
Campaign Page Shortcode Setup

To pull a specific campaign from REACH℠ to display on your site use the shortcode with the permalink shown in REACH℠ [campaign permalink='my-campaign-permalink'].
Donation Shortcode Setup

To display a donation page from REACH℠ on your site use the shortcode [donations] on any page. You can also pass optional paramters defined in the Giving Options page in REACH to customize the donation form by setting amount, recurring period, purpose etc.
amount
fixed_amount (true/false)
recurring
fixed_recurring (true/false)
referral
Example: [donations amount="50"]

Projects Shortcode Setup

To pull a list of projects from REACH℠ to display on your site use the shortcode [projects].
Project Page Shortcode Setup

To pull a specific project from REACH℠ to display on your site use the shortcode with the permalink shown in REACH℠ [project permalink='my-project-permalink'].
Places Shortcode Setup

To pull a list of places from REACH℠ to display on your site use the shortcode [places].
Place Page Shortcode Setup

To pull a specific place from REACH℠ to display on your site use the shortcode with the permalink shown in REACH℠ [place permalink='my-place-permalink'].