<?php
/**
* Shortcode
*
* Handles the shortcode admin page and parsing of the shortcode inside the post
* page where the shortcode is used.
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

/**
 * Shortcode page
 *
 * @return void
 */
function pfm_shortcode() {
    ?>
    <div class="wrap">
        <div class="icon32 icon-appearance"></div>
        <h2><?php _e('Personal Food Menu', 'pfm'); ?> &rsaquo; <?php _e('Shortcode', 'pfm'); ?></h2>
        <p><?php _e('Copy this code and paste it into your post, page or text widget content.'); ?></p>
        <input type="text" name="shortcode" id="shortcode-input" value="[pfm_calculator]" autofocus onkeypress="return false;">
    </div>
    <?php
}

?>