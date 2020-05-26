<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
    <tr>
<?php

$query = "SELECT * FROM posts";
$selectPosts = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($selectPosts))
{
    $postID = $row['post_id'];
    $postAuthor = $row['post_author'];
    $postTitle = $row['post_title'];

    $queryCategoryName = "SELECT * FROM categories AS c INNER JOIN posts AS p ON cat_id = post_category_id WHERE p.post_id = $postID;";
    $categoryName = mysqli_query($connection, $queryCategoryName);
    confirmQuery($categoryName);

    $category = mysqli_fetch_assoc($categoryName);
    $postCategory = $category['cat_title'];

    $postStatus = $row['post_status'];
    $postImage = $row['post_image'];
    $postTags = $row['post_tags'];
    $postComments = $row['post_comments_count'];
    $postDate = $row['post_date'];

    echo "<tr>
            <td>$postID</td>
            <td>$postAuthor</td>
            <td>$postTitle</td>
            <td>$postCategory</td>
            <td>$postStatus</td>
            <td><img height='50' src='../images/$postImage' alt='No image'/></td>
            <td>$postTags</td>
            <td>$postComments</td>
            <td>$postDate</td>
            <td><a href='posts.php?source=edit_post&p_id=$postID'>Edit</a></td>
            <td><a href='posts.php?delete=$postID'>Delete</a></td>
          </tr>";
}
?>
    </tr>
    </tbody>
</table>

<?php
if (isset($_GET['delete']))
{
    $postID = $_GET['delete'];

    $query = "DELETE FROM posts WHERE post_id = $postID";
    mysqli_query($connection, $query);

    header('Location: posts.php');
}


?>
