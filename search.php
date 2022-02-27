<?php
include('includes/header.php');
include('config/db_connect.php');

// Search
if (isset($_GET['search_btn'])) {
    $search = mysqli_real_escape_string($con, $_GET['search']);
    $query = "SELECT * FROM posts WHERE title LIKE '%$search%'";
    $query_run = mysqli_query($con, $query);
    if (mysqli_num_rows($query_run) > 0) {
        $posts = $query_run;
    } else {
        header("Location: index.php");
        exit(0);
    }
}
?>

<div class="container">

    <form class="search-container" action="search.php" method="get">
        <input name="search" type="text" class="search-input" placeholder="Search">
        <button name="search_btn" class="search-button">Search</button>
    </form>

    <section class="blogs-section">
        <div class="blogs">
            <h1 class="heading">Search Result</h1>
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

    </section>
</div>

<?php
include('includes/footer.php');
?>