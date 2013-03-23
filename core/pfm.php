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
                    'title' => __('Categories', 'pfm'),
                    'capability' => 'manage_options',
                    'menu_slug' => 'pfm_categories',
                    'function' => 'pfm_categories',
                ),
                array(
                    'title' => __('Shortcode', 'pfm'),
                    'capability' => 'manage_options',
                    'menu_slug' => 'pmf_shortcode',
                    'function' => array($this, 'pmf_shortcode')
                ),
            ),
        );

        // Actions
        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );

        // Install
        $this->install();
    }

/**
 * Admin setup
 *
 * @return void
 */
    public function admin_init() {
        // Scripts
        wp_enqueue_script('jquery');

        include_once PFM_DIR . 'core' . DS . 'admin_api.php';

        // Views
        $this->setup_views();
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

/**
 * Setup controllers
 *
 * @return void
 */
    public function setup_views() {
        // Path to controllers folder
        $views_path = PFM_DIR . 'core' . DS . 'view' . DS;

        // Categories
        include_once $views_path . 'categories.php';
    }

/**
 * Install the plugin database
 *
 * @return void
 */
    public function install() {
        $local_db_version = get_option( 'pfm_db_version');
        if ( !$local_db_version || self::$db_version > $local_db_version ) {

            // Global database class
            global $wpdb;

            // Include the database structure
            include PFM_DIR . 'core' . DS . 'database' . DS . 'schema.php';

            // Include WP database upgrade script
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';

            // Create the tables on the database
            foreach ($tables as $table => $sql) {
                $sql = $wpdb->prepare( $sql, $table );
                dbDelta( str_replace('\'', '', $sql) );
            }

            // Insert data into tables
            if ( !get_option( 'pfm_installed' ) ) {
                $this->insert();
                update_option( 'pfm_installed', TRUE );
            }

            // Register the database version
            update_option( 'pfm_db_version', $wpdb->escape(self::$db_version) );
        }
    }

/**
 * Insert default content into the database tables
 *
 * @return void
 */
    public function insert() {
        // Global database class
        global $wpdb;

        // Include the database inserts
        include PFM_DIR . 'core' . DS . 'database' . DS . 'inserts.php';

        // Execute statements
        foreach ( $inserts as $table => $statements ) {
            foreach ($statements as $statement) {
                $wpdb->query( str_replace( array('`\'', '\'`'), '`', $wpdb->prepare( $statement, $table ) ) );
            }
        }
    }
}