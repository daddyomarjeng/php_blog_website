<?php
include('config/db_connect.php');

// SignUP
if (isset($_POST['signup-btn'])) {

    $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$password')";
    $query_run = mysqli_query($con, $query);
    // var_dump($query);
    // exit(0);
    if ($query_run) {
        $_SESSION['success'] = "Registeration Successfull, Please login!";
        header("Location: login.php");
        exit(0);
    } else {
        $_SESSION['error'] = "Registeration Failed, Please Try again";
        header('Location: signup.php');
        exit(0);
    }
}


// Login
if (isset($_POST['login-btn'])) {

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $user  = mysqli_fetch_array($query_run);
        $username = $user['fullname'];
        $_SESSION['auth'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $username;
        // $_SESSION['success'] = "Login Successfull, Welcome $username";
        header("Location: index.php");
        exit(0);
    } else {
        $_SESSION['error'] = "Login Failed, Please Try again";
        header('Location: login.php');
        exit(0);
    }
}

// Logout
if (isset($_POST['logout'])) {
    // unset($_SESSION['auth']);
    session_destroy();
    $_SESSION['success'] = 'Logged Out Successfully';
    header("Location: login.php");
    exit(0);
}

// Create Post
if (isset($_POST['add_post'])) {
    $user_id = $_SESSION['user_id'];
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $content = mysqli_real_escape_string($con, $_POST['content']);

    $slug_array = explode(' ', $title);
    $slug = date("Y-m-d-H:i:s");
    foreach ($slug_array as $slug_item) {
        $slug = $slug . '-' . strtolower($slug_item);
    }
    // $slug = date("Y-m-d H:i:s");
    // $slug = $slug . '-' . date("Y-m-d-H:i:s");

    // var_dump($slug);
    // exit(0);

    // $image = $_FILES['image'];
    $image = $_FILES['image']['name'];
    // var_dump($image);
    $image_extension = pathinfo($image)['extension'];
    $image_name = time() . '.' . $image_extension;
    // var_dump($image_name);
    // exit(0);

    $query = "INSERT INTO posts
                        (user_id, category_id, title, slug, content, image) 
                VALUES('$user_id','$category_id','$title','$slug','$content', '$image_name')";
    $query_run = mysqli_query($con, $query);
    if ($query_run) {
        move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image_name);
        $_SESSION['success'] = "Post Created Successfully";
        header("Location: index.php");
        exit(0);
    } else {
        // var_dump(mysqli_error($con, $query_run));
        // var_dump($query);
        // exit(0);
        $_SESSION['error'] = "Post Not Created, An error occured!";
        header("Location: add-post.php");
        exit(0);
    }
}

// Update post
if (isset($_POST['update_post'])) {
    $user_id = $_SESSION['user_id'];
    $post_id = mysqli_real_escape_string($con, $_POST['post_id']);
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $content = mysqli_real_escape_string($con, $_POST['content']);

    $old_image = mysqli_real_escape_string($con, $_POST['old_image']);
    $old_slug = mysqli_real_escape_string($con, $_POST['old_slug']);
    $old_title = mysqli_real_escape_string($con, $_POST['old_title']);

    if ($old_title == $title) {
        $slug = $old_slug;
    } else {
        $slug_array = explode(' ', $title);
        $slug = date("Y-m-d-H:i:s");
        foreach ($slug_array as $slug_item) {
            $slug = $slug . '-' . strtolower($slug_item);
        }
    }
    $image = $_FILES['image']['name'];
    if ($image == NULL) {
        $image_name = $old_image;
    } else {
        $image_extension = pathinfo($image)['extension'];
        $image_name = time() . '.' . $image_extension;
    }

    $query = "UPDATE posts SET
                user_id = '$user_id',
                category_id = '$category_id',
                title = '$title',
                slug = '$slug',
                content = '$content',
                image = '$image_name'
                WHERE id = '$post_id' AND user_id='$user_id'
            ";
    $query_run = mysqli_query($con, $query);
    if ($query_run) {
        // check if image is sent before uploading again
        if ($image != NULL) {
            if (file_exists('uploads/' . $old_image)) {
                unlink('uploads/' . $old_image);
            }
            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image_name);
        }
        $_SESSION['success'] = "Post Updated Successfully";
        header("Location: edit-post.php?id=" . $post_id);
        exit(0);
    } else {
        // var_dump(mysqli_error($con, $query_run));
        // var_dump($post_id);
        // var_dump($query);
        // exit(0);
        $_SESSION['error'] = "Post Not Uppdated, An error occured!";
        header("Location: edit-post.php?id=" . $post_id);
        exit(0);
    }
}


// Delete post
if (isset($_POST['delete_post'])) {
    $post_id = mysqli_real_escape_string($con, $_POST['post_id']);
    $image = mysqli_real_escape_string($con, $_POST['image']);

    // // fetch post
    // $query = "SELECT * FROM posts WHERE id = '$post_id' LIMIT 1";
    // $query_run = mysqli_query($con, $query);
    // $post = mysqli_fetch_array($query_run);
    // $image =  $post['image'];

    $query = "DELETE FROM posts WHERE id='$post_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        // check if post has image
        if (file_exists('uploads/' . $image)) {
            unlink('uploads/' . $image);
        }
        $_SESSION['success'] = "Post Deleted Successfully";
        header("Location: index.php");
    } else {
        $_SESSION['error'] = "Post Not Deleted, An error occured!";
        header("Location: edit-post.php?id=" . $post_id);
        exit(0);
    }
}