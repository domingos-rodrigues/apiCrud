<?php
/**
 * User: domingos
 */

require __DIR__ . "/categories/Category.php";

use Categories\Category;


if(!isset($_GET['idCat'])) {
    include __DIR__ . "/subparts/error.php";
    exit();
}

$id = $_GET['idCat'];
$c = new Category;
$category = $c->getCategoryById($id);
if (!$category){
    include __DIR__ . "/subparts/error.php";
    exit();
}

$subcategory = [
    'id' => "",
    'category_id' => $category['category_id'],
    'name' => '',
    'created' => date("Y-m-d h:m:s"),
    'modified' => date("Y-m-d h:m:s"),
];

$errors = [
    'id' => '',
    'category_id' => '',
    'name' => '',
    'created' => '',
    'modified' => '',
];
$valid = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cat = array_merge($subcategory, $_POST);
    $create = new Category();
    $valid = $create->validateSubCategory($cat, $errors);

    if ($valid) {

        $create->createSubCategory($_POST, $id);

        header("Location: index.php");
    }
    $subCategory = $cat;
}

include_once __DIR__ . "/subparts/header.php";
$create = true;
require_once "input_form_sub.php";
require_once __DIR__. "/subparts/return.php";
include_once __DIR__ . "/subparts/footer.php";
