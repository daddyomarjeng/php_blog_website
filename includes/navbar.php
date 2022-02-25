<?php
// session_start(); 
include('config/db_connect.php');
$query = "SELECT * FROM categories";
$query_run = mysqli_query($con, $query);
if (mysqli_num_rows($query_run) > 0) {
    // $navItems = mysqli_fetch_array($query_run);
    $navItems = $query_run;
}
?>
<nav>
    <a href="index.php" class="logo">
        <img src="assets/images/logo.png" alt="Logo" height="50px">
    </a>
    <ul class="nav-items">
        <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
        <?php
        foreach ($navItems as $navItem) {
        ?>
        <li class="nav-item"><a href="#" class="nav-link"><?= $navItem['title'] ?></a></li>
        <?php
        }
        ?>

        <!-- Add username, and dropdown for signout, posts=>page that will CRUD it.., Profile(edit profile) -->
        <?php
        if (!isset($_SESSION['auth'])) {
        ?>
        <div class="nav-right">
            <li><a href="login.php" class="nav-link">Login</a></li>
            <li><a href="signup.php" class="nav-link">Signup</a></li>
        </div>
        <?php
        } else {

        ?>
        <li class="nav-item b"><a href="#" class="nav-link profile">
                <?= $_SESSION['username'] ?> &#8595;
            </a>
            <ul class="profile-items">
                <li class="profile-item"><a href="#" class="profile-link">My Profile</a></li>
                <li class="profile-item"><a href="add-post.php" class="profile-link">Add Post</a></li>
                <li class="profile-item">
                    <form action="func.php" method="post">
                        <button name="logout" type="submit" class="profile-link">Logout</button>
                    </form>
                </li>
            </ul>
        </li>
        <?php
        }
        ?>
    </ul>
</nav>