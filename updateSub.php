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
$c = new Category;
$subcategory = $c->getSubCategoryById($id, $idSub);
if (!$subcategory){
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

    $cat = array_merge($subcategory, $_POST);

    $valid = $c->validateSubCategory($cat, $errors);

    if ($valid) {
        $c->updateSubCategory($id, $_POST);
        header("Location: index.php");
    }

}
include_once __DIR__ . "/subparts/header.php";
require_once "input_form_sub.php";
?>

<?php include_once __DIR__ . "/subparts/return.php"; ?>
<?php include_once __DIR__. "/subparts/footer.php"; ?>
