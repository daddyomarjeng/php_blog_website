<?php
include('includes/header.php');

?>


<div class="form-container container">
    <?php include('messages.php') ?>
    <?php
    include('middlewares/loggedin.php');

    ?>

    <h1 class="form-header">Login Form</h1>
    <form class="form" action="func.php" method="post">
        <div class="form-group">
            <label for="fullname">Email</label>
            <input name="email" type="email" class="form-control" placeholder="Fullname" required>
        </div>
        <div class="form-group">
            <label for="fullname">Password</label>
            <input name="password" type="password" class="form-control" placeholder="Fullname" required>
        </div>
        <button name="login-btn" type="submit" class="btn btn-submit">Login</button>
    </form>
</div>


<?php include('includes/footer.php') ?>