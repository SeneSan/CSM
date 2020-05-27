<?php include "includes/header.php"; ?>

    <!-- Navigation -->

    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php

                if (isset($_GET['category']))
                {

                    $categoryID = $_GET['category'];

                    $query = "SELECT * FROM posts WHERE post_category_id = $categoryID AND post_status = 'Published'";
                    $selectAllPosts = mysqli_query($connection, $query);

                    if (!empty($selectAllPosts))
                    {
                    while ($row = mysqli_fetch_assoc($selectAllPosts)) {
                        $postID = $row['post_id'];
                        $postTitle = $row['post_title'];
                        $postAuthor = $row['post_author'];
                        $postDate = $row['post_date'];
                        $postImage = $row['post_image'];
                        $postContent = substr($row['post_content'],0 , 200);
                        $postStatus = $row['post_status'];

                        if ($postStatus == 'Published')
                        {
                    ?>
                    <h1 class="page-header">
                        Page Heading
                        <small>Secondary Text</small>
                    </h1>

                    <!-- Blog Post -->
                    <h2>
                        <a href="post.php?postID=<?php echo $postID?>"><?php echo $postTitle; ?></a>
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

                <?php }}} else { echo "<h1 class='text-center'>Opps! We found no posts. Come back later.</h1>";}}?>

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
