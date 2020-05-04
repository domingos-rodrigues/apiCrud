<?php
/**
 * User: domingos
 */
?>
<div class="container">
    <h1>Category with id: <?php echo $id; ?> </h1>
    <div class="card">
        <div class="card-header">
            <h3>
                <?php if ($category['id']):
                    $newCat = false;
                    ?>
                    Update category <b><?php echo $category['name'] ?></b>
                <?php else:
                    $newCat = true;
                    ?>
                    Create new category
                <?php endif ?>
            </h3>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data"
                  action="">
                <div class="form-group">
                    <label>id</label>
                    <input name="id" type="number" min="1" max="2147483647"
                           value="<?php echo $category['id'] ?>"
                           onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                           class="form-control <?php echo $errors['id'] ? 'is-invalid' : '' ?>"
                           pattern="[0-9]"
                           required="required"
                           <?php if ($category['id']) echo 'readonly="readonly"' ?>>
                    <div class="invalid-feedback">
                        <?php echo  $errors['id'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>category_id</label>
                    <input name="category_id" type="number" min="1"
                           type="number" value="<?php echo $category['category_id'] ?>"
                           onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                           class="form-control <?php echo $errors['category_id'] ? 'is-invalid' : '' ?>"
                           pattern="[0-9]"
                           required="required">
                    <div class="invalid-feedback">
                        <?php echo  $errors['category_id'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>name</label>
                    <input name="name" value="<?php echo $category['name'] ?>"
                           class="form-control <?php echo $errors['name'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo  $errors['name'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>created</label>
                    <input name="created" value="<?php echo (!$newCat)?$category['created']:date("Y-m-d h:m:s"); ?>"
                           class="form-control  <?php echo $errors['created'] ? 'is-invalid' : '' ?>" readonly="readonly">
                </div>
                <div class="form-group">
                    <label>modified</label>
                    <input name="modified" value="<?php echo (!$newCat)?$category['modified']:date("Y-m-d h:m:s"); ?>"
                           class="form-control  <?php echo $errors['modified'] ? 'is-invalid' : '' ?>" readonly="readonly">
                </div>

                <button class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
</div>