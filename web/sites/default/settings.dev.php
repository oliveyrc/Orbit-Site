<?php

// phpcs:ignoreFile

/**
 * Enable local development services.
 */
$settings['container_yamls'][] = DRUPAL_ROOT . '/sites/development.services.yml';

/**
 * Show all error messages, with backtrace information.
 */
$config['system.logging']['error_level'] = 'verbose';

/**
 * Disable CSS and JS aggregation.
 */
$config['system.performance']['css']['preprocess'] = FALSE;
$config['system.performance']['js']['preprocess'] = FALSE;

/**
 * Disable the render cache.
 */
$settings['cache']['bins']['render'] = 'cache.backend.null';

/**
 * Disable caching for migrations.
 */
# $settings['cache']['bins']['discovery_migration'] = 'cache.backend.memory';

/**
 * Disable Internal Page Cache.
 */
$settings['cache']['bins']['page'] = 'cache.backend.null';

/**
 * Disable Dynamic Page Cache.
 */
$settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';

/**
 * Allow test modules and themes to be installed.
 */
# $settings['extension_discovery_scan_tests'] = TRUE;

/**
 * Enable access to rebuild.php.
 */
$settings['rebuild_access'] = TRUE;

/**
 * Skip file system permissions hardening.
 */
$settings['skip_permissions_hardening'] = TRUE;

/**
 * Exclude modules from configuration synchronization.
 */
$settings['config_exclude_modules'] = ['devel', 'devel_generate', 'devel_kint_extras', 'stage_file_proxy', 'update', 'upgrade_status', 'oyster_development_tools'];

/**
 * Disable AdvAgg.
 */
$config['advagg.settings']['enabled'] = FALSE;

/**
 * Allow access to update.php
 */
$settings['update_free_access'] = TRUE;

/**
 * Stage file proxy
 */
$config['stage_file_proxy.settings']['origin'] = ''; //add domain here
$config['stage_file_proxy.settings']['verify'] = false;

/**
 * Environment Indicator
 */
$config['environment_indicator.indicator']['fg_color'] = '#ffffff';
$config['environment_indicator.indicator']['bg_color'] = '#00aa00';
$config['environment_indicator.indicator']['name'] = 'Development ' . phpversion();

/**
 * Private files Directory
 */
// $settings['file_private_path'] = '/app/private';

/**
 * Config sync directory
 */
$settings['config_sync_directory'] = '../config/sync';

/**
* Symfony Mailer override
* Ensure that the mail transport is setup first
*/
$config['symfony_mailer.settings']['default_transport'] = 'mailhog_local_development_only_';

// Disable captcha on login page
$config['captcha.captcha_point.user_login_form']['status'] = FALSE;


/**
 * Disable captcha on forms.
 */
$config['captcha.captcha_point.user_login_form']['status'] = FALSE;
