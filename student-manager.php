<?php
/**
 * Plugin Name: Student Manager
 * Plugin URI:  https://github.com/laison25/student-manager
 * Description: Plugin quản lý sinh viên: tạo Custom Post Type Sinh viên, nhập thông tin MSSV, lớp/chuyên ngành, ngày sinh và hiển thị danh sách bằng shortcode.
 * Version:     1.0.0
 * Author:      Lại Sơn
 * Author URI:  https://laison.fwh.is
 * Text Domain: student-manager
 */

if (!defined('ABSPATH')) {
    exit;
}

define('SM_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('SM_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once SM_PLUGIN_PATH . 'includes/class-student-cpt.php';
require_once SM_PLUGIN_PATH . 'includes/class-student-metabox.php';
require_once SM_PLUGIN_PATH . 'includes/class-student-shortcode.php';

function sm_init_plugin() {
    new SM_Student_CPT();
    new SM_Student_Metabox();
    new SM_Student_Shortcode();
}
add_action('plugins_loaded', 'sm_init_plugin');

function sm_activate_plugin() {
    $cpt = new SM_Student_CPT();
    $cpt->register_post_type();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'sm_activate_plugin');

function sm_deactivate_plugin() {
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'sm_deactivate_plugin');
