<?php
class OrderController {
	function list() {
		include_once "checkLogin.php";
		session_id() || session_start();
		$page_title = "Đơn hàng của tôi";
		$customerRepository = new CustomerRepository();
		$email = $_SESSION["email"];
		$customer = $customerRepository->findEmail($email);
		$orderRepository = new OrderRepository();
		$orders = $orderRepository->getByCustomerId($customer->getId());
		include_once "view/order/list.php";
	}

	function detail() {
		include_once "checkLogin.php";
		$id = $_GET["id"];
		$page_title = "Đơn hàng #$id";
		$orderRepository = new OrderRepository();
		$order = $orderRepository->find($id);
		//var_dump($order);

		//cách lấy địa chỉ giao hàng
		// $ward = $order->getShippingWard();
		// $district = $ward->getDistrict();
		// $province = $district->getProvince();
		include_once "view/order/detail.php";
	}
}
?>