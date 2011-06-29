<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
global $lang;

$lang['cf_plugin_name'] = 'Dạng Liên hệ';
$lang['contact_form_debug'] = 'Hiển thị của thông tin hiệu chỉnh lỗi';

// ==================================================================
// Giá trị mặc định nếu không được cấu hình 
$lang['contact_form_title'] = 'Dạng Liên hệ';
$lang['contact_form'] = 'Liên hệ';
$lang['contact_form_link'] = 'Liên hệ webmaster';

// ==================================================================
// Trang đổi hướng
$lang['contact_redirect_title'] = 'Gởi trạng thái tin nhắn';

// ==================================================================
// Khối thanh trình đơn
$lang['cf_from_name'] = 'Tên của bạn';
$lang['cf_from_mail'] = 'Email của bạn';
$lang['cf_subject'] = 'Tiêu đề';
$lang['cf_message'] = 'Thông điệp';
$lang['cf_submit'] = 'Gởi';
$lang['title_send_mail'] = 'Một lời bình trên trang';

// ==================================================================
// Thông điệp
$lang['cf_from_name_error'] = 'Vui lòng nhập tên';
$lang['cf_mail_format_error'] = $lang['mail address must be like xxx@yyy.eee (example : jack@altern.org)'];
$lang['cf_subject_error'] = 'Vui lòng nhập tiêu đề';
$lang['cf_message_error'] = 'Vui lòng nhập nội dung';
$lang['cf_error_sending_mail'] = 'Có lỗi trong quá trình gởi email';
$lang['cf_sending_mail_successful'] = 'Email đã được gởi thành công';
$lang['cf_form_error'] = 'Dữ liệu không có thực';
$lang['cf_no_unlink'] = 'Chức năng \'unlink\' không dùng được...';
$lang['cf_unlink_errors'] = 'Lỗi xuất hiện trong quá trình xóa tệp tin';
$lang['cf_config_saved'] = 'Cấu hình được lưu thành công';
$lang['cf_config_saved_with_errors'] = 'Cấu hình được lưu với lỗi';
$lang['cf_length_not_integer'] = 'Kích thước phải là số nguyên';
$lang['cf_delay_not_integer'] = 'Độ trễ phải là số nguyên';
$lang['cf_link_error'] = 'Biến số không thể chứa khoảng trắng';
$lang['cf_hide'] = 'Ẩn';

// ==================================================================
// Trang quản trị
$lang['cf_validate'] = 'Xác nhận';
// Thẻ cấu hình
$lang['cf_tab_config'] = 'Cấu hình';
$lang['cf_config'] = 'Cấu hình';
$lang['cf_config_desc'] = 'Cấu hình plugin chính';
$lang['cf_label_config'] = 'Cấu hình tổng quát';
$lang['cf_label_mail'] = 'Cấu hình thư điện tử';
$lang['cf_menu_link'] = 'Thêm liên kết vào trình đơn';
$lang['cf_guest_allowed'] = 'Cho phép khách xem các dạng';
$lang['cf_mail_prefix'] = 'Tiếp đầu ngữ tiêu đề mail được gởi';
$lang['cf_separator'] = 'Ký tự sử dụng để định nghĩa thanh chia của email trong định dạng kiểu chữ';
$lang['cf_separator_length'] = 'Kích thước của thanh';
$lang['cf_mandatory_name'] = 'Họ tên là bắt buộc';
$lang['cf_mandatory_mail'] = 'Địa chỉ thư điện tử là bắt buộc';
$lang['cf_redirect_delay'] = 'Tạm ngừng độ trễ của quá trình điều hướng';
// Thẻ thư điện tử
$lang['cf_tab_emails'] = 'Thư điện tử';
$lang['cf_emails'] = 'Thư điện tử';
$lang['cf_emails_desc'] = 'Quản lý thư điện tử gởi đến';
$lang['cf_active'] = 'Kích hoạt thư điện tử';
$lang['cf_no_mail'] = 'Không có địa chỉ thư nào dùng được';
$lang['cf_refresh'] = 'Tạo ra danh sách địa chỉ thư';
?>