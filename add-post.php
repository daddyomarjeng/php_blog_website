<?php include('middlewares/auth.php'); ?>
<?php include('includes/header.php'); ?>
<?php
$query = "SELECT * FROM categories";
$query_run = mysqli_query($con, $query);
if (mysqli_num_rows($query_run) > 0) {
    $categories = $query_run;
}
?>

<div class="container">
    <?php include('messages.php'); ?>

    <h1 class="form-header">Create a new Post</h1>
    <form class="form" style="width:80%; margin: 0 auto; padding: 30px" action="func.php" method="post">
        <div class="form-group">
            <label for="title">Category</label>
            <select required name="category_id" class="form-control">
                <option value="">--Select Category---</option>
                <?php
                foreach ($categories as $category) {
                ?>
                <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="title">Title</label>
            <input required name="title" type="text" class="form-control" placeholder="Enter post title">
        </div>

        <div class="form-group">
            <label for="title">Content</label>
            <textarea required name="content" id="" rows="3" class="form-control" style="resize:none"
                placeholder="Enter your post content here"></textarea>
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