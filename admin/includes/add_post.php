<?php
if (isset($_POST['create_post'])) {
    $postTitle = $_POST['title'];
    $postCategory = $_POST['post_category_id'];
    $postAuthor = $_POST['post_author'];
    $postStatus = $_POST['post_status'];

    $postImage = $_FILES['image']['name'];
    $postImageTemp = $_FILES['image']['tmp_name'];

    $postTags = $_POST['post_tags'];
    $postContent = $_POST['post_content'];
    $postDate = date('d-m-y');
    $postComments = 4;

    move_uploaded_file($postImageTemp, "../images/$postImage");

    $query = "INSERT INTO posts (post_title, post_category_id, post_author, post_status, post_image, post_tags, post_content, post_date, post_comments_count) 
            VALUES ('$postTitle', '$postCategory', '$postAuthor', '$postStatus', '$postImage', '$postTags', '$postContent', now(), '$postComments')";


    $publishPost = mysqli_query($connection, $query);

    confirmQuery($publishPost);

}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category ID</label>
        <input type="text" class="form-control" name="post_category_id">
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="" cols="30" rows="10" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>