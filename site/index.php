<?php 
	include "../bootstrap.php";
	include "load.php";
	$c = isset($_GET["c"]) ? $_GET["c"] : "home";//product
	$a = isset($_GET["a"]) ? $_GET["a"] : "list";//list

	$c = ucfirst($c)."Controller";//ProductController
	$controller = new $c();//new ProductController()
	$controller->$a();//$controller->list()
 ?>