<?php
session_start();
if (!isset($_SESSION['auth'])) {
    $_SESSION['error'] = "You are not AUthorized to view this page, Login to access";
    exit(0);
}