<?php
session_start();
require_once '../../database/config.php';

if(isset($_POST['insert'])) {
    $firstname = $_POST['add_firstname'];
    $lastname = $_POST['add_lastname'];
    $contact = $_POST['add_contact'];
    $username = $_POST['add_username'];
    $password = md5($_POST['add_password']);
    $role = $_POST['add_role'];

    $check_if_username_exist = mysqli_query($conn, "SELECT * FROM tbl_admin WHERE username = '$username'");

    if(mysqli_num_rows($check_if_username_exist) > 0) {
        echo 'username exist';
    } else {
        $insert = mysqli_query($conn, "INSERT INTO tbl_admin (firstname, lastname, contact, username, password, role) VALUES ('$firstname', '$lastname', '$contact', '$username', '$password', '$role')");

        if($insert) {
            echo 'success';
        }
    }
}

if(isset($_POST['delete'])) {
    $admin_id = $_POST['delete_admin_id'];

    $delete = mysqli_query($conn, "DELETE FROM tbl_admin WHERE admin_id = $admin_id");

    if($delete) {
        echo 'success';
    }
}
?>