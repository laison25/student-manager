# Student Manager Plugin

## 1. Giới thiệu

**Student Manager** là plugin WordPress dùng để quản lý danh sách sinh viên. Plugin tạo một Custom Post Type tên **Sinh viên**, cho phép nhập thông tin sinh viên ở trang quản trị và hiển thị danh sách sinh viên ra giao diện người dùng bằng shortcode.

## 2. Chức năng chính

### Backend

- Tạo menu **Sinh viên** trong trang quản trị WordPress.
- Hỗ trợ nhập:
  - Họ tên sinh viên qua trường **Title**.
  - Tiểu sử/Ghi chú qua trường **Editor**.
- Tạo Custom Meta Box gồm:
  - Mã số sinh viên **MSSV**.
  - Lớp/Chuyên ngành: **CNTT, Kinh tế, Marketing**.
  - Ngày sinh.
- Lưu dữ liệu an toàn bằng:
  - `wp_nonce_field()` và `wp_verify_nonce()`.
  - `sanitize_text_field()`.
  - `wp_unslash()`.
  - Kiểm tra quyền `current_user_can()`.

### Frontend

- Cung cấp shortcode:

```text
[danh_sach_sinh_vien]
```

- Khi chèn shortcode vào Page/Post, hệ thống hiển thị bảng gồm các cột:
  - STT
  - MSSV
  - Họ tên
  - Lớp
  - Ngày sinh

## 3. Cấu trúc thư mục

```text
student-manager/
├── student-manager.php
├── includes/
│   ├── class-student-cpt.php
│   ├── class-student-metabox.php
│   └── class-student-shortcode.php
├── assets/
│   └── student-manager.css
└── README.md
```

## 4. Hướng dẫn cài đặt

1. Copy thư mục `student-manager` vào:

```text
wp-content/plugins/
```

2. Vào trang quản trị WordPress.
3. Chọn **Plugins**.
4. Kích hoạt plugin **Student Manager**.
5. Vào menu **Sinh viên** để thêm dữ liệu sinh viên.
6. Tạo một Page mới, ví dụ: **Danh sách sinh viên**.
7. Dán shortcode sau vào nội dung Page:

```text
[danh_sach_sinh_vien]
```

8. Xuất bản Page và xem kết quả ngoài frontend.

## 5. Ảnh chụp kết quả

> Chèn ảnh chụp màn hình vào phần này sau khi chạy thành công.

### 5.1. Menu Sinh viên trong Backend

<img width="1837" height="668" alt="image" src="https://github.com/user-attachments/assets/94f92b04-6c5f-491d-95fe-5314a81f5762" />


### 5.2. Form nhập thông tin sinh viên

<img width="1738" height="864" alt="Ảnh chụp màn hình 2026-04-24 105144" src="https://github.com/user-attachments/assets/bcc300e7-a3a0-45b9-8591-cb97620d7702" />


### 5.3. Bảng danh sách sinh viên ngoài Frontend

<img width="1855" height="995" alt="Ảnh chụp màn hình 2026-04-24 110556" src="https://github.com/user-attachments/assets/1ef0ea03-c622-4691-9155-f5c0b817ef2c" />


## 6. Link GitHub

Link repository:

```text
https://github.com/laison25/student-manager
```

## 7. Tác giả

- Họ tên: Lại Sơn
- Plugin: Student Manager
