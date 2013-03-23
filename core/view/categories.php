<?php
/**
* Categories
*
* Handles the creation and edition of the categories of the plugin content
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
 * Renders the Category page on admin
 *
 * @return void
 */
function pfm_categories() {
    // Global database class
    global $wpdb;

    $table = $wpdb->prefix . 'pfm_categories';



    // Fetch all the categories
    $categories = $wpdb->get_results("SELECT
            `wp_pfm_categories`.`id` AS `id`,
            `wp_pfm_categories`.`name` AS `name`,
            (SELECT COUNT(*) FROM `wp_pfm_foods` WHERE `wp_pfm_foods`.`pfm_category_id` = `wp_pfm_categories`.`id` ) AS `foods`
        FROM `wp_pfm_categories`
        ORDER BY `wp_pfm_categories`.`name`"
    );

    ?>
    <div class="wrap">
        <div class="icon32 icon-appearance"></div>
        <h2><?php _e('Personal Food Menu', 'pfm'); ?> &rsaquo; <?php echo _e('Categories', 'pfm'); ?></h2>
        <header>
            <div class="icon32 icon-appearance"></div>
            <h2><?php _e('Personal Food Menu', 'pfm'); ?> &rsaquo; <?php echo _e('Categories', 'pfm'); ?></h2>
            <br class="clear">
        </header>

        <div id="col-container">
            <!-- Categories -->
            <div id="col-right">
                <div class="col-wrap">
                    <table class="wp-list-table widefat fixed tags">
                        <thead>
                            <tr>
                                <th scope="col" id="cb" class="manage-column column-cb check-column" style="">
                                    <label class="screen-reader-text" for="cb-select-all-1">Select All</label>
                                    <input id="cb-select-all-1" type="checkbox">
                                </th>
                                <th scope="col" class="manage-column column-name sortable desc" style="">
                                    <a href="#"><span><?php _e('Category', 'pfm'); ?></span><span class="sorting-indicator"></span></a>
                                </th>
                                <th scope="col" class="manage-column column-posts num sortable desc" style="">
                                    <a href="#"><span><?php _e('Foods', 'pfm'); ?></span><span class="sorting-indicator"></span></a>
                                </th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th scope="col" class="manage-column column-cb check-column" style="">
                                    <label class="screen-reader-text" for="cb-select-all-2">Select All</label>
                                    <input id="cb-select-all-2" type="checkbox">
                                </th>
                                <th scope="col" class="manage-column column-name sortable desc" style="">
                                    <a href="#"><span><?php _e('Category', 'pfm'); ?></span><span class="sorting-indicator"></span></a>
                                </th>
                                <th scope="col" class="manage-column column-posts num sortable desc" style="">
                                    <a href="#"><span><?php _e('Foods', 'pfm'); ?></span><span class="sorting-indicator"></span></a>
                                </th>
                            </tr>
                        </tfoot>
                        <tbody id="the-list">
                            <?php
                                if ( ! empty( $categories ) ) :
                                    foreach ( $categories as $category ) :
                            ?>
                            <tr>
                                <th scope="row" class="check-column">
                                    <label class="screen-reader-text" for="cb-select-<?php echo $category->id; ?>">Select <?php echo $category->name; ?></label>
                                    <input type="checkbox" name="delete_categories[]" value="<?php echo $category->id; ?>" id="cb-select-<?php echo $category->id; ?>">
                                </th>
                                <td class="name column-name">
                                    <strong><a class="row-title" href="#" title="Edit “<?php echo $category->name; ?>”"><?php echo $category->name; ?></a></strong><br>
                                    <div class="row-actions">
                                        <span class="inline hide-if-no-js"><a href="#" class="editinline"><?php _e('Edit'); ?></a> | </span>
                                        <span class="delete"><a class="delete-tag" href="#"><?php _e('Delete'); ?></a></span>
                                    </div>
                                </td>
                                <td class="posts column-posts"><?php echo $category->foods; ?></td>
                            </tr>
                            <?php
                                    endforeach;
                                else :
                            ?>
                            <tr>
                                <td colspan="3"><?php _e('No categories found'); ?></td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    <?php
}

?>