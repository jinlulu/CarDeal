<?php
include_once './common/init.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $name = get_arg('name');
    $password = get_arg('password');
    $sql = "SELECT * FROM user WHERE name = '$name';";
    $user = $sqlhelp->get_row($sql);
    if(empty($user)){
        echo "<script>alert('User is not registered!'); location.href='login.php';</script>";
    }
    if($user['password'] == $password){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user'] = $user;

        echo "<script>alert('Login success!'); location.href='index.php';</script>";
    }else{
        echo "<script>alert('Unauthorized access !'); window.history.go(-1);</script>";
    }
    exit();
}

?>

<?php include_once "./common/html_header.php"; ?>
<style>
.login-container{
    border: 1px solid #aaa;
    border-radius: 10px;
    margin-top: 100px;
    padding: 20px;
}
</style>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-xs-12 login-container">
            <h2>Login</h2>
            <br>
            <form method="post">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="register.php" class="btn btn-default pull-right">Register</a>
            </form>
        </div>
    </div>
</div>



<?php include_once "./common/html_footer.php"; ?>
