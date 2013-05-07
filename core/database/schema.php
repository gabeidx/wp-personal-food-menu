<?php

$tables = array(
    // PFM_FOODS
    $wpdb->prefix . 'pfm_foods' => "CREATE TABLE %s (
      id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT ,
      pfm_category_id BIGINT(20) UNSIGNED NOT NULL ,
      name TEXT NOT NULL ,
      humidity VARCHAR(10) NOT NULL ,
      energy_kcal VARCHAR(10) NOT NULL ,
      energy_kj VARCHAR(10) NOT NULL ,
      protein VARCHAR(10) NOT NULL ,
      lipids VARCHAR(10) NOT NULL ,
      cholesterol VARCHAR(10) NOT NULL ,
      carbohydrates VARCHAR(10) NOT NULL ,
      fiber VARCHAR(10) NOT NULL ,
      ashes VARCHAR(10) NOT NULL ,
      calcium VARCHAR(10) NOT NULL ,
      magnesium VARCHAR(10) NOT NULL ,
      manganese VARCHAR(10) NOT NULL ,
      phosphorus VARCHAR(10) NOT NULL ,
      iron VARCHAR(10) NOT NULL ,
      sodium VARCHAR(10) NOT NULL ,
      potassium VARCHAR(10) NOT NULL ,
      copper VARCHAR(10) NOT NULL ,
      zinc VARCHAR(10) NOT NULL ,
      retinol VARCHAR(10) NOT NULL ,
      re VARCHAR(10) NOT NULL ,
      rae VARCHAR(10) NOT NULL ,
      thiamine VARCHAR(10) NOT NULL ,
      riboflavin VARCHAR(10) NOT NULL ,
      pyridoxine VARCHAR(10) NOT NULL ,
      niacin VARCHAR(10) NOT NULL ,
      vitamin_c VARCHAR(10) NOT NULL ,
      PRIMARY  KEY (id) )
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8
    COLLATE = utf8_general_ci;",

    // PFM_CATEGORIES
    $wpdb->prefix . 'pfm_categories' => "CREATE TABLE %s (
      id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT ,
      name VARCHAR(255) NOT NULL ,
      PRIMARY  KEY (id) )
    ENGINE = InnoDB;",
);