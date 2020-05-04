<?php
/**
 * User: domingos
 */

require __DIR__ . "/categories/Category.php";
use Categories\Category;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search = $_POST['search'];
    $category = (new Category)->searchCat($search);
} else {
    include __DIR__ . "/subparts/error.php";
    exit();
}
if (!$category){
    include __DIR__ . "/subparts/error.php";
    exit();
}

include __DIR__. "/view_presentation.php";


