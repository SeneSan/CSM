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
    $postCategory = $row['post_category_id'];
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
            <td><img height='50' src='../images/$postImage' alt='image'/></td>
            <td>$postTags</td>
            <td>$postComments</td>
            <td>$postDate</td>
          </tr>";
}
?>
    </tr>
    </tbody>
</table>
