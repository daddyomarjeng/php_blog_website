<?php include('includes/header.php'); ?>

<div class="container">
    <h1 class="form-header">Create a new Post</h1>
    <form style="width:80%; margin: 0 auto; padding: 30px" action="func.php" method="post">
        <div class="form-group">
            <label for="title">Title</label>
            <input name="title" type="text" class="form-control" placeholder="Enter post title">
        </div>

        <div class="form-group">
            <label for="title">Slug</label>
            <input name="slug" type="text" class="form-control" placeholder="Enter post slug">
        </div>
        <div class="form-group">
            <label for="title">Content</label>
            <textarea name="content" id="" rows="3" class="form-control" style="resize:none"
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