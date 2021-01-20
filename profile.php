<?php
include('include/db.php');
include('banner.php');
// $user_ids = callingUser('users', $_SESSION['username']);
?>
<div class="container-fluid">
    <?php
    $users = calling_data('users', " where username='" . $_SESSION['username'] . "'");
    foreach ($users as $user) :
    ?>
        <div class="row">
            <div class="col-lg-4 mt-5">
                <div class="image">
                    <img src="images/dp/<?= $user['profile_photo']; ?>" alt="dp" class="card ms-auto" style="border-radius:50%;height:250px;width:250px;">
                </div>
            </div>
            <div class="col-lg-6 mt-3">
                <h5 class="h5 text-center">Profile Info</h5>

                <div class="card mt-3 shadow p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        <h3 class="h3 mt-3 fst-italic"><?= $user['username']; ?></h3>


                        <div class="row mt-4">
                            <div class="col-lg-4">
                                <?php
                                $user_id = callingUser('users', $_SESSION['username']);
                                $data = calling_data('post', " where user_id = '" . $user_id . "'");
                                ?>
                                <?=
                                count($data); ?> Post<?= (count($data) > 1) ? "s" : ""; ?>
                            </div>
                            <div class="col-lg-3">
                                <?php
                                $following = calling_data('follow', " where sender_id = '" . $user_id . "'");
                                ?>
                                <?=
                                count($following); ?> Following<?= (count($following) > 1) ? "s" : ""; ?>
                            </div>
                            <div class="col-lg-3">
                                <?php
                                $follower = calling_data('follow', " where reciever_id = '" . $user_id . "'");
                                ?>
                                <?=
                                count($follower); ?> Following<?= (count($follower) > 1) ? "s" : ""; ?>
                            </div>
                        </div>
                        <!-- <button class="btn btn-primary">Follow</button> -->
                        <p class="small ">Name : <?= $user['name']; ?></p>
                        <p class="small text-muted "><?= $user['user_type']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
    <?php endforeach; ?>

</div>