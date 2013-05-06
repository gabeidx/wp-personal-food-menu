<?php
/**
* Calculator
*
* Handles the parsing of the shortcode inside the post body where it's used.
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
 * Calculator
 *
 * @return string
 */
function pfm_calculator() {
    // Get the food list
    $results = pfm_get_food_options();

    if (!empty($results)) :
    ?>
    <table id="pfm-table">
        <thead>
            <tr>
                <th class="col-food">Alimento</th>
                <th class="col-quantity">Quantidade</th>
                <th class="col-quantity">Carboidratos (g)</th>
                <th class="col-quantity">Gordura (g)</th>
                <th class="col-quantity">Kcal</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th align="right">Resultado:</th>
            </tr>
            <tr>
                <td colspan="99"><input type="button" value="Adicionar" class="pfm-add-row"></td>
            </tr>
        </tfoot>
        <tbody>
            <tr class="pfm-row">
                <td class="col-food">
                    <select class="pfm-select">
                        <option value="null">- Selecione -</option>
                        <?php
                            foreach ($results as $category => $foods) {
                                echo '<optgroup label="'. $category .'">';
                                foreach ($foods as $food) {
                                    echo '<option value="'. $food['id'] .'">'. $food["name"] .'</option>';
                                }
                                echo '</optgroup>';
                            }
                        ?>
                    </select>
                </td>
                <td class="col-quantity">
                    <input type="number" name="" id="" value="100" min="50" step="50" class="pfm-quantity-input"> (g)
                </td>
            </tr>
        </tbody>
    </table>
    <?php
    else :
        echo '<p>Nenhum alimento encontrado</p>';
    endif; // ^foods
}

/**
 * Get Food Options
 *
 * @return string
 */
function pfm_get_food_options() {
    // Global database class
    global $wpdb;

    // Tables
    $table_foods      = $wpdb->prefix . 'pfm_foods';
    $table_categories = $wpdb->prefix . 'pfm_categories';

    // Fetch all the foods
    $results = $wpdb->get_results("SELECT `c`.`name` AS 'category', `f` . *
        FROM `$table_foods` AS `f`
            INNER JOIN `$table_categories` AS `c`
                ON `c`.`id` = `f`.`pfm_category_id`
        ORDER BY `c`.`name`
    ", ARRAY_A);

    if (!empty($results)) {
        foreach ($results as $food) {
            $cat = $food['category'];
            unset($food['category']);
            $foods[$cat][] = $food;
        }
    }

    return $foods;
}

?>