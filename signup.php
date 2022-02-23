<?php
include('includes/header.php');
?>

<div class="form-container">


    <?php include('messages.php') ?>

    <h1 class="form-header">SignUp Form</h1>
    <form action="func.php" method="post">
        <div class="form-group">
            <label for="fullname">Fullname</label>
            <input name="fullname" type="text" class="form-control" placeholder="Fullname">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input name="email" type="email" class="form-control" placeholder="Fullname">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input name="password" type="password" class="form-control" placeholder="Fullname">
        </div>
        <button type="submit" class="btn btn-submit" name="signup-btn">SignUp</button>
    </form>
</div>


<?php include('includes/footer.php') ?>