<?php

if (isset($_GET['p_id']))
{
    $p_id = $_GET['p_id'];

    $query = "SELECT * FROM posts WHERE post_id = $p_id";
    $updatePost = mysqli_query($connection, $query);

    confirmQuery($updatePost);

    while ($row = mysqli_fetch_assoc($updatePost)) {

        $postAuthor = $row['post_author'];
        $postTitle = $row['post_title'];
        $postCategory = $row['post_category_id'];
        $postStatus = $row['post_status'];
        $postImage = $row['post_image'];
        $postTags = $row['post_tags'];
        $postComments = $row['post_comments_count'];
        $postDate = $row['post_date'];
        $postContent = $row['post_content'];
    }

    if (isset($_POST['edit_post'])) {
        $newPostTitle = $_POST['title'];
        $newPostCategory = $_POST['post_category'];
        $newPostAuthor = $_POST['post_author'];
        $newPostStatus = $_POST['post_status'];

        $newPostImage = $_FILES['image']['name'];
        $newPostImageTemp = $_FILES['image']['tmp_name'];
        move_uploaded_file($newPostImageTemp, "../images/$newPostImage");

        if (empty($newPostImage)) {
            $newPostImage = $postImage;
        }

        $newPostTags = $_POST['post_tags'];
        $newPostContent = $_POST['post_content'];
        $newPostDate = date('d-m-y');
        $newPostComments = 4;

        $query = "UPDATE posts SET post_title = '$newPostTitle', post_category_id = '$newPostCategory', post_author = '$newPostAuthor', post_status = '$newPostStatus',
        post_image = '$newPostImage', post_tags = '$newPostTags', post_content = '$newPostContent', post_date = now(), post_comments_count = $postComments 
        WHERE post_id = $p_id;";


        $editPost = mysqli_query($connection, $query);

        confirmQuery($editPost);

        header('Location: posts.php');

    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $postTitle ?>">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category</label><br>
        <select name="post_category" id="post_category" value="<?php echo $postCategory ?>">
            <?php
            $query = "SELECT * FROM cms.categories";
            $selectCategories = mysqli_query($connection, $query);

            confirmQuery($selectCategories);

            while ($row = mysqli_fetch_assoc($selectCategories)) {
                $categoryID = $row['cat_id'];
                $categoryName = $row['cat_title'];

                if ($postCategory == $categoryID)
                {
                    echo "<option value='$categoryID' selected>$categoryName</option>";
                }
                else {
                    echo "<option value='$categoryID'>$categoryName</option>";
                }
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author" value="<?php echo $postAuthor ?>">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status" value="<?php echo $postStatus ?>">
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label><br>
        <img src="../images/<?php echo "$postImage"?>" alt="No image" width="50px"><br>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $postTags ?>">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="" cols="30" rows="10" class="form-control"><?php echo $postContent ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_post" value="Edit Post">
    </div>
</form>
