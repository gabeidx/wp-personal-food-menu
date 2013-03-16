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
 * Plugin options
 *
 * @var array
 */
    private $options;

/**
 * Constructor
 */
    public function __construct() {

        // Setup options
        $this->options = array(
            'options_page' => array(
                'capability' => 'edit_posts',
                'title' => __('Food Menu', 'pfm'),
                'pages' => array(),
            ),
        );
    }
}