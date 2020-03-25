<!--Edit category form-->
<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Update Category</label>


        <?php
        if (isset($_GET['update'])) {
            $updateID = $_GET['update'];

            $updateQuery = "SELECT * FROM cms.categories WHERE cat_id = $updateID";
            $updateCategory = mysqli_query($connection, $updateQuery);

            while ($row = mysqli_fetch_assoc($updateCategory)) {
                $categoryName = $row['cat_title'];

                ?>

                <input value="<?php echo $categoryName?>" class="form-control" type="text" name="cat_title">

                <?php
            }
        }

        // Update query
        if (isset($_POST['update'])) {
            $updateTitle = $_POST['cat_title'];
            $updateID = $_GET['update'];

            $query = "UPDATE cms.categories SET cat_title = '$updateTitle' WHERE cat_id = $updateID";
            $updateCategory = mysqli_query($connection, $query);

            header("Location: categories.php");
        }
        ?>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update" value="Update Category">
    </div>
</form>
