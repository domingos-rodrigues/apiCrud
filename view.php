<?php
/**
 * view one category with the subcategories that aggregated
 */


require __DIR__ . "/categories/Category.php";

use Categories\Category;

if(!isset($_GET['id'])) {
    include_once __DIR__ . "/subparts/error.php";
    exit();
}


$id = $_GET['id'];
$category = (new Category)->getCategoryById($id);

if(!isset($category)) {
    include_once __DIR__ . "/subparts/error.php";
    exit();
}

include_once __DIR__ . "/view_presentation.php";
