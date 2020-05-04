<?php
/**
 * User: domingos
 */

require __DIR__ . "/categories/Category.php";

use Categories\Category;

//include_once __DIR__ . "/subparts/header.php";

if(!isset($_GET['id'])) {
    include __DIR__ . "/subparts/error.php";
    exit();
}
$id = $_GET['id'];
$category = new Category();
$category->getCategoryById($id);
if (!$category){
    include __DIR__ . "/subparts/error.php";
    exit();
}

$category->deleteCategory($id);



header("Location: index.php");
//include_once __DIR__ . "/subparts/header.php";



