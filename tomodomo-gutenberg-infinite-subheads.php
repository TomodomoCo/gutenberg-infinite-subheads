<?php
/**
 * Plugin Name: Tomodomo › Gutenberg › Infinite Subheads
 * Plugin URI: https://tomodomo.co/
 * Description: Insert as many core subhead blocks into your Gutenberg post as your heart desires
 * Author: Tomodomo
 * Author URI: https://tomodomo.co/
 * Version: 1.0
 * Text Domain: infinite-subheads
 * License: MIT
 */

add_action('admin_enqueue_scripts', function () {
	$script = <<<JS
function supportMultipleSubheads( settings, name ) {
    if ( name !== 'core/subhead' ) {
        return settings;
    }

    return Object.assign( {}, settings, {
        supports: Object.assign( {}, settings.supports, {
            multiple: true
        } ),
    } );
}

wp.hooks.addFilter(
    'blocks.registerBlockType',
    'tomodomo/infinite-subheads',
    supportMultipleSubheads
);
JS;

	wp_add_inline_script('wp-hooks', $script);
});
