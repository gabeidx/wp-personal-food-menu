<?php
/**
* Main class
*
* PHP 5
*
* WP Personal Food Menu
* Copyright 2013-2013, Mais Musculação. (http://www.maismusculacao.net)
*
* Licensed under The Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License
* Redistributions of files must retain the above copyright notice.
*
* @package      WP Personal Food Menu
* @copyright    Copyright 2013-2013, Mais Musculação.
* @license      CC BY-NC-SA 3.0 License (http://creativecommons.org/licenses/by-nc-sa/3.0/)
*/

class Pfm {

/**
 * Plugin version
 *
 * @var string
 */
    public static $version = '0.1';

/**
 * Plugin database version
 *
 * @var string
 */
    public static $db_version = '1.0.1';

/**
 * Plugin options
 *
 * @var array
 */
    public static $options = array();

/**
 * Constructor
 */
    public function __construct() {
        // Setup options
        $this->options = array(
            'name' => __('Personal Food Menu', 'pmf'),
            'admin' => array(
                array(
                    'title' => __('Shortcode', 'pfm'),
                    'capability' => 'manage_options',
                    'menu_slug' => 'pmf_shortcode',
                    'function' => array($this, 'pmf_shortcode')
                ),
            ),
        );

        $this->init();
    }

/**
 * Initiate the plugin
 *
 * @return void
 */
    public function init() {
        // Actions
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

/**
 * Create the menu itens on the admin
 *
 * @return void
 */
    public function admin_menu() {
        // Add top level menu item
        add_utility_page(
            $this->options['name'],
            $this->options['name'],
            'manage_options',
            'pfm_foods',
            array($this, 'pfm_foods')
        );

        // Add submenus
        foreach ($this->options['admin'] as $page) {
            add_submenu_page(
                'pfm_foods',
                $page['title'],
                $page['title'],
                $page['capability'],
                $page['menu_slug'],
                $page['function']
            );
        }
    }
}