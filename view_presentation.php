<?php
/**
 * User: domingos
 */
include_once __DIR__ . "/subparts/header.php";
?>

<script>
    function deleteSubCategory(id, idSub) {
        if (id && idSub && confirm("Delete this " + idSub + " subcategory of " + id + " category?")){
            window.location.replace("deleteSub.php?id="+id+"&idSub="+idSub);
        }
    }
</script>
<p></p>
<div class="container">
    <p>
    <h1>View Category Number: <?php echo $category['id']. " - ".  $category['name']; ?> </h1>
    </p>
    <table class="table">
        <tbody>
        <tr>
            <th>id</th><td><?php echo $category['id'];?></td>
        </tr>
        <tr>
            <th>category_id</th><td><?php echo $category['category_id'];?></td>
        </tr>
        <tr>
            <th>name</th><td><?php echo $category['name'];?></td>
        </tr>
        <tr>
            <th>created</th><td><?php echo $category['created'];?></td>
        </tr>
        <tr>
            <th>modified</th><td><?php echo $category['modified'];?></td>
        </tr>
        <tr>
            <th>subcategories</th>
            <td>
                <table class="table">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>category_id</th>
                        <th>name</th>
                        <th>created</th>
                        <th>modified</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($category['subcategories'] as $subcategory): ?>
                        <tr>
                            <td><?php echo $subcategory['id'] ?></td>
                            <td><?php echo $subcategory['category_id'] ?></td>
                            <td><?php echo $subcategory['name'] ?></td>
                            <td><?php echo $subcategory['created'] ?></td>
                            <td><?php echo $subcategory['modified'] ?></td>
                            <td>
                                <a class="btn btn-sm btn-outline-success" href="viewSub.php?id=<?php echo $subcategory['category_id'] ?>&idSub=<?php echo $subcategory['id']; ?>">View </a>
                                <a class="btn btn-sm btn-outline-secondary " href="updateSub.php?id=<?php echo $subcategory['category_id'] ?>&idSub=<?php echo $subcategory['id']; ?>">Update</a>
                                <button class="btn btn-outline-danger btn-sm"
                                        onclick="deleteSubCategory(<?php echo $subcategory['category_id'];?>, <?php echo $subcategory['id']; ?>)">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
    <?php include_once __DIR__ . "/subparts/return.php"; ?>
</div>

<?php include_once __DIR__ . "/subparts/footer.php"; ?>
