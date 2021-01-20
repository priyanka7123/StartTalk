<?php
include('banner.php');
include_once('include/db.php');

$users = calling_data('users', " where username!='" . $_SESSION['username'] . "'");
$user_ids = callingUser('users', $_SESSION['username']);
$imfolowing = calling_data('follow', "WHERE sender_id = '" . $user_ids . "'");
$output = [];
foreach ($imfolowing as $followinglist) {
  $output[] = $followinglist['reciever_id'];
}
$inlist = implode(",", $output);
if (!empty($output)) {
  $inlist2 = $user_ids . ',' . $inlist;
} else {
  $inlist2 = $user_ids;
}
$datqqa = "SELECT * FROM `post` WHERE `user_id` IN ($inlist2) ORDER BY post_id DESC";
$data = mysqli_query($conn, $datqqa);

?>
<?php
if (isset($_POST['follow'])) {
  $user_id = callingUser('users', $_SESSION['username']);
  $reciever_id = $_POST['reciever_id'];
  $sql = "INSERT INTO follow(sender_id,reciever_id)VALUES('$user_id','$reciever_id')";

  $result = mysqli_query($conn, $sql);
  if ($result) {
    redirect('post');
  } else {
    echo "fail";
  }
}

if (isset($_POST['unfollow'])) {
  $user_id = callingUser('users', $_SESSION['username']);
  $reciever_id = $_POST['reciever_id'];
  $result = delete_data("follow", "sender_id='$user_id' AND reciever_id='$reciever_id'");

  if ($result) {
    redirect('post');
  } else {
    echo "fail";
  }
}
?>
<div class="container-fluid mt-3">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="list-group">
          <p href=" #" class="list-group-item list-group-item-action fst-italic text-primary bg-light text-center" aria-current="true">
            Start Conversation
          </p>
          <div class="card-body">
            <form action="" method="POST">
              <div class="mb-3">
                <textarea class="form-control" name="chat" placeholder="chat here" id="floatingTextarea"></textarea>
              </div>
              <div class="mb-3 mt-3 ms-3">
                <input type="submit" name="post" value="Post" class="btn btn-primary">

              </div>
            </form>
          </div>
        </div>
      </div>
      <p class="fw-normal text-center fst-italic mt-3 text-primary">Recent Chats</p>


      <?php foreach ($data as $d) : ?>
        <div class="card mt-3 shadow-lg p-3 mb-5 bg-white rounded">
          <div class="card-body ">
            <?php
            $datqqqqa = "SELECT * FROM `users` WHERE `user_id` = '" . $d['user_id'] . "'";
            $datas = mysqli_query($conn, $datqqqqa);
            ?>
            <?php foreach ($datas as $dq) {
            } ?>
            <p class="font-weight-bold ">User : <?= $dq['username']; ?></p>
            <p class="lead"><?= $d['chat']; ?></p>

          </div>
        </div>
      <?php endforeach; ?>

    </div>
    <div class="col-lg-3">
      <div class="card">
        <div class="list-group" style="position: fixed;">
          <a href=" #" class="list-group-item list-group-item-action text-white bg-secondary text-center" aria-current="true">
            User List
          </a>
          <div class="list-group-item" style="overflow-y: scroll; height:75vh;">
            <?php foreach ($users as $user) :
            ?>
              <div class="card-body ">
                <div class="row ">
                  <div class="col-3 p-3 me-4 ">
                    <div class="image">
                      <img src="images/dp/<?= $user['profile_photo']; ?>" alt="dp" class="card ms-auto" style="border-radius:50%;height:50px;width:50px;">
                    </div>
                  </div>
                  <div class="col-lg-7">

                    <?php
                    $sender_id = callingUser('users', $_SESSION['username']);
                    $check = check_data("select * from follow where sender_id='$sender_id' AND reciever_id='" . $user['user_id'] . "'");

                    if (!$check) :
                    ?>

                      <h6 class="h6 mt-4"><?= $user['username']; ?></h6>
                      <p class="fst-italic text-muted"><?= $user['user_type']; ?></p>
                      <form action="" method="post">
                        <input type="hidden" name="reciever_id" value="<?= $user['user_id']; ?>">
                        <input type="submit" name="follow" value="follow" class="btn btn-sm btn-primary my-auto">
                      </form>
                    <?php else : ?>
                      <h6 class="h6 mt-4"><?= $user['username']; ?></h6>
                      <p class="fst-italic text-muted"><?= $user['user_type']; ?></p>
                      <form action="" method="post">
                        <input type="hidden" name="reciever_id" value="<?= $user['user_id']; ?>">
                        <input type="submit" name="unfollow" value="Unfollow" class="btn btn-sm btn-danger my-auto">
                      </form>
                    <?php endif; ?>

                  </div>
                </div>

              </div>
            <?php endforeach; ?>
          </div>
        </div>

      </div>

    </div>
  </div>
  <div class="col-lg-1"></div>
</div>
</div>



<?php
if (isset($_POST['post'])) {
  $user_id = callingUser('users', $_SESSION['username']);
  $sql = "INSERT INTO post (chat,user_id)VALUES 
    ('" . $_POST["chat"] . "','$user_id')";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    redirect('post');
  } else {
    echo "fail";
  }
}
?>