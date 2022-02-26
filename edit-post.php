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

    <h1 class="form-header">Edit Post</h1>
    <form enctype="multipart/form-data" class="form" style="width:80%; margin: 0 auto; padding: 30px" action="func.php"
        method="post">
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
            <button name="add_post" type="submit" class="btn">Create Post</button>
        </div>
    </form>
</div>

<?php include('includes/footer.php'); ?>