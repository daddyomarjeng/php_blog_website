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