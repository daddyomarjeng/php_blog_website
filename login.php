<?php
include('includes/header.php');

?>

<div class="form-container">
    <h1 class="form-header">Login Form</h1>
    <form action="func.php" method="post">
        <div class="form-group">
            <label for="fullname">Fullname</label>
            <input type="text" class="form-control" placeholder="Fullname">
        </div>
        <div class="form-group">
            <label for="fullname">Email</label>
            <input type="email" class="form-control" placeholder="Fullname">
        </div>
        <div class="form-group">
            <label for="fullname">Password</label>
            <input type="password" class="form-control" placeholder="Fullname">
        </div>
        <button type="submit" class="btn btn-submit">Login</button>
    </form>
</div>


<?php include('includes/footer.php') ?>