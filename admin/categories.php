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

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>
                    </div>
                    <!-- Add Category form -->


                    <?php
                    $query = "SELECT * FROM categories";
                    $selectCategoriesSidebar = mysqli_query($connection, $query);
                    ?>

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
                            while ($row = mysqli_fetch_assoc($selectCategoriesSidebar)) {

                                $categoryId = $row['cat_id'];
                                $categoryTitle = $row['cat_title'];

                                echo "<tr>
                                        <td>$categoryId</td>
                                        <td>$categoryTitle</td>
                                    </tr>";

                            }?>
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
