<?php
include('banner.php');
include('include/db.php');
?>

<div class="container-fluid">


    <?php
    if (isset($_POST['follow'])) {
        $user_id = callingUser('users', $_SESSION['username']);
        $reciever_id = $_POST['reciever_id'];
        $sql = "INSERT INTO follow(sender_id,reciever_id)VALUES('$user_id','$reciever_id')";

        $result = mysqli_query($conn, $sql);
        if ($result) {
            //redirect('search?search=' . $_GET['search'] . '&find=' . $_GET['find']);
            header('location: search.php?search=' . $_GET['search'] . '&find=' . $_GET['find']);
        } else {
            echo "fail";
        }
    }

    if (isset($_POST['unfollow'])) {
        $user_id = callingUser('users', $_SESSION['username']);
        $reciever_id = $_POST['reciever_id'];
        $result = delete_data("follow", "sender_id='$user_id' AND reciever_id='$reciever_id'");

        if ($result) {
            header('location:' . 'search.php?search=' . $_GET['search'] . '&find=' . $_GET['find']);
        } else {
            echo "fail";
        }
    }
    ?>
    <?php
    if (isset($_GET['find'])) {
        $search = $_GET['search'];
        $data = calling_data('users', "where username != '" . $_SESSION['username'] . "' AND (username LIKE '%$search%' OR name like '%$search%')");
    } ?>
</div>

<div class="container-fluid mt-5">
    <div class="col-lg-6 offset-lg-3">
        <blockquote class="blockquote lead">
            you have searched "<b><?= $_GET['search']; ?></b>" you got <?= count($data); ?> Result<?= (count($data) > 1) ? "s" : ""; ?>
        </blockquote>
    </div>
    <?php
    foreach ($data as $user) :
    ?>

        <div class="col-lg-6 offset-lg-3 mt-2">
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="row">

                    <div class="col-3 p-3">
                        <div class="image">
                            <img src="images/dp/<?= $user['profile_photo']; ?>" alt="dp" class="card ms-auto" style="border-radius:50%;height:100px;width:100px;">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="card-body">
                            <h3 class="h3 mt-3"><?= $user['username']; ?></h3>
                            <p class="small  mt-2"><?= $user['user_type']; ?></p>
                        </div>
                    </div>
                    <div class="col-lg-2 my-5">
                        <!-- <a href="" class="btn btn-primary my-auto">Follow</a> -->
                        <?php
                        $sender_id = callingUser('users', $_SESSION['username']);
                        $check = check_data("select * from follow where sender_id='$sender_id' AND reciever_id='" . $user['user_id'] . "'");

                        if (!$check) :
                        ?>


                            <form action="" method="post">
                                <input type="hidden" name="reciever_id" value="<?= $user['user_id']; ?>">
                                <input type="submit" name="follow" value="follow" class="btn btn-sm btn-primary my-auto">
                            </form>
                        <?php else : ?>

                            <form action="" method="post">
                                <input type="hidden" name="reciever_id" value="<?= $user['user_id']; ?>">
                                <input type="submit" name="unfollow" value="Unfollow" class="btn btn-sm btn-danger my-auto">
                            </form>
                        <?php endif; ?>

                    </div>

                </div>
            </div>
        </div>
</div>
<?php endforeach; ?>
</div>

</div>
</div>