<?php 
	class HomeController {
		function list() {
			// $productRepository = new ProductRepository();
			// $products = $productRepository->getAll();
			// var_dump($products);

			$categoryRepository = new CategoryRepository();
			$categories = $categoryRepository->getAll();
			//var_dump($categories);

			$qty_per_page = QTY_PER_PAGE_HOME;
			$page_index = 1;
			$productRepository = new productRepository();
			$featuredProducts = $productRepository->getBy(array(), array("featured" => "DESC"),  $page_index, $qty_per_page);
			//var_dump($featuredProducts);

			$productByCategories = [];
			$newProducts = $productRepository->getBy(array(), array("created_date" => "DESC"),  $page_index, $qty_per_page);

			foreach($categories as $category) {
			$products = $productRepository->getBy(
				array( 
					"category_id" =>array(
						"type" => "=", 
						"val" => $category->getId()
					)
				), 
				array("created_date" => "DESC"),  $page_index, $qty_per_page);
			$productByCategories[] = array(
				"category_name" => $category->getName(),
				"products" => $products
			);
			//var_dump($productByCategories);
		}
			include "view/home/list.php";
		}
	}
 ?>