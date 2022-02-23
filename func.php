<?php
include('config/db_connect.php');

// SignUP
if (isset($_POST['signup-btn'])) {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

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

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $user  = mysqli_fetch_array($query_run);
        $username = $user['fullname'];
        $_SESSION['auth'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "Login Successfull, Welcome $username";
        header("Location: index.php");
        exit(0);
    } else {
        $_SESSION['error'] = "Login Failed, Please Try again";
        header('Location: login.php');
        exit(0);
    }
}