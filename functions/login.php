<?php
session_start();
require_once '../database/config.php';

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $check = mysqli_query($conn, "SELECT * FROM tbl_user WHERE email = '$email' AND password = '$password' AND verified = '1'");

    if(mysqli_num_rows($check) == 1) {
        foreach($check as $row) {
            $user_id = $row['user_id'];
            $fname = $row['firstname'];
            $_SESSION['user_id'] = $user_id;
            $_SESSION['fname'] = $fname;
            echo 'success';
        }
    } else {
        echo 'invalid';
    }
}
?>