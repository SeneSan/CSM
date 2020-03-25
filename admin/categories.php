<?php
include "includes/admin_header.php";
include "../includes/db.php";
?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin
                        <small>Dynamic Author</small>
                    </h1>

                    <div class="col-xs-6">

                        <?php
                        if (isset($_POST['submit'])) {
                            $catTitle = $_POST['cat_title'];

                            if ($catTitle == "" || empty($catTitle)) {
                                echo "This field should not be empty";
                            } else {
                                $insertQuery = "INSERT INTO categories (cat_title) VALUE ('$catTitle')";
                                $insertConnection = mysqli_query($connection, $insertQuery);

                                if (!$insertConnection) {
                                    die('QUERY FAILED' . mysqli_error($connection));
                                }
                            }
                        }

                        ?>

                        <!--Add category form-->
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>

                    <?php
                    if (isset($_GET['update'])) {
                        include "includes/update_categories.php";
                    }

                    ?>

                    </div>

                    <!-- View Category table -->
                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            // Find all categories query
                            $query = "SELECT * FROM categories";
                            $selectCategoriesSidebar = mysqli_query($connection, $query);

                            while ($row = mysqli_fetch_assoc($selectCategoriesSidebar)) {

                                $categoryId = $row['cat_id'];
                                $categoryTitle = $row['cat_title'];

                                echo "<tr>
                                        <td>$categoryId</td>
                                        <td>$categoryTitle</td>
                                        <td><a href='categories.php?delete=$categoryId'>Delete</a></td>
                                        <td><a href='categories.php?update=$categoryId'>Update</a></td>
                                      </tr>";

                            }

                            // Delete query

                            if (isset($_GET['delete'])) {
                                $deleteID = $_GET['delete'];

                                $deleteQuery = "DELETE FROM cms.categories WHERE cat_id = $deleteID";
                                $deleteCategory = mysqli_query($connection, $deleteQuery);

                                if (!$deleteQuery) {
                                    die("QUERY FAILED" . mysqli_error($connection));
                                }

                                header("Location: categories.php");
                            }




                            ?>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>
