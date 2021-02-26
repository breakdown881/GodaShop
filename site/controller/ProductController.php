<?php 
class ProductController {
	function list() {
		$page_title = "Sản phẩm";
		$categoryRepository = new CategoryRepository();
		$categories = $categoryRepository->getAll();

		$conds = [];
		$sorts = [];
		$qty_per_page = QTY_PER_PAGE_PRODUCT;
		$selected_page = !empty($_GET["page"]) ? $_GET["page"] : 1;
		$page_index = 1;
		$productRepository = new productRepository();

		$selected_category_id = !empty($_GET["category_id"]) ? $_GET["category_id"] : null;
		$selectedCategory = null;
		if ($selected_category_id) {
			$conds["category_id"] = array(
				"type" => "=", 
				"val" => $selected_category_id //WHERE category_id = 'val'
			);
			$selectedCategory = $categoryRepository->find($selected_category_id);
		}
		
		$selected_price_range = !empty($_GET["price-range"]) ? $_GET["price-range"] : null;
		if ($selected_price_range) {
			$tmp = explode("-", $selected_price_range);
			$start_price = $tmp[0];
			$end_price = $tmp[1];
			if (!is_numeric($start_price)) {
				$start_price = 0;
			}
			//!is_numeric() hàm kiểm tra không là số
			if (!is_numeric($end_price)) {
				$end_price = PHP_INT_MAX;
				//PHP_INT_MAX: là con số tối đa, là hằng số
			}
			$conds["sale_price"] = array(
				"type" => "BETWEEN", 
				"val" => "$start_price AND $end_price"
			);//sale_price BETWEEN 100 AND 200
		}
		
		
		$selected_search = !empty($_GET["search"]) ? $_GET["search"] : null;
		if ($selected_search) {
			$conds["name"] = array(
				"type" => "LIKE", 
				"val" => "'%$selected_search%'" //name LIKE "'%%'";
			);
		}

		$selected_sort = !empty($_GET["sort"]) ? $_GET["sort"] : null;
		if ($selected_sort) {
			$tmp = explode("-", $selected_sort);
			$m = array(
			"price" => "sale_price",
			"alpha" => "name",
			"created" => "created_date",
			);
			$sorts[$m[$tmp[0]]] = strtoupper($tmp[1]);
		}
		$products = $productRepository->getBy($conds, $sorts, $selected_page, $qty_per_page);
		$page_total = ceil(count($productRepository->getBy($conds, $sorts))/$qty_per_page);
		//ceil(): làm tròn
		//count(): đếm
        include_once "view/product/list.php";
	}
	public function ajaxSearch() {
		$pattern = $_GET["pattern"];
		$productRepository = new ProductRepository();
		$products = $productRepository->getByPattern($pattern);
		include_once "view/product/ajaxSearch.php";
	}

	function detail() {
		$categoryRepository = new CategoryRepository();
		$categories = $categoryRepository->getAll();
		$id = $_GET["id"];
		
		$productRepository = new ProductRepository();
		$product = $productRepository->find($id);
		$selectedCategory = $categoryRepository->find($product->getCategoryId());
		$imageItems = $product->getImageItems();
		$commentRepository = new CommentRepository();
		$comments = $commentRepository->getByProductId($id);
		$conds = array();

		$selected_category_id = $product->getCategoryId();
		$conds["category_id"] = array(
				"type" => "=", 
				"val" => $selected_category_id 
			);
		$conds["id"] = array(
				"type" => "!=", 
				"val" => $id
			);
		$relativeProducts = $productRepository->getBy($conds, array(), 1, 10);
		//var_dump($relativeProducts);
		include "view/product/detail.php";
	}
}
?>