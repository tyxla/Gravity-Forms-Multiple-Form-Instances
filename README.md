# Gravity Forms: Multiple Form Instances

[![Build Status](https://travis-ci.org/tyxla/Gravity-Forms-Multiple-Form-Instances.svg?branch=master)](https://travis-ci.org/tyxla/Gravity-Forms-Multiple-Form-Instances) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/tyxla/Gravity-Forms-Multiple-Form-Instances/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/tyxla/Gravity-Forms-Multiple-Form-Instances/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/tyxla/Gravity-Forms-Multiple-Form-Instances/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/tyxla/Gravity-Forms-Multiple-Form-Instances/?branch=master)

-----

#### About

**Gravity Forms: Multiple Form Instances** is a small plugin for WordPress.

Used in conjunction with the awesome [Gravity Forms](http://www.gravityforms.com/) plugin.

Allows multiple instances of the same form to be displayed on a single page when using AJAX.

-----

#### Installation & Configuration

This plugin does not need any customization. 

Simply install and activate it, and it will do its magic with your Gravity Forms.

-----

#### How It Works

In order for the magic to work, various occurences of the form ID are replaced with a random ID when rendering the form. This allows for multiple instances of the same form to be submitted without having the issue of submitting form B when submitting form A. 

If a form has already been submitted, the submitted random ID will be preserved and used for the next submissions as well, otherwise a new unique ID is generated.

-----

#### Customization (actions & filters)

The plugin uses the default `gform_get_form_filter` Gravity Forms filter for performing the replacement.

Additionally, the plugin offers the following actions & filters:

##### gform\_multiple\_instances\_strings

**$strings**   *(array)*. An array of find => replace pairs. Occurences of "key" will be replaced with the corresponding "value".

**$form_id**   *(int)*.   The original form id.

**$random_id** *(int)*.   The new, randomly generated form id.

This filter allows you to modify the default strings that will be replaced. The keys are the original strings, and the corresponding values are the strings that keys will be replaced with.