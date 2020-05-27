<?php include "includes/header.php"; ?>

<!-- Navigation -->

<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

            if (isset($_GET['postID']))
            {
                $postID = $_GET['postID'];

                $query = "SELECT * FROM posts WHERE post_id = $postID;";
                $selectAllPosts = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($selectAllPosts)) {
                    $postTitle = $row['post_title'];
                    $postAuthor = $row['post_author'];
                    $postDate = $row['post_date'];
                    $postImage = $row['post_image'];
                    $postContent = $row['post_content'];
                    $postCommentsCount = $row['post_comments_count'];
                    ?>
                    <h1 class="page-header">
                        Page Heading
                        <small>Secondary Text</small>
                    </h1>

                    <!-- Blog Post -->
                    <h2>
                        <a href="#"><?php echo $postTitle; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $postAuthor; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $postDate; ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $postImage?>" alt="">
                    <hr>
                    <p><?php echo $postContent; ?></p>
                    <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>

            <?php }} ?>

            <?php
            if (isset($_POST['create_comment']))
            {
                $commentAuthor = $_POST['comment_author'];
                $commentEmail = $_POST['comment_email'];
                $commentContent = $_POST['comment_content'];

                $queryCreateComment = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) 
                                        VALUES ($postID, '$commentAuthor', '$commentEmail', '$commentContent', 'Pending', now());";
                $createComment = mysqli_query($connection, $queryCreateComment);
                confirmQuery($createComment);

                $queryCommentCount = "UPDATE posts SET post_comments_count = $postCommentsCount + 1 WHERE post_id = $postID";
                $incrementCommentsCount = mysqli_query($connection, $queryCommentCount);
                confirmQuery($incrementCommentsCount);
            }

            ?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" method="post">
                    <div class="form-group">
                        <label for="">Author</label>
                        <input class="form-control" type="text" name="comment_author" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input class="form-control" type="email" name="comment_email" required>
                    </div>
                    <div class="form-group">
                        <label for="">Your comment</label>
                        <textarea class="form-control" rows="3" name="comment_content" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <?php

            $getCommentsQuery = "SELECT * FROM comments WHERE comment_post_id = $postID AND comment_status = 'Approved' ORDER BY comment_post_id DESC";
            $getComments = mysqli_query($connection, $getCommentsQuery);
            confirmQuery($getComments);

            while ($comment = mysqli_fetch_assoc($getComments))
            {
                $commentAuthor = $comment['comment_author'];
                $commentEmail = $comment['comment_email'];
                $commentContent = $comment['comment_content'];
                $commentDate = $comment['comment_date'];

            ?>
            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $commentAuthor?>
                        <small><?php echo $commentDate?></small>
                    </h4>
                    <?php echo $commentContent?>
                </div>
            </div>
            <?php } ?>

            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

    <?php include "includes/footer.php"; ?>
