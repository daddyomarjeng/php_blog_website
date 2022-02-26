<?php
include('includes/header.php');
include('config/db_connect.php');

$posts = "";
$latest = "";

// fetch all posts
$query = "SELECT u.id AS user_id, u.fullname AS username, p.* FROM users u, posts p WHERE u.id = p.user_id ORDER BY p.id DESC ";
$query_run = mysqli_query($con, $query);
if (mysqli_num_rows($query_run) > 0) {
    $posts = $query_run;
}

// fetch latest posts
$query = "SELECT u.id AS user_id, u.fullname AS username, p.*  FROM users u, posts p WHERE u.id = p.user_id  ORDER BY p.id DESC LIMIT 3";
$query_run = mysqli_query($con, $query);
if (mysqli_num_rows($query_run) > 0) {
    $latest = $query_run;
}

?>

<div class="container">
    <?php
    // var_dump($posts);
    // "<br/>";
    // var_dump($latest);
    ?>
    <div class="banner">
        <div class="overlay">
            <span class="h-1">Are you a Writer?</span>
            <span>Or do you want to write your first blog?</span>
            <a href="add-post.php" class="btn-home">Start Writing</a>
        </div>
    </div>

    <?php include('messages.php'); ?>

    <section class="blogs-section">
        <div class="blogs">
            <h1 class="heading">Our Blog Posts</h1>
            <div class="blogs-content">
                <?php
                foreach ($posts as $post) {
                ?>
                <div class="post-card">
                    <?php
                        if ($_SESSION['user_id'] == $post['user_id']) {
                        ?>
                    <a class="edit-btn" href="edit-post.php?id=<?= $post['id'] ?>">
                        Edit
                    </a>
                    <?php
                        }
                        ?>

                    <a href="post.php?slug=<?= $post['slug'] ?>" class="">
                        <h4><?= $post['title'] ?></h4>
                        <small>by: <?= $post['username'] ?></small>
                        <small>Posted on: <?= date('d M Y', strtotime($post['created_at'])) ?></small>
                    </a>
                </div>

                <?php
                }
                ?>
            </div>
        </div>
        <div class="latest">
            <h1 class="heading">Latest Blog Posts</h1>
            <div class="latest-content">
                <?php
                foreach ($latest as $post) {
                ?>
                <a href="post.php?slug=<?= $post['slug'] ?>" class="post-card">
                    <h4><?= $post['title'] ?></h4>
                    <small>by: <?= $post['username'] ?></small>
                    <small>Posted on: <?= date('d M Y', strtotime($post['created_at'])) ?></small>
                </a>

                <?php
                }
                ?>
            </div>
        </div>
    </section>
</div>

<?php
include('includes/footer.php');
?>