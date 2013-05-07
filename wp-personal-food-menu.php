<?php
/**
 * Plugin Name: WP Personal Food Menu
 * Plugin URI: https://github.com/gabrielizaias/wp-personal-food-menu
 * Description: A plugin that calculates nutritional information based on foods selected by the user.
 * Version: 0.1
 * Author: Gabriel Izaias
 * Author URI: http://gabrielizias.com
 * License: Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported
 */

define('DS', DIRECTORY_SEPARATOR);
define('PFM_DIR', plugin_dir_path(__FILE__));
define('PFM_URL', plugin_dir_url(__FILE__));

include PFM_DIR . 'core' . DS . 'pfm.php';

$pfm = new Pfm();