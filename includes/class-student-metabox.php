<?php
if (!defined('ABSPATH')) {
    exit;
}

class SM_Student_Metabox {
    private $classes = [
        'CNTT'      => 'Công nghệ thông tin',
        'Kinh tế'   => 'Kinh tế',
        'Marketing' => 'Marketing',
    ];

    public function __construct() {
        add_action('add_meta_boxes', [$this, 'add_student_metabox']);
        add_action('save_post_sm_student', [$this, 'save_student_meta']);
    }

    public function add_student_metabox() {
        add_meta_box(
            'sm_student_info',
            'Thông tin sinh viên',
            [$this, 'render_student_metabox'],
            'sm_student',
            'normal',
            'high'
        );
    }

    public function render_student_metabox($post) {
        wp_nonce_field('sm_save_student_meta', 'sm_student_meta_nonce');

        $mssv      = get_post_meta($post->ID, '_sm_mssv', true);
        $class     = get_post_meta($post->ID, '_sm_class', true);
        $birthdate = get_post_meta($post->ID, '_sm_birthdate', true);
        ?>
        <table class="form-table">
            <tr>
                <th><label for="sm_mssv">Mã số sinh viên (MSSV)</label></th>
                <td>
                    <input type="text" id="sm_mssv" name="sm_mssv" value="<?php echo esc_attr($mssv); ?>" class="regular-text" placeholder="Ví dụ: 23810310088">
                </td>
            </tr>
            <tr>
                <th><label for="sm_class">Lớp/Chuyên ngành</label></th>
                <td>
                    <select id="sm_class" name="sm_class">
                        <option value="">-- Chọn lớp/chuyên ngành --</option>
                        <?php foreach ($this->classes as $value => $label) : ?>
                            <option value="<?php echo esc_attr($value); ?>" <?php selected($class, $value); ?>>
                                <?php echo esc_html($label); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="sm_birthdate">Ngày sinh</label></th>
                <td>
                    <input type="date" id="sm_birthdate" name="sm_birthdate" value="<?php echo esc_attr($birthdate); ?>">
                </td>
            </tr>
        </table>
        <?php
    }

    public function save_student_meta($post_id) {
        if (!isset($_POST['sm_student_meta_nonce'])) {
            return;
        }

        if (!wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['sm_student_meta_nonce'])), 'sm_save_student_meta')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        if (isset($_POST['sm_mssv'])) {
            update_post_meta($post_id, '_sm_mssv', sanitize_text_field(wp_unslash($_POST['sm_mssv'])));
        }

        if (isset($_POST['sm_class'])) {
            $class = sanitize_text_field(wp_unslash($_POST['sm_class']));
            $allowed_classes = array_keys($this->classes);
            if (in_array($class, $allowed_classes, true)) {
                update_post_meta($post_id, '_sm_class', $class);
            } else {
                delete_post_meta($post_id, '_sm_class');
            }
        }

        if (isset($_POST['sm_birthdate'])) {
            $birthdate = sanitize_text_field(wp_unslash($_POST['sm_birthdate']));
            if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $birthdate)) {
                update_post_meta($post_id, '_sm_birthdate', $birthdate);
            } else {
                delete_post_meta($post_id, '_sm_birthdate');
            }
        }
    }
}
