<?php 
	class ContactController {
		
		function form() {
			$page_title = "Liên hệ";
			$categoryRepository = new CategoryRepository();
			$categories = $categoryRepository->getAll();
			include_once "view/contact/form.php"; 

		}
	}
 ?>