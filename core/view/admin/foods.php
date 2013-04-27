<?php
/**
* Foods
*
* Handles the creation and edition of the foods of the plugin content
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
 * Foods page
 *
 * @return void
 */
function pfm_foods() {
    // Global database class
    global $wpdb;

    // Tables
    $table_foods      = $wpdb->prefix . 'pfm_foods';
    $table_categories = $wpdb->prefix . 'pfm_categories';
    ?>
    <div class="wrap">
        <div class="icon32 icon-appearance"></div>
        <h2><?php _e('Personal Food Menu', 'pfm'); ?> <a href="?page=pfm_add_food" class="add-new-h2"><?php _e('Add new food'); ?></a></h2>

        <?php if($message) : ?>
        <div id="message" class="updated"><p><?php echo $message; ?></p></div>
        <?php unset($message); endif; ?>

        <br class="clear">

        <table class="wp-list-table widefat fixed tags">
            <thead>
                <tr>
                    <th scope="col" id="cb" class="manage-column column-cb check-column" style="">
                        <label class="screen-reader-text" for="cb-select-all-1">Select All</label>
                        <input id="cb-select-all-1" type="checkbox">
                    </th>
                    <th scope="col" class="manage-column column-name" style=""><span><?php _e('Food', 'pfm'); ?></span></th>
                    <th scope="col" class="manage-column column-parent" style=""><span><?php _e('Energy (kcal)', 'pfm'); ?></span></th>
                    <th scope="col" class="manage-column column-parent" style=""><span><?php _e('Protein', 'pfm'); ?></span></th>
                    <th scope="col" class="manage-column column-parent" style=""><span><?php _e('Lipids', 'pfm'); ?></span></th>
                    <th scope="col" class="manage-column column-parent" style=""><span><?php _e('Carbohydrates', 'pfm'); ?></span></th>
                    <th scope="col" class="manage-column column-parent" style=""><span><?php _e('Fiber', 'pfm'); ?></span></th>
                    <th scope="col" class="manage-column column-parent" style=""><span><?php _e('RE', 'pfm'); ?></span></th>
                    <th scope="col" class="manage-column column-parent" style=""><span><?php _e('RAE', 'pfm'); ?></span></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th scope="col" class="manage-column column-cb check-column" style="">
                        <label class="screen-reader-text" for="cb-select-all-2">Select All</label>
                        <input id="cb-select-all-2" type="checkbox">
                    </th>
                    <th scope="col" class="manage-column column-name" style=""><span><?php _e('Food', 'pfm'); ?></span></th>
                    <th scope="col" class="manage-column column-parent" style=""><span><?php _e('Energy (kcal)', 'pfm'); ?></span></th>
                    <th scope="col" class="manage-column column-parent" style=""><span><?php _e('Protein', 'pfm'); ?></span></th>
                    <th scope="col" class="manage-column column-parent" style=""><span><?php _e('Lipids', 'pfm'); ?></span></th>
                    <th scope="col" class="manage-column column-parent" style=""><span><?php _e('Carbohydrates', 'pfm'); ?></span></th>
                    <th scope="col" class="manage-column column-parent" style=""><span><?php _e('Fiber', 'pfm'); ?></span></th>
                    <th scope="col" class="manage-column column-parent" style=""><span><?php _e('RE', 'pfm'); ?></span></th>
                    <th scope="col" class="manage-column column-parent" style=""><span><?php _e('RAE', 'pfm'); ?></span></th>
                </tr>
            </tfoot>
            <tbody id="the-list">
                <?php
                    // Fetch all the foods
                    $foods = $wpdb->get_results("SELECT * FROM `$table_foods` ORDER BY `$table_foods`.`name`");
                    $alt = false;
                    if ( ! empty( $foods ) ) :
                        foreach ( $foods as $food ) :
                ?>
                <tr class="<?php echo ($alt) ? 'alternate' : ''; ?>">
                    <th scope="row" class="check-column">
                        <label class="screen-reader-text" for="cb-select-<?php echo $food->id; ?>">Select <?php echo $food->name; ?></label>
                        <input type="checkbox" name="delete_categories[]" value="<?php echo $food->id; ?>" id="cb-select-<?php echo $food->id; ?>">
                    </th>
                    <td class="name column-name">
                        <strong><a class="row-title" href="admin.php?page=pfm_add_food&amp;action=edit&amp;food=<?php echo $food->id; ?>" title="Edit “<?php echo $food->name; ?>”"><?php echo $food->name; ?></a></strong><br>
                        <div class="row-actions">
                            <span class="inline hide-if-no-js"><a href="admin.php?page=pfm_add_food&amp;action=edit&amp;food=<?php echo $food->id; ?>" class="editinline"><?php _e('Edit'); ?></a> | </span>
                            <span class="delete"><a class="delete-tag" href="admin.php?page=pfm_add_food&amp;action=delete&amp;food=<?php echo $food->id; ?>"><?php _e('Delete'); ?></a></span>
                        </div>
                    </td>
                    <td class="posts column-parent"><?php echo $food->energy_kcal; ?></td>
                    <td class="posts column-parent"><?php echo $food->protein; ?></td>
                    <td class="posts column-parent"><?php echo $food->lipids; ?></td>
                    <td class="posts column-parent"><?php echo $food->carbohydrates; ?></td>
                    <td class="posts column-parent"><?php echo $food->fiber; ?></td>
                    <td class="posts column-parent"><?php echo $food->re; ?></td>
                    <td class="posts column-parent"><?php echo $food->rae; ?></td>
                </tr>
                <?php
                            $alt = (!$alt) ? true : false;
                        endforeach;
                    else :
                ?>
                <tr>
                    <td colspan="9"><?php _e('No food found'); ?></td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

/**
 * Add food
 *
 * @return void
 */
function pfm_add_food() {
    // Global database class
    global $wpdb;

    // Tables
    $table_foods      = $wpdb->prefix . 'pfm_foods';
    $table_categories = $wpdb->prefix . 'pfm_categories';

    $isEdit       = false;
    $pageTitle    = __('Add new food', 'pfm');
    $foodId       = null;
    $categories   = $wpdb->get_results("SELECT * FROM `$table_categories` ORDER BY `name`");

    if (!empty($_POST['food']))
        $message = pfm_save_food($_POST['food']);

    if (!empty($_GET['food']) || !empty($_POST['food']['id'])) {
        $foodId        = (!empty($_GET['food'])) ? $_GET['food'] : $_POST['food']['id'];
        $isEdit        = true;
        $pageTitle     = __('Edit food', 'pfm');
        $food          = $wpdb->get_results("SELECT * FROM `$table_foods` WHERE `id` = $foodId", ARRAY_A);
        $_POST['food'] = $food[0];
    }
    ?>
    <div class="wrap">
        <div class="icon32 icon-appearance"></div>
        <h2><?php _e('Personal Food Menu', 'pfm'); ?> &rsaquo; <?php echo $pageTitle; ?></h2>

        <?php if($message) : ?>
        <div id="message" class="updated"><p><?php echo $message; ?></p></div>
        <?php unset($message); endif; ?>

        <br class="clear">
        <div id="poststuff">
            <div id="post-body" class="metabox-holder columns-2">
                <form id="save-food" action="admin.php?page=pfm_add_food" method="post">
                    <!-- ID -->
                    <input type="hidden" name="food[id]" value="<?php echo $foodId; ?>">

                    <div id="post-body-content">
                        <!-- Title -->
                        <div id="titlediv">
                            <div id="titlewrap">
                                <input type="text" name="food[name]" size="30" value="<?php echo $_POST['food']['name']; ?>" id="title" autofocus autocomplete="off" placeholder="<?php _e('Food name', 'pfm'); ?>">
                            </div>
                        </div>
                    </div>

                    <div id="postbox-container-1" class="postbox-container">
                        <div id="side-sortables" class="meta-box-sortables ui-sortable">
                            <!-- Submit -->
                            <div id="submitdiv" class="postbox pfm_postbox">
                                <div class="handlediv" title="Click to toggle"><br></div>
                                <h3 class="hndle"><span><?php _e('Publish', 'pfm'); ?></span></h3>
                                <div class="inside">
                                    <div id="submitbox" class="submitpost">
                                        <p><input type="submit" class="button button-primary button-large" value="<?php echo $pageTitle; ?>"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="postbox-container-2" class="postbox-container">
                        <div class="postbox pfm_postbox">
                            <div class="handlediv" title="Click to toggle"><br></div>
                            <h3 class="hndle"><span><?php _e('Food attributes', 'pfm'); ?></span></h3>
                            <div class="inside">
                                <div class="field">
                                    <p class="label"><label for="humidity"><?php _e('Humidity', 'pfm'); ?></label></p>
                                    <input type="text" name="food[humidity]" id="humidity" value="<?php echo $_POST['food']['humidity']; ?>">
                                </div>
                                <div class="field">
                                    <p class="label"><label for="energy_kcal"><?php _e('Energy (kcal)', 'pfm'); ?></label></p>
                                    <input type="text" name="food[energy_kcal]" id="energy_kcal" value="<?php echo $_POST['food']['energy_kcal']; ?>">
                                </div>
                                <div class="field">
                                    <p class="label"><label for="energy_kj"><?php _e('Energy (kj)', 'pfm'); ?></label></p>
                                    <input type="text" name="food[energy_kj]" id="energy_kj" value="<?php echo $_POST['food']['energy_kj']; ?>">
                                </div>
                                <div class="field">
                                    <p class="label"><label for="protein"><?php _e('Protein', 'pfm'); ?></label></p>
                                    <input type="text" name="food[protein]" id="protein" value="<?php echo $_POST['food']['protein']; ?>">
                                </div>
                                <div class="field">
                                    <p class="label"><label for="lipids"><?php _e('Lipids', 'pfm'); ?></label></p>
                                    <input type="text" name="food[lipids]" id="lipids" value="<?php echo $_POST['food']['lipids']; ?>">
                                </div>
                                <div class="field">
                                    <p class="label"><label for="cholesterol"><?php _e('Cholesterol', 'pfm'); ?></label></p>
                                    <input type="text" name="food[cholesterol]" id="cholesterol" value="<?php echo $_POST['food']['cholesterol']; ?>">
                                </div>
                                <div class="field">
                                    <p class="label"><label for="carbohydrates"><?php _e('Carbohydrates', 'pfm'); ?></label></p>
                                    <input type="text" name="food[carbohydrates]" id="carbohydrates" value="<?php echo $_POST['food']['carbohydrates']; ?>">
                                </div>
                                <div class="field">
                                    <p class="label"><label for="fiber"><?php _e('Fiber', 'pfm'); ?></label></p>
                                    <input type="text" name="food[fiber]" id="fiber" value="<?php echo $_POST['food']['fiber']; ?>">
                                </div>
                                <div class="field">
                                    <p class="label"><label for="ashes"><?php _e('Ashes', 'pfm'); ?></label></p>
                                    <input type="text" name="food[ashes]" id="ashes" value="<?php echo $_POST['food']['ashes']; ?>">
                                </div>
                                <div class="field">
                                    <p class="label"><label for="calcium"><?php _e('Calcium', 'pfm'); ?></label></p>
                                    <input type="text" name="food[calcium]" id="calcium" value="<?php echo $_POST['food']['calcium']; ?>">
                                </div>
                                <div class="field">
                                    <p class="label"><label for="magnesium"><?php _e('Magnesium', 'pfm'); ?></label></p>
                                    <input type="text" name="food[magnesium]" id="magnesium" value="<?php echo $_POST['food']['magnesium']; ?>">
                                </div>
                                <div class="field">
                                    <p class="label"><label for="manganese"><?php _e('Manganese', 'pfm'); ?></label></p>
                                    <input type="text" name="food[manganese]" id="manganese" value="<?php echo $_POST['food']['manganese']; ?>">
                                </div>
                                <div class="field">
                                    <p class="label"><label for="phosphorus"><?php _e('Phosphorus', 'pfm'); ?></label></p>
                                    <input type="text" name="food[phosphorus]" id="phosphorus" value="<?php echo $_POST['food']['phosphorus']; ?>">
                                </div>
                                <div class="field">
                                    <p class="label"><label for="iron"><?php _e('Iron', 'pfm'); ?></label></p>
                                    <input type="text" name="food[iron]" id="iron" value="<?php echo $_POST['food']['iron']; ?>">
                                </div>
                                <div class="field">
                                    <p class="label"><label for="sodium"><?php _e('Sodium', 'pfm'); ?></label></p>
                                    <input type="text" name="food[sodium]" id="sodium" value="<?php echo $_POST['food']['sodium']; ?>">
                                </div>
                                <div class="field">
                                    <p class="label"><label for="potassium"><?php _e('Potassium', 'pfm'); ?></label></p>
                                    <input type="text" name="food[potassium]" id="potassium" value="<?php echo $_POST['food']['potassium']; ?>">
                                </div>
                                <div class="field">
                                    <p class="label"><label for="copper"><?php _e('Copper', 'pfm'); ?></label></p>
                                    <input type="text" name="food[copper]" id="copper" value="<?php echo $_POST['food']['copper']; ?>">
                                </div>
                                <div class="field">
                                    <p class="label"><label for="zinc"><?php _e('Zinc', 'pfm'); ?></label></p>
                                    <input type="text" name="food[zinc]" id="zinc" value="<?php echo $_POST['food']['zinc']; ?>">
                                </div>
                                <div class="field">
                                    <p class="label"><label for="retinol"><?php _e('Retinol', 'pfm'); ?></label></p>
                                    <input type="text" name="food[retinol]" id="retinol" value="<?php echo $_POST['food']['retinol']; ?>">
                                </div>
                                <div class="field">
                                    <p class="label"><label for="re"><?php _e('RE', 'pfm'); ?></label></p>
                                    <input type="text" name="food[re]" id="re" value="<?php echo $_POST['food']['re']; ?>">
                                </div>
                                <div class="field">
                                    <p class="label"><label for="rae"><?php _e('RAE', 'pfm'); ?></label></p>
                                    <input type="text" name="food[rae]" id="rae" value="<?php echo $_POST['food']['rae']; ?>">
                                </div>
                                <div class="field">
                                    <p class="label"><label for="thiamine"><?php _e('Thiamine', 'pfm'); ?></label></p>
                                    <input type="text" name="food[thiamine]" id="thiamine" value="<?php echo $_POST['food']['thiamine']; ?>">
                                </div>
                                <div class="field">
                                    <p class="label"><label for="riboflavin"><?php _e('Riboflavin', 'pfm'); ?></label></p>
                                    <input type="text" name="food[riboflavin]" id="riboflavin" value="<?php echo $_POST['food']['riboflavin']; ?>">
                                </div>
                                <div class="field">
                                    <p class="label"><label for="pyridoxine"><?php _e('Pyridoxine', 'pfm'); ?></label></p>
                                    <input type="text" name="food[pyridoxine]" id="pyridoxine" value="<?php echo $_POST['food']['pyridoxine']; ?>">
                                </div>
                                <div class="field">
                                    <p class="label"><label for="niacin"><?php _e('Niacin', 'pfm'); ?></label></p>
                                    <input type="text" name="food[niacin]" id="niacin" value="<?php echo $_POST['food']['niacin']; ?>">
                                </div>
                                <div class="field">
                                    <p class="label"><label for="vitamin_c"><?php _e('Vitamin C', 'pfm'); ?></label></p>
                                    <input type="text" name="food[vitamin_c]" id="vitamin_c" value="<?php echo $_POST['food']['vitamin_c']; ?>">
                                </div>
                            </div>
                        </div>

                        <?php if (!empty($categories)) : ?>
                        <div class="postbox pfm_postbox">
                            <div class="handlediv" title="Click to toggle"><br></div>
                            <h3 class="hndle"><span><?php _e('Category', 'pfm'); ?></span></h3>
                            <div class="inside">
                                <?php foreach ($categories as $category) : ?>
                                <div class="field">
                                    <input type="radio" name="food[pfm_category_id]" <?php echo ($_POST['food']['pfm_category_id'] == $category->id) ? 'checked' : ''; ?> id="pfm_category_id-<?php echo $category->id; ?>" value="<?php echo $category->id; ?>">&nbsp;&nbsp;<label for="pfm_category_id-<?php echo $category->id; ?>"><?php echo $category->name; ?></label>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Save the food in the database
 *
 * @param  string  $food     The food name
 * @param  integer $id       The food ID, for update
 * @return string
 */
function pfm_save_food($food = array()) {
    if (empty($food['name']))
        return __('Food name required');

    if (empty($food['pfm_category_id']))
        return __('Category required');

    extract($food);

    // Global database class
    global $wpdb;

    // Tables
    $table_foods = $wpdb->prefix . 'pfm_foods';

    if (!empty($food['id'])) {
        $result = $wpdb->query($wpdb->prepare("UPDATE $table_foods SET
            `pfm_category_id` = %d,
            `name` = %s,
            `humidity` = %s,
            `energy_kcal` = %s,
            `energy_kj` = %s,
            `protein` = %s,
            `lipids` = %s,
            `cholesterol` = %s,
            `carbohydrates` = %s,
            `fiber` = %s,
            `ashes` = %s,
            `calcium` = %s,
            `magnesium` = %s,
            `manganese` = %s,
            `phosphorus` = %s,
            `iron` = %s,
            `sodium` = %s,
            `potassium` = %s,
            `copper` = %s,
            `zinc` = %s,
            `retinol` = %s,
            `re` = %s,
            `rae` = %s,
            `thiamine` = %s,
            `riboflavin` = %s,
            `pyridoxine` = %s,
            `niacin` = %s,
            `vitamin_c` = %s
        WHERE `id` = %d", array(
            $pfm_category_id, $name, $humidity, $energy_kcal, $energy_kj, $protein, $lipids, $cholesterol, $carbohydrates,
            $fiber, $ashes, $calcium, $magnesium, $manganese, $phosphorus, $iron, $sodium, $potassium, $copper, $zinc, $retinol,
            $re, $rae, $thiamine, $riboflavin, $pyridoxine, $niacin, $vitamin_c, $food['id'],
        )));
    } else {
        $result = $wpdb->query($wpdb->prepare("INSERT INTO $table_foods VALUES (
            NULL, %d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s
        )", array(
            $pfm_category_id, $name, $humidity, $energy_kcal, $energy_kj, $protein, $lipids, $cholesterol, $carbohydrates,
            $fiber, $ashes, $calcium, $magnesium, $manganese, $phosphorus, $iron, $sodium, $potassium, $copper, $zinc, $retinol,
            $re, $rae, $thiamine, $riboflavin, $pyridoxine, $niacin, $vitamin_c,
        )));
    }

    if (!$result)
        return __('Error while saving food, please try again');

    return __('Food saved successfully');
}
?>