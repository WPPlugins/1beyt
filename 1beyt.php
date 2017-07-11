<?php
/*
  Plugin Name: یک بیت شعر
  Plugin URI:http://proappco.com
  Description:  این افزونه یک بیت شعر به صورت تصادفی در هر بار مرور سایت به کاربر نمایش می‌دهد
  Version: 1.1
  Author: Javad Ahshamian
  Author URI:http://proappco.com
  License:GPL 2.0
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;
define( 'OB4WP_DIR', plugin_dir_path( __FILE__ ) );
define( 'OB4WP_INC_DIR', trailingslashit( OB4WP_DIR . 'inc' ) );
define( 'OB4WP_URL', plugin_dir_url( __FILE__ ) );
//includes
require_once (OB4WP_INC_DIR.'widget.php');
require_once (OB4WP_INC_DIR.'ob_shortcode.php');
//hooks
    register_activation_hook(__FILE__,'OB_init');
    add_action('admin_menu', 'ob_admin_pages');
//Functions
function ob_admin_pages()
{
    add_menu_page("یک بیت شعر", "یک بیت شعر", 'manage_options', 'ob_page', 'ob_main', plugin_dir_url( __FILE__ ).'/images/icon.png');
}
function ob_main()
{
    include dirname(__file__)."/help.php";
}

function OB_init()
{
    global $wpdb;
    $query="CREATE TABLE IF NOT EXISTS `poems` (
            `ID` INT(11) NOT NULL AUTO_INCREMENT,
            `Verse1` VARCHAR(512) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
            `Verse2` VARCHAR(512) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
            `Des1`  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
            `Type1` TINYINT(4) NOT NULL DEFAULT '0' ,
            PRIMARY KEY (`ID`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1";
    
    $wpdb->query($query);

    $query = "DELETE FROM `poems` Where `Type1`='0'";
    $wpdb->query($query);

    $lines = file(OB4WP_INC_DIR.'Poems.sql');
    foreach ($lines as $line)
    {
        if(!empty($line) && $line != null && strlen($line) >=1 )
        {
            $line = str_replace('"', '`', $line);
            $wpdb->query($line);
        }
    }
    add_option('ob_paginate_count', 15);
}