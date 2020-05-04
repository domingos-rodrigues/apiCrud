<?php
/**
 * User: domingos
 */

require __DIR__ . "/categories/Category.php";

use Categories\Category;

if(!isset($_GET['id']) && !isset($_GET['idSub'])) {
    include __DIR__ . "/subparts/error.php";
    exit();
}

$id = $_GET['id'];
$idSub = $_GET['idSub'];

$category = new Category();
$category->getSubCategoryById($id, $idSub);

if (!$category){
    include __DIR__ . "/subparts/error.php";
    exit();
}

$category->deleteSubCategory($id, $idSub);



header("Location: index.php");
