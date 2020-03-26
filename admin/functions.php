<?php

function confirmQuery($result)
{
    global $connection;

    if (!$result)
    {
        die("QUERY FAILED " . mysqli_error($connection));
    }
}

function insertCategories() {
    global $connection;

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
}

function findAllCategories() {
    global $connection;

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
}

function deleteCategory() {
    global $connection;

    if (isset($_GET['delete'])) {
        $deleteID = $_GET['delete'];

        $deleteQuery = "DELETE FROM cms.categories WHERE cat_id = $deleteID";
        $deleteCategory = mysqli_query($connection, $deleteQuery);

        if (!$deleteQuery) {
            die("QUERY FAILED" . mysqli_error($connection));
        }

        header("Location: categories.php");
    }
}