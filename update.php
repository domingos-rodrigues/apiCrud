<?php
/**
 * User: domingos
 */

require __DIR__ . "/categories/Category.php";
use Categories\Category;

if(!isset($_GET['id'])) {
    include __DIR__ . "/subparts/error.php";
    exit();
}

$id = $_GET['id'];
$c = (new Category);
$category = $c->getCategoryById($id);
if (!$category){
    include __DIR__ . "/subparts/error.php";
    exit();
}

$errors = [
    'id' => '',
    'category_id' => '',
    'name' => '',
    'created' => '',
    'modified' => '',
];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
   // $cat = updateCategory($_POST, $id);

    $cat = array_merge($category, $_POST);

    $valid = $c->validateCategory($cat, $errors);

    if ($valid) {
        $cat = $c->updateCategory($id, $_POST);
        header("Location: index.php");
    }

}
include_once __DIR__ . "/subparts/header.php";
require_once "input_form.php";
?>

<?php include_once __DIR__ . "/subparts/return.php"; ?>

<?php include_once __DIR__. "/subparts/footer.php"; ?>