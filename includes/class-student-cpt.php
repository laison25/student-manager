<?php
if (!defined('ABSPATH')) {
    exit;
}

class SM_Student_CPT {
    public function __construct() {
        add_action('init', [$this, 'register_post_type']);
    }

    public function register_post_type() {
        $labels = [
            'name'               => 'Sinh viên',
            'singular_name'      => 'Sinh viên',
            'menu_name'          => 'Sinh viên',
            'name_admin_bar'     => 'Sinh viên',
            'add_new'            => 'Thêm mới',
            'add_new_item'       => 'Thêm sinh viên mới',
            'new_item'           => 'Sinh viên mới',
            'edit_item'          => 'Sửa sinh viên',
            'view_item'          => 'Xem sinh viên',
            'all_items'          => 'Tất cả sinh viên',
            'search_items'       => 'Tìm sinh viên',
            'not_found'          => 'Không tìm thấy sinh viên',
            'not_found_in_trash' => 'Không có sinh viên trong thùng rác',
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'menu_position'      => 5,
            'menu_icon'          => 'dashicons-welcome-learn-more',
            'supports'           => ['title', 'editor'],
            'has_archive'        => true,
            'rewrite'            => ['slug' => 'sinh-vien'],
            'show_in_rest'       => true,
        ];

        register_post_type('sm_student', $args);
    }
}
