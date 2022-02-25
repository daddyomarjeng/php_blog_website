<?php
session_start();
if (isset($_SESSION['auth'])) {
    $_SESSION['success'] = "You are already logged in";
    header('Location: index.php');
    exit(0);
}