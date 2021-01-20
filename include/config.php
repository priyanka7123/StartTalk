<?php
$connect = mysqli_connect('localhost', 'root', '', 'starttalk') or die("db error");

function insertdata($table, $fields)
{
    global $connect;
    $col = implode(",", array_keys($fields));
    $row = implode("','", array_values($fields));
    $query = mysqli_query($connect, "INSERT INTO $table($col) VALUE ($row)");

    return ($query ? true : false);
}
function redirect($page)
{
    echo "<script>open('$page.php','_self')</script>";
}


function check_data($query)
{
    global $connect;
    $login = mysqli_query($connect, $query);
    $count = mysqli_num_rows($login);

    if ($count > 0) {
        return true;
    } else {
        return false;
    }
}

function callingUser($table, $session)
{
    global $connect;
    $query = mysqli_query($connect, "select * from $table where username='$session'");
    $row = mysqli_fetch_array($query);

    return $row['user_id'];
}
function delete_data($table, $cond)
{
    global $connect;
    $query = mysqli_query($connect, "delete from $table where $cond");
    return $query;
}
function calling_data($table, $cond = NULL)
{
    global $connect;
    $array = [];
    if ($cond == NULL) :
        $query = mysqli_query($connect, "select * from $table");
    else :
        $query = mysqli_query($connect, "select * from $table $cond");
    endif;
    while ($row = mysqli_fetch_array($query)) {
        $array[] = $row;
    }
    return $array;
}

function msg($content)
{
    echo "<script>alert('$content')</script>";
}
