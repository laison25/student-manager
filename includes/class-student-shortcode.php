<?php
if (!defined('ABSPATH')) {
    exit;
}

class SM_Student_Shortcode {
    public function __construct() {
        add_shortcode('danh_sach_sinh_vien', [$this, 'render_student_list']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
    }

    public function enqueue_assets() {
        wp_register_style(
            'sm-student-style',
            SM_PLUGIN_URL . 'assets/student-manager.css',
            [],
            '1.0.0'
        );
    }

    public function render_student_list() {
        wp_enqueue_style('sm-student-style');

        $query = new WP_Query([
            'post_type'      => 'sm_student',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        ]);

        ob_start();
        ?>
        <div class="sm-student-wrapper">
            <h2>Danh sách sinh viên</h2>
            <table class="sm-student-table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>MSSV</th>
                        <th>Họ tên</th>
                        <th>Lớp</th>
                        <th>Ngày sinh</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($query->have_posts()) : ?>
                        <?php $index = 1; ?>
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <?php
                            $student_id = get_the_ID();
                            $mssv = get_post_meta($student_id, '_sm_mssv', true);
                            $class = get_post_meta($student_id, '_sm_class', true);
                            $birthdate = get_post_meta($student_id, '_sm_birthdate', true);
                            $display_birthdate = $birthdate ? date_i18n('d/m/Y', strtotime($birthdate)) : '';
                            ?>
                            <tr>
                                <td><?php echo esc_html($index); ?></td>
                                <td><?php echo esc_html($mssv); ?></td>
                                <td><?php echo esc_html(get_the_title()); ?></td>
                                <td><?php echo esc_html($class); ?></td>
                                <td><?php echo esc_html($display_birthdate); ?></td>
                            </tr>
                            <?php $index++; ?>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5">Chưa có dữ liệu sinh viên.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php
        wp_reset_postdata();
        return ob_get_clean();
    }
}
