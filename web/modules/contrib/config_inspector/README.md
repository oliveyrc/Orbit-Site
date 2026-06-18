# Configuration Inspector

Configuration Inspector uses the core built-in configuration system as well as
schema system to let you inspect configuration values and the use of schemas
on top of them. This makes it possible to have a developer focused overview of
all your configuration values and do various testing and verification tasks
on your configuration schemas.

## Requirements

This module has no dependencies outside of Drupal core.

## Installation

Install as you would normally install a contributed Drupal module. For further
information, see
[Installing Drupal Modules](https://www.drupal.org/docs/extending-drupal/installing-drupal-modules).

## Usage

The module provides a menu item under Administration » Configuration »
Development » Configuration » Inspect (tab) that lets you inspect
configuration, comparing raw configuration data with schemas; looking
at configuration through the schema in a table of summary, in a tree
view or in a form.

A config:inspect Drush command is also provided to inspect and validate
configuration.

## More information

Read more about the Drupal configuration API at
http://drupal.org/node/1667894 and the schema system at
http://drupal.org/node/1905070