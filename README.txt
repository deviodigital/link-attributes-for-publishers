=== Link Attributes for Publishers ===
Contributors: deviodigital
Donate link: https://deviodigital.com
Tags: links, blogging, content, google, publishers
Requires at least: 3.0.1
Tested up to: 6.7.0
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Automatically add sponsored, ugc and nofollow `rel` tags to specific URL's in your content

== Description ==

This plugin will automatically update the rel tags for links with specific domains in the classic editor content, and the new core block editor.

The **Link Attributes for Publishers** plugin is designed to assist content authors in complying with Google's suggestions regarding proper tagging of sponsored and user-generated content (UGC) links. This plugin simplifies the process of adding rel tags for sponsored, ugc, and nofollow links to ensure your website meets Google's specifications for link attribution.

### Who is this for?

This plugin is particularly useful for:

*   Content Authors: Easily add `rel` tags to links without the need for manual coding.
*   Publishers: Ensure all sponsored and user-generated content links are properly tagged for compliance.

Let's say you want to mark all **amzn.to** links as `sponsored` because they're all affiliate links. This plugin helps you do that automatically to all content, old and new.

### Features

*   Automatically sets `rel` tags for sponsored, ugc, and nofollow links.
*   Allows users to specify domain names for automatic `rel` tag addition.
*   Simplifies compliance with Google's specifications about link attributes.

== Installation ==

**Via Dashboard**

1.   Go to `Plugins -> Add New` and Search `Link Attributes for Publishers`
2.   Click the `Install` button and then the `Activate` button
3.   Navigate to `Settings -> Link Attributes` to set your required rel tags

**Via SFTP**

1.   Upload `link-attributes-for-publishers` folder to the `/wp-content/plugins/` directory
2.   Activate the plugin through the 'Plugins' menu in WordPress
3.   Navigate to `Settings -> Link Attributes` to set your required rel tags

== Screenshots ==

1.   The Link Attributes settings page

== Changelog ==

= 1.0.1 =

* [📦 NEW: Added WPCom Check to restrict plugin usage on wordpress.com](https://github.com/deviodigital/link-attributes-for-publishers/commit/f58f8da69c24106bcde420e05713a03ecc05d289)
* [📦 NEW: Added French translation](https://github.com/deviodigital/link-attributes-for-publishers/commit/05ff020354bd422cdff6b6ffb6c28d7beccd03c8)
* [📦 NEW: Added Spanish translation](https://github.com/deviodigital/link-attributes-for-publishers/commit/8ccc48684221cedbcb99e3e71d3debff6b0aec1b)
* [📦 NEW: Added Italian translation](https://github.com/deviodigital/link-attributes-for-publishers/commit/42bc5b8bd746da9e5e3654706dc050563b59ca84)
* [👌 IMPROVE: Updated the settings page to include doc and support buttons](https://github.com/deviodigital/link-attributes-for-publishers/commit/f8d0e675e59d1212b20eb531c8d520fd4cd2ed11)
* [👌 IMPROVE: Updated text strings for localization](https://github.com/deviodigital/link-attributes-for-publishers/commit/afe1ddde478a7f58cece1f7b0f1ae5c65dee0221)
* [👌 IMPROVE: General code cleanup](https://github.com/deviodigital/link-attributes-for-publishers/commit/ccb900f8b1612e1aceba94f2e4c54f59781cb2dc)

= 1.0 =
*   Initial release