<?php session_start() ?>
<nav>
    <a href="index.php" class="logo">
        <img src="assets/images/logo.png" alt="Logo" height="50px">
    </a>
    <ul class="nav-items">
        <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="#" class="nav-link">PHP</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Javascript</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Java</a></li>

        <!-- Add username, and dropdown for signout, posts=>page that will CRUD it.., Profile(edit profile) -->
        <?php
        if (!isset($_SESSION['auth'])) {
        ?>
        <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
        <li class="nav-item"><a href="signup.php" class="nav-link">Signup</a></li>
        <?php
        } else {

        ?>
        <li class="nav-item"><a href="#" class="nav-link profile">
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