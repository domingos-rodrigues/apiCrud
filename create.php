<?php
/**
 * User: domingos
 */

require __DIR__ . "/categories/Category.php";

use Categories\Category;

$category = [
    'id' => "",
    'category_id' => "",
    'name' => '',
    'created' => '',
    'modified' => '',
    'subcategories' => [],
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
    $cat = array_merge($category, $_POST);
    $create = new Category();
    $valid = $create->validateCategory($cat, $errors);

    if ($valid) {
        $create->createCategory($_POST);

        header("Location: index.php");
    }
    $category = $cat;
}
include_once __DIR__ . "/subparts/header.php";
require_once "input_form.php";
require_once __DIR__. "/subparts/return.php";
include_once __DIR__ . "/subparts/footer.php";