<?php
include('include/config.php');

?>


<?php
session_start();
if (isset($_POST['login'])) {

    $username = $_POST['username'];

    $password = $_POST['password'];

    $query = check_data("SELECT * from users where username='$username' AND password='$password'");
    if ($query) {

        $_SESSION['username'] = $username;
        redirect('post');
    } else {
        echo "username and password is incorrect";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StartTalk</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <div class="card">

                    <div class="card-header">
                        <h4 class="h4 text-center">StartTalk</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <input type="text" name="username" placeholder="username or email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" placeholder="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <input type="submit" value="Login" name="login" class="btn btn-primary w-100">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <a href="register.php" class="nav-link text-primary"> Don't have an account? Sign up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


</html>