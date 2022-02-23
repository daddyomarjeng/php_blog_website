<?php

session_start();

if (isset($_SESSION['error'])) {
?>
<h1 class="error"><?= $_SESSION["error"] ?></h1>
<?php
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
?>
<h1 class="success"><?= $_SESSION["success"] ?></h1>
<?php
    unset($_SESSION['success']);
}