=== Gravity Forms: Multiple Form Instances ===
Contributors: tyxla
Tags: gravity, form, multiple, gravity forms
Requires at least: 3.0.1
Tested up to: 4.5
Stable tag: 1.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Allows multiple instances of the same form to be run on a single page when using AJAX.

== Description ==

Gravity Forms: Multiple Form Instances is used in conjunction with the awesome Gravity Forms plugin.

Usually, when you use multiple Gravity Forms with AJAX enabled on the same page, this causes issues with multiple form submission & error display, infinite loading and other issues.

This plugin addresses this issue, allowing multiple forms to be displayed on the same page without any issues.

== Installation ==

1. Install Gravity Forms: Multiple Form Instances either via the WordPress.org plugin directory, or by uploading the files to your server.
1. Activate the plugin.
1. That's it. You're ready to go!

== Changelog ==

= 1.1.1 =
Tested with WordPress 4.5.

= 1.1 =
Integrated custom CSS class, containing the original form ID for easy styling.
Integrated a tests framework.
Added a complete set of unit tests to reach 98% test coverage.
Improved code and made it compatible with the WordPress Coding Standards.
Minor replacement fix.
Readme improvements.
Integrated Travis CI and Scrutinizer CI.

= 1.0.15 =
Added support for the page "Next" button conditional logic.

= 1.0.14 =
Added support for all product field types.

= 1.0.13 =
Added support for Product field with Calculation field type.

= 1.0.12 =
Properly sanitizing the random form ID. Props @swissspidy.

= 1.0.11 =
Tested with WordPress 4.4.

= 1.0.10 =
Now properly supporting date field with calendar enabled.

= 1.0.9 =
Now properly supporting maximum characters limit.

= 1.0.8 =
Now properly supporting `gform_field_values`.

= 1.0.7 =
Tested with WordPress 4.3.

= 1.0.6 =
Now compatible with the advanced dropdown UI (Chosen).

= 1.0.5 =
Now compatible with password field strength meter.

= 1.0.4 =
Now compatible with field conditional logic.

= 1.0.3 =
Improved code readability.

= 1.0.2 =
The plugin now handles the following instances when they have the same values in different forms:

* checkboxes & radio buttons - ID attribute of choice inputs
* checkboxes & radio buttons - for attribute of their choice labels
* checkboxes & radio buttons - ID attribute of their choice labels

= 1.0.1 =
* Added a filter for modifying the find & replace strings.
* Updated readme.

= 1.0 =
Initial version.