<?php
/**
 * view one subcategory
 *
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
$subcategory = (new Category)->getSubCategoryById($id, $idSub);

if (!isset($subcategory)) {

    include_once __DIR__ . "/subparts/error.php";
    exit();
}

include_once __DIR__ . "/subparts/header.php";

?>
    <script>
        function deleteSubCategory(id, idSub) {
            if (id && idSub && confirm("Delete this " + idSub + " subcategory of " + id + " category?")){
                window.location.replace("deleteSub.php?id="+id+"&idSub="+idSub);
            }
        }
    </script>
    <div class="container">
        <p>
        <h1>View Subcategory Number: <?php echo $subcategory['id']. " - ".  $subcategory['name']; ?> </h1>
        </p>
        <table class="table">
            <tbody>
            <tr>
                <th>id</th><td><?php echo $subcategory['id'];?></td>
            </tr>
            <tr>
                <th>category_id</th><td><?php echo $subcategory['category_id'];?></td>
            </tr>
            <tr>
                <th>name</th><td><?php echo $subcategory['name'];?></td>
            </tr>
            <tr>
                <th>created</th><td><?php echo $subcategory['created'];?></td>
            </tr>
            <tr>
                <th>modified</th><td><?php echo $subcategory['modified'];?></td>
            </tr>

            </tbody>
        </table>
        <div class="container text-center">
            <a class="btn btn-sm btn-outline-secondary " href="updateSub.php?id=<?php echo $subcategory['category_id'] ?>&idSub=<?php echo $subcategory['id']; ?>">Update</a>
            <button class="btn btn-outline-danger btn-sm"
                    onclick="deleteSubCategory(<?php echo $subcategory['category_id'];?>, <?php echo $subcategory['id']; ?>)">Delete</button>
        <?php include_once __DIR__ . "/subparts/return.php"; ?>
        </div>
    </div>

<?php include_once __DIR__ . "/subparts/footer.php"; ?>
