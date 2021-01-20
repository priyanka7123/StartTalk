<?php
include('include/config.php');
session_start();
if (!isset($_SESSION['username'])) {
    redirect('index');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StartTalk</title>
    <!-- CSS only -->
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/325c4c930f.js" crossorigin="anonymous"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-gradient fixed-top">
        <div class="container">
            <a href="post.php" class="navbar-brand ms-5">StartTalk</a>
            <form class="d-flex mx-auto mt-2 mb-2" action="search.php">
                <input class="form-control me-2" type="search" name="search" placeholder="Search profile" aria-label="Search" size="50" value="<?php if (isset($_GET['search'])) {
                                                                                                                                                    echo $_GET['search'];
                                                                                                                                                } ?>">
                <button class="btn btn-outline-light border-0" name="find" type="submit"><i class="fas fa-search"></i></button>
            </form>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="post.php" class="nav-link me-4"><i class="fas fa-home fas-4x text-white"></i></a>

                </li>

                <li class="nav-item dropdown me-4">
                    <a href="#" class="nav-link me-4 dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown">
                        <i class="fas fa-user-alt text-white"></i></a>
                    <ul class="dropdown-menu mt-3" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user-circle me-2"></i>My Profile</a></li>

                        <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>

                    </ul>
                </li>

            </ul>
        </div>
    </nav>
    <br>
    <br>
    <br>

</body>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

</html>