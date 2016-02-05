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