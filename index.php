<?php
/**
 * User: domingos
 */
require __DIR__ . "/categories/Category.php";
use Categories\Category;
$cat_subs = (new Category)->getCategories();

include_once __DIR__ . "/subparts/header.php";
$refInt=0;
?>
    <script>
        function showSub(tabId) {
            let element = document.getElementById(tabId);
            element.classList.toggle("d-none");
        }
        function showQuant(id, i) {
            let element = document.getElementById(id);
            element.innerText = i;
        }
        function deleteCategory(id, numSub) {
            if (id && confirm("Delete this " + id + " category?\nIt has " + numSub + " subcategories.")){
                window.location.replace("delete.php?id="+id);
            }
        }
        function deleteSubCategory(id, idSub) {
            if (id && idSub && confirm("Delete this " + idSub + " subcategory of " + id + " category?")){
                window.location.replace("deleteSub.php?id="+id+"&idSub="+idSub);
            }
        }
    </script>

    <div class="container">
        <p></p>
        <h1>List all records ( categories and subcategories )</h1>
        <p>
            <table class="table">
                <tr>
                    <td><a href="create.php" class="btn btn-success">Create Category</a></td>
                    <td>
                        <form action="search.php" method="post">
                            <input name="search" value="" placeholder="Category Name" required="required"/>
                            <button class="btn btn-sm btn-outline-info">
                                <svg width="24" height="24" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                                    <path d=" M 601 199C 601 199 601 199 601 199C 491 199 401 289 401 399C 401 452 422 503 460 540C 497 578 548 599 601 599C 711 599 801 509 801 399C 801 289 711 199 601 199M 601 99C 601 99 601 99 601 99C 767 99 901 233 901 399C 901 479 869 555 813 611C 757 667 681 699 601 699C 534 699 468 676 416 634C 416 634 211 839 211 839C 201 849 176 850 166 840C 166 840 136 809 136 809C 126 799 126 774 136 764C 136 764 345 555 345 555C 316 508 301 454 301 399C 301 319 333 243 389 187C 445 131 521 99 601 99" transform="translate(1000,0) scale(-1,1)"/></svg></button>
                        </form>
                    </td>
                    <td></td>
                </tr>
            </table>
        </p>
        <table class="table">
            <thead>
                <tr>
                    <th>category_id</th>
                    <th>name</th>
                    <th>created</th>
                    <th>modified</th>
                    <th>Actions in categories</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($cat_subs as $cat_suba): ?>
                <tr>
                    <td> <?php echo $cat_suba['category_id'] ?> </td>
                    <td> <?php echo $cat_suba['name'] ?> </td>
                    <td> <?php echo $cat_suba['created'] ?> </td>
                    <td> <?php echo $cat_suba['modified'] ?> </td>
                    <td><a class="btn btn-sm btn-outline-success" href="view.php?id=<?php echo $cat_suba['id'] ?>">View </a>
                        <a class="btn btn-sm btn-outline-secondary " href="update.php?id=<?php echo $cat_suba['id'] ?>">Update</a>
                        <!--a class="btn btn-outline-danger btn-sm"  href="delete.php?id=<?php echo $cat_suba['id'] ?>">Delete</a-->
                        <button class="btn btn-outline-danger btn-sm"
                                onclick="deleteCategory(<?php echo $cat_suba['id'].", 'b". $cat_suba. "'"; ?>)">Delete</button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-info" onclick="showSub('a<?php echo $refInt; ?>');">subcategories (
                            <span id="b<?php echo $refInt;
                            $refIntId = $refInt; ?>" class="text-black-50"></span>)
                        </button>
                        <a class="btn btn-success btn-sm" href="createSub.php?idCat=<?php echo $cat_suba['id'] ?>">Create SubCategory</a>
                    </td>
                </tr>
                <tr id="a<?php echo $refInt++; ?>" class="d-none">
                    <td colspan="2"> . . . subcategories</td>
                    <td colspan="4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>name</th>
                                    <th>created</th>
                                    <th>modified</th>
                                    <th>Actions in subcategories</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $ii=0;?>
                            <?php foreach ($cat_suba['subcategories'] as $sub_category): ?>
                                <tr>
                                    <?php /*<td><? php echo $sub_category['id'] ? ></td> */ ?>
                                    <td><?php echo $sub_category['id'] ?></td>
                                    <td><?php echo $sub_category['name'] ?></td>
                                    <td><?php echo $sub_category['created'] ?></td>
                                    <td><?php echo $sub_category['modified'] ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-outline-success" href="viewSub.php?id=<?php echo $cat_suba['category_id'] ?>&idSub=<?php echo $sub_category['id']; ?>">View </a>
                                        <a class="btn btn-sm btn-outline-secondary " href="updateSub.php?id=<?php echo $cat_suba['category_id'] ?>&idSub=<?php echo $sub_category['id']; ?>">Update</a>
                                        <button class="btn btn-outline-danger btn-sm"
                                                onclick="deleteSubCategory(<?php echo $cat_suba['category_id'];?>, <?php echo $sub_category['id']; ?>)">Delete</button>
                                    </td>
                                </tr>
                            <?php $ii++;?>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <script>
                            <?php
                            if ($ii>0)
                                echo "showQuant('b".$refIntId,"', ". $ii. ");";
                            ?>
                        </script>

                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
<div class="container">
    <p></p>
</div>
<?php
include_once __DIR__ . "/subparts/footer.php";