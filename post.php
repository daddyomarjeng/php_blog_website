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

// fetch posts of category
$category_slug = $_GET['category'];
$query = "SELECT u.fullname AS username, c.slug AS cat_slug, c.id AS cat_id, c.title AS cat_title, p.* FROM users u, categories c, posts p WHERE c.slug='$category_slug' AND u.id=p.user_id AND c.id=p.category_id ORDER BY p.id DESC ";
$query_run = mysqli_query($con, $query);
if (mysqli_num_rows($query_run) > 0) {
    $posts = $query_run;
    $cat_name = mysqli_fetch_array($posts)['cat_title'];
}
?>

<div class="container">
    <?php
    // var_dump($posts);
    // var_dump($cat_name);
    ?>
    <section class="">
        <div class="posts">
            <h1 class="heading"><?= $post_name ?></h1>
            <div class="categories-content">
                <?php
                foreach ($posts as $post) {
                ?>
                <a href="#" class="post-card">
                    <h4><?= $post['title'] ?></h4>
                    <small>by: <?= $post['username'] ?></small>
                    <small>Posted on: <?= date('d M Y', strtotime($post['created_at'])) ?></small>
                </a>

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

<?php include('includes/footer.php'); ?>