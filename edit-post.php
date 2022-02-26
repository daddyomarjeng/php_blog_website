<?php
// include('config/db_connect.php');
include('includes/header.php');
?>
<?php

// fetch all categories
$query = "SELECT * FROM categories";
$query_run = mysqli_query($con, $query);
if (mysqli_num_rows($query_run) > 0) {
    $categories = $query_run;
}

// fetch post
$post_id = $_GET['id'];
$query = "SELECT u.id AS user_id, p.* FROM users u, posts p WHERE p.id='$post_id' AND u.id=p.user_id LIMIT 1";
$query_run = mysqli_query($con, $query);
if (mysqli_num_rows($query_run) > 0) {
    $post = mysqli_fetch_array($query_run);
}

// validate user owns post
if ($post['user_id'] != $_SESSION['user_id']) {
    header("Location: index.php");
}

?>

<div class="container">
    <?php
    // var_dump($post);
    // var_dump($cat_name);
    ?>
    <?php include('messages.php'); ?>

    <div class="edit-header">
        <h1 class="form-header">Edit Your Post</h1>
        <form action="func.php" method="post">
            <button type="submit" name="delete-post" class="delete-post">Delete Post</button>
        </form>
    </div>
    <form enctype="multipart/form-data" class="form" style="width:80%; margin: 0 auto; padding: 30px" action="func.php"
        method="post">
        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
        <input type="hidden" name="old_slug" value="<?= $post['slug'] ?>">
        <input type="hidden" name="old_image" value="<?= $post['image'] ?>">
        <input type="hidden" name="old_title" value="<?= $post['title'] ?>">

        <div class="form-group">
            <label for="title">Category</label>
            <select required name="category_id" class="form-control">
                <option value="">--Select Category---</option>
                <?php
                foreach ($categories as $category) {
                ?>
                <option value="<?= $category['id'] ?>" <?= $category['id'] == $post['category_id'] ? 'selected' : '' ?>>
                    <?= $category['title'] ?>
                </option>
                <?php
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="title">Title</label>
            <input required name="title" type="text" class="form-control" placeholder="Enter post title"
                value="<?= $post['title'] ?>">
        </div>

        <div class="form-group">
            <label for="title">Content</label>
            <textarea required name="content" id="" rows="3" class="form-control" style="resize:none"
                placeholder="Enter your post content here"><?= $post['content'] ?>
            </textarea>
        </div>
        <div class="form-group">
            <label for="title">Choose Blog Image</label>
            <input name="image" type="file" placeholder="Choose">
        </div>
        <div class="form-group">
            <button name="update_post" type="submit" class="btn">Update Post</button>
        </div>
    </form>
</div>

<?php include('includes/footer.php'); ?>