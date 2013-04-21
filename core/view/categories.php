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
 * Categories page
 *
 * @return void
 */
function pfm_categories() {
    // Global database class
    global $wpdb;

    // Tables
    $table_foods      = $wpdb->prefix . 'pfm_foods';
    $table_categories = $wpdb->prefix . 'pfm_categories';

    // Save category
    if (!empty($_POST['category_name']))
        $message = pfm_save_category($_POST['category_name'], $_POST['category_id']);

    $isEdit       = false;
    $pageTitle    = __('Categories', 'pfm');
    $formTitle    = __('Add new category', 'pfm');
    $categoryName = '';
    $categoryId   = null;

    if (!empty($_GET['action']) && !empty($_GET['cat'])) {
        $categoryId   = $_GET['cat'];

        if ($_GET['action'] == 'edit') {
            $isEdit       = true;
            $pageTitle    = __('Edit category', 'pfm');
            $formTitle    = __('Edit category', 'pfm');
            $category     = $wpdb->get_results("SELECT * FROM `$table_categories` WHERE `id` = $categoryId");
            $categoryName = $category[0]->name;
        } else if ($_GET['action'] == 'delete') {
            if ($wpdb->query("DELETE FROM `$table_categories` WHERE `id` = $categoryId"))
                $message = __('Category deleted successfully', 'pfm');
            else
                $message = __('The category was not deleted', 'pfm');
        }
    }

    ?>
    <div class="wrap">
        <div class="icon32 icon-appearance"></div>
        <h2><?php _e('Personal Food Menu', 'pfm'); ?> &rsaquo; <?php echo $pageTitle; ?></h2>

        <?php if($message) : ?>
        <div id="message" class="updated"><p><?php echo $message; ?></p></div>
        <?php unset($message); endif; ?>


        <div id="col-container">
            <?php
                // Show categories only if not on the edit page
                if (!$isEdit) :
            ?>
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
                                // Fetch all the categories
                                $categories = $wpdb->get_results("SELECT
                                        `$table_categories`.`id` AS `id`,
                                        `$table_categories`.`name` AS `name`,
                                        (SELECT COUNT(*) FROM `$table_foods` WHERE `$table_foods`.`pfm_category_id` = `$table_categories`.`id` ) AS `foods`
                                    FROM `$table_categories`
                                    ORDER BY `$table_categories`.`name`"
                                );
                                $alt = false;
                                if ( ! empty( $categories ) ) :
                                    foreach ( $categories as $category ) :
                            ?>
                            <tr class="<?php echo ($alt) ? 'alternate' : ''; ?>">
                                <th scope="row" class="check-column">
                                    <label class="screen-reader-text" for="cb-select-<?php echo $category->id; ?>">Select <?php echo $category->name; ?></label>
                                    <input type="checkbox" name="delete_categories[]" value="<?php echo $category->id; ?>" id="cb-select-<?php echo $category->id; ?>">
                                </th>
                                <td class="name column-name">
                                    <strong><a class="row-title" href="admin.php?page=pfm_categories&amp;action=edit&amp;cat=<?php echo $category->id; ?>" title="Edit “<?php echo $category->name; ?>”"><?php echo $category->name; ?></a></strong><br>
                                    <div class="row-actions">
                                        <span class="inline hide-if-no-js"><a href="admin.php?page=pfm_categories&amp;action=edit&amp;cat=<?php echo $category->id; ?>" class="editinline"><?php _e('Edit'); ?></a> | </span>
                                        <span class="delete"><a class="delete-tag" href="admin.php?page=pfm_categories&amp;action=delete&amp;cat=<?php echo $category->id; ?>"><?php _e('Delete'); ?></a></span>

                                    </div>
                                </td>
                                <td class="posts column-posts"><?php echo $category->foods; ?></td>
                            </tr>
                            <?php
                                        $alt = (!$alt) ? true : false;
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
            <?php endif; // ^isEdit ?>

            <!-- Add/Edit Category -->
            <div id="col-left">
                <div class="col-wrap">
                    <h3><?php echo $formTitle; ?></h3>
                    <form id="pfm-save-category" action="admin.php?page=pfm_categories" method="post" class="validate form-wrap">
                        <div class="form-field form-required">
                            <label for="name"><?php _e('Name', 'pfm'); ?></label>
                            <input type="hidden" name="category_id" value="<?php echo $categoryId; ?>">
                            <input name="category_name" id="name" type="text" value="<?php echo $categoryName; ?>" aria-required="true">
                            <p><?php _e('The name of the food category', 'pfm'); ?></p>
                        </div>
                        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php echo $formTitle; ?>"></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        jQuery('#pfm-save-category').on('submit', function(e){
            // Remove validation class
            jQuery(this).find('.form-invalid').removeClass('form-invalid');

            // Validate inputs
            var input = jQuery('#name');
            if (input.val() == '') {
                input.parent().addClass('form-invalid');
                e.preventDefault();
            }
        });

        jQuery(document).on('click', '.delete-tag', function(e){
            if(!confirm("<?php _e('Are you sure you want to delete the category?', 'pfm'); ?>")) {
                e.preventDefault();
                return false;
            }
        })
    </script>
    <?php
}

/**
 * Save the category in the database
 *
 * @param  string  $category The category name
 * @param  integer $id       The category ID, for update
 * @return string
 */
function pfm_save_category($category = null, $id = null) {
    if (!$category)
        return __('Category name required');

    // Global database class
    global $wpdb;

    // Tables
    $table_categories = $wpdb->prefix . 'pfm_categories';

    if ($id !== null)
        $result = $wpdb->query($wpdb->prepare("UPDATE $table_categories SET `name` = %s WHERE `id` = %d", array($category, $id)));
    else
        $result = $wpdb->query($wpdb->prepare("INSERT INTO $table_categories VALUES (NULL, %s)", $category));

    if (!$result)
        return __('Error while saving category, please try again');

    return __('Category saved successfully');
}

/**
 * Delete the category
 *
 * @param  integer $id The category Id
 * @return string
 */
function pfm_delete_category($id = null) {
    if ($id) {
        // Global database class
        global $wpdb;

        // Tables
        $table_categories = $wpdb->prefix . 'pfm_categories';

        if ($wpdb->query($wpdb->prepare("DELETE FROM $table_categories WHERE `id` = %s", $id))) {
            return __('Category deleted successfully');
        } else {
            return __('Error while deleting category, please try again');
        }
    }
    return false;
}

?>