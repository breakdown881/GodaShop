<?php 
class InformationController {
	
	function returnPolicy() {
		$page_title = "Chính sách trả hàng";
		$categoryRepository = new CategoryRepository();
		$categories = $categoryRepository->getAll();
		include_once "view/information/returnPolicy.php"; 

	}

	function paymentPolicy() {
		$page_title = "Chính sách thanh toán";
		$categoryRepository = new CategoryRepository();
		$categories = $categoryRepository->getAll();
		include_once "view/information/paymentPolicy.php"; 
		
	}

	function deliveryPolicy() {
		$page_title = "Chính sách giao hàng";
		$categoryRepository = new CategoryRepository();
		$categories = $categoryRepository->getAll();
		include_once "view/information/deliveryPolicy.php"; 
	}

	
}