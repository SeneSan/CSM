<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>Author</th>
        <th>Comment</th>
        <th>Email</th>
        <th>Status</th>
        <th>In response to</th>
        <th>Date</th>
        <th>Approve</th>
        <th>Unapprove</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <?php

        $query = "SELECT * FROM comments";
        $selectComments = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($selectComments))
        {
            $commentID = $row['comment_id'];
            $commentAuthor = $row['comment_author'];
            $commentContent = $row['comment_content'];
            $commentEmail = $row['comment_email'];
            $commentStatus = $row['comment_status'];
            $commentPostID = $row['comment_post_id'];
            $commentDate = $row['comment_date'];

            $queryPost = "SELECT * FROM posts WHERE post_id = $commentPostID";
            $getPostTile = mysqli_query($connection, $queryPost);
            confirmQuery($getPostTile);

            $post = mysqli_fetch_assoc($getPostTile);
            $postID = $post['post_id'];
            $postTitle = $post['post_title'];

            echo "<tr>
            <td>$commentID</td>
            <td>$commentAuthor</td>
            <td>$commentContent</td>
            <td>$commentEmail</td>
            <td>$commentStatus</td>
            <td><a href='../post.php?postID=$postID'>$postTitle</a></td>
            <td>$commentDate</td>
            <td><a href='comments.php?approve_comment=$commentID'>Approve</a></td>
            <td><a href='comments.php?unapprove_comment=$commentID'>Unapprove</a></td>
            <td><a href='comments.php?delete=$commentID'>Delete</a></td>
          </tr>";
        }
        ?>
    </tr>
    </tbody>
</table>

<?php
if (isset($_GET['approve_comment']))
{
    $commentID = $_GET['approve_comment'];

    $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $commentID;";
    $approveComment = mysqli_query($connection, $query);
    confirmQuery($approveComment);

    header('Location: comments.php?source=view_all_comments');
}

if (isset($_GET['unapprove_comment']))
{
    $commentID = $_GET['unapprove_comment'];

    $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = $commentID;";
    $unapproveComment = mysqli_query($connection, $query);
    confirmQuery($unapproveComment);

    header('Location: comments.php?source=view_all_comments');
}


if (isset($_GET['delete']))
{
    $commentID = $_GET['delete'];

    $query = "DELETE FROM comments WHERE comment_id = $commentID";
    $deleteComment = mysqli_query($connection, $query);
    confirmQuery($deleteComment);

    $queryDecreaseCommentsCount = "UPDATE posts SET post_comments_count = (SELECT post_comments_count FROM posts WHERE post_id = $postID) - 1 WHERE post_id = $postID;";
    $decreaseCommentsCount = mysqli_query($connection, $queryDecreaseCommentsCount);
    confirmQuery($decreaseCommentsCount);

    header('Location: comments.php?source=view_all_comments');
}


?>
