<?php 
class CommentController {
	function save() {
		$data = array();
		$product_id = $_POST["product_id"];
		$data["product_id"] = $_POST["product_id"];
		$data["email"] = $_POST["email"];
		$data["fullname"] = $_POST["fullname"];
		$data["star"] = $_POST["rating"];
		$data["created_date"] = date("Y-m-d H:i:s");
		$data["description"] = $_POST["description"];
		$commentRepository = new CommentRepository();

		if ($commentRepository->save($data)) {
			$comments = $commentRepository->getByProductId($product_id);
			include_once "view/product/commentList.php";
		}
		
	}
}
?>