<?php
session_start();
if (isset($_SESSION["error"])) {
?>
<h1><?= $_SESSION["error"] ?></h1>
<?php
    unset($_SESSION["error"]);
}