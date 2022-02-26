<?php
// include('config/db_connect.php');
include('includes/header.php');
?>
<?php
// fetch latest posts
$query = "SELECT u.id AS user_id, u.fullname AS username, p.*  FROM users u, posts p WHERE u.id = p.user_id  ORDER BY p.id DESC LIMIT 3";
$query_run = mysqli_query($con, $query);
if (mysqli_num_rows($query_run) > 0) {
    $latest = $query_run;
}

// fetch post
$post_slug = $_GET['slug'];
$query = "SELECT u.fullname AS username, c.slug AS cat_slug, c.id AS cat_id, c.title AS cat_title, p.* FROM users u, categories c, posts p WHERE p.slug='$post_slug' AND u.id=p.user_id AND c.id=p.category_id LIMIT 1";
$query_run = mysqli_query($con, $query);
if (mysqli_num_rows($query_run) > 0) {
    $post = mysqli_fetch_array($query_run);
    $cat_name = $post['cat_title'];
}
?>

<div class="container">
    <?php
    // var_dump($post);
    // var_dump($cat_name);
    ?>
    <section class="">
        <div class="post">
            <div class="post-top">
                <div class="">
                    <a class="post-nav" href="index.php">Home </a> >>
                    <a class="post-nav"
                        href="categories.php?category=<?= $post['cat_slug'] ?>"><?= $post['cat_title'] ?>
                    </a>
                    >>
                    <a class="post-nav" href="post.php?slug=<?= $post['slug'] ?>"><?= $post['title'] ?> </a>
                </div>
                <div class="">
                    <?php
                    if ($_SESSION['user_id'] == $post['user_id']) {
                    ?>
                    <a class="edit-btn" href="edit-post.php?id=<?= $post['id'] ?>">
                        Edit
                    </a>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <div class="post-content">
                <?php
                if ($post['image'] != NULL) {
                ?>
                <img class="post-img" src="uploads/<?= $post['image'] ?>" alt="">
                <?php
                }
                ?>
                <h1 class="post-heading"><?= $post['title'] ?></h1>
                <p class="post-text"><?= $post['content'] ?></p>
                <div class="post-footer">
                    <small class="post-author">Author: <?= $post['username'] ?></small>
                    <small class="post-date">Posted on: <?= date('Y m d', strtotime($post['created_at'])) ?></small>
                </div>
            </div>
        </div>
        <div class="latest">
            <h1 class="heading">Latest Blog Posts</h1>
            <div class="latest-content">
                <?php
                foreach ($latest as $post) {
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
    </section>
</div>

<?php include('includes/footer.php'); ?>