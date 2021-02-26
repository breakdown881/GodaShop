<?php 
require_once "../config.php";
require_once "../model/connectdb.php";
require_once "../model/base/BaseRepository.php";
require_once "../model/action/Action.php";
require_once "../model/action/ActionRepository.php";
require_once "../model/category/Category.php";
require_once "../model/category/CategoryRepository.php";
require_once "../model/brand/Brand.php";
require_once "../model/brand/BrandRepository.php";
require_once "../model/comment/Comment.php";
require_once "../model/comment/CommentRepository.php";
require_once "../model/customer/Customer.php";
require_once "../model/customer/CustomerRepository.php";
require_once "../model/district/District.php";
require_once "../model/district/DistrictRepository.php";
require_once "../model/order/Order.php";
require_once "../model/order/OrderRepository.php";
require_once "../model/status/Status.php";
require_once "../model/status/StatusRepository.php";
require_once "../model/orderItem/OrderItem.php";
require_once "../model/orderItem/OrderItemRepository.php";
require_once "../model/product/Product.php";
require_once "../model/product/ProductRepository.php";
require_once "../model/brand/Brand.php";
require_once "../model/brand/BrandRepository.php";
require_once "../model/imageItem/ImageItem.php";
require_once "../model/imageItem/ImageItemRepository.php";
require_once "../model/province/Province.php";
require_once "../model/province/ProvinceRepository.php";
require_once "../model/role/Role.php";
require_once "../model/role/RoleRepository.php";
require_once "../model/roleAction/RoleAction.php";
require_once "../model/roleAction/RoleActionRepository.php";
require_once "../model/staff/Staff.php";
require_once "../model/staff/StaffRepository.php";
require_once "../model/transport/Transport.php";
require_once "../model/transport/TransportRepository.php";
require_once "../model/ward/Ward.php";
require_once "../model/ward/WardRepository.php";
require_once "../model/cart/Cart.php";
require_once "../model/cart/CartStorage.php";
require_once "../model/newsletter/NewsLetter.php";
require_once "../model/newsletter/NewsLetterRepository.php";
// require_once "../vendor/google/recaptcha/src/autoload.php";
require '../vendor/autoload.php';
function get_domain(){
    return $_SERVER['HTTP_HOST'];
} //lấy domain trang wed người dùng

function get_full_url() {
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	return $url;
} //lấy đường dẫn

function get_link_site() {
	return "http://localhost/backend/ThayLoc/Thuchanh/k22/godashop/site/index.php";
}


$categoryRepository = new CategoryRepository();
$footerCategories = $categoryRepository->getAll();

function formatDateVietName($date) {
	$time = strtotime($date);
	//strtotime() là hàm chuyển ngày thành số
	$day = date("d", $time);
	$month = date("m", $time);
	$year = date("Y", $time);
	$tmp = explode(" ", $date);
	$str_time = "";
	if (count($tmp) > 1) $str_time = $tmp[1];
	$str = "ngày $day tháng $month năm $year $str_time";
	return $str; 
}
 ?>