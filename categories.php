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
        <div class="categories">
            <h1 class="heading"><?= $cat_name ?></h1>
            <div class="categories-content">
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