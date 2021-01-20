<?php
include("include/config.php");
include_once('include/db.php');
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
                        <form action="register.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <input type="text" name="username" placeholder="username" class="form-control">
                            </div>
                            <div class="mb-3">
                                <select class="form-control" id="" name="user_type">
                                    <option disabled selected>user_type</option>
                                    <option value="Singer">Singer</option>
                                    <option value="Rapper">Rapper</option>
                                    <option value="Artists">Artists</option>
                                    <option value="Reporter">Reporter</option>
                                    <option value="Users">User</option>

                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="name" placeholder="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="contact" placeholder="contact" class="form-control">
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" placeholder="email eg:-abc@gmail.com" class="form-control">
                            </div>
                            <div class="mb-3">
                                <input type="date" name="dob" placeholder="dateofbirth" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Profile Photo</label>
                                <input type="file" name="profile_photo" placeholder="profile_photo" class="form-control">
                            </div>
                            <div class="mb-3">
                                <!-- <select class="form-control" id="" name="gender">
                                    <option disabled selected>Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Others">Others</option>

                                </select> -->

                                <label for="" class="m-0 p-0 text-muted d-block mb-2">gender</label>
                                <div class="custom-control custom-radio d-inline">
                                    <input type="radio" name="gender" id="male" value="male" class="custom-control-input" checked>
                                    <label for="male" class="custom-control-label">Male</label>
                                </div>

                                <div class="custom-control custom-radio d-inline">
                                    <input type="radio" name="gender" id="female" value="female" class="custom-control-input">
                                    <label for="female" class="custom-control-label">Female</label>
                                </div>

                                <div class="custom-control custom-radio d-inline">
                                    <input type="radio" name="gender" id="other" value="other" class="custom-control-input">
                                    <label for="other" class="custom-control-label">Others</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <input type="password" name="password" placeholder="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <input type="submit" name="register" value="Register" class="btn btn-primary w-100">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <a href="index.php" class="nav-link text-primary">Already have an account?Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


<?php
if (isset($_POST['register'])) {
    $img = $_FILES['profile_photo']['name'];
    $tmp_img = $_FILES['profile_photo']['tmp_name'];
    move_uploaded_file($tmp_img, "images/dp/$img");
    $sql = "INSERT INTO users (username, name, contact, email, user_type,profile_photo, dob, gender, password) VALUES 
    ('" . $_POST["username"] . "','" . $_POST["name"] . "', '" . $_POST["contact"] . "','" . $_POST["email"] . "','" . $_POST["user_type"] . "','" . $img . "','" . $_POST["dob"] . "','" . $_POST["gender"] . "','" . $_POST["password"] . "')";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        redirect('index');
    } else {
        echo "fail";
    }
}
?>

<?php
// if (isset($_POST['register'])) {
//     $data = [
//         'username' => $_POST['username'],
//         // 'name' => $_POST['name'],
//         // 'contact' => $_POST['contact'],
//         // 'email' => $_POST['email'],
//         // 'user_type' => $_POST['user_type'],
//         // 'dob' => $_POST['dob'],
//         // 'gender' => $_POST['gender'],
//         // 'password' => $_POST['password'],

//     ];
//     if (insertdata('users', $data)) {
//         redirect('index');
//     } else {
//         echo "fail";
//     }
// }
?>