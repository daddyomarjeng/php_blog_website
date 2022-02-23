<?php
include('config/db_connect.php');

// SignUP
if (isset($_POST['signup-btn'])) {

    echo "jjjj";
    $fullname = $_POST['fullname'];

    echo $fullname;
}