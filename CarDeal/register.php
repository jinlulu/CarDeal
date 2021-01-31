<?php
include_once './common/init.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = get_arg('name');
    $email = get_arg('email');
    $password = get_arg('password');
    $confirmation = get_arg('confirmation');
    //先查已有用户
    $sql = "select * from user where email='$email';";
    $user = $sqlhelp->get_row($sql);
    if(!empty($user)){
        echo "<script>alert('Duplicated users email address !'); window.history.go(-1);</script>";
        exit();
    }
    if($confirmation != $password){
        echo "<script>alert('confirmation error !'); window.history.go(-1);</script>";
        exit();
    }
    $sql = "INSERT INTO `user` (`name`, `password`, `email` ) VALUES ('$name', '$password', '$email' );";
    $auth = $sqlhelp->query($sql);
    if($auth){
        echo "<script>alert('success!'); location.href='login.php';</script>";
    }else{
        echo "<script>alert('error !'); window.history.go(-1);</script>";
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
            <h2>Register</h2>
            <br>
            <form method="post">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Confirmation</label>
                    <input type="password" name="confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="login.php" class="btn btn-default pull-right">Login</a>
            </form>
        </div>
    </div>
</div>



<?php include_once "./common/html_footer.php"; ?>
