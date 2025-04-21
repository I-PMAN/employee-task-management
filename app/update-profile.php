<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

// log to file as backup
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/php-error.log');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['role']) && isset($_SESSION['id'])) {

    if (isset($_POST['user_name']) && isset($_POST['password']) && isset($_POST['full_name']) && $_SESSION['role'] == 'employee') {
    }
    include "../DB_connection.php";
    function validate_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $new_password = validate_input($_POST['new_password']);
    $password = validate_input($_POST['password']);
    $full_name = validate_input($_POST['full_name']);
    $confirm_password = validate_input($_POST['confirm_password']);
    $id = $_SESSION['id'];

    if (empty($password) || empty($new_password) || empty($confirm_password)) {
        $em = "Password is required";
        header("Location: ../edit-profile.php?error=$em");
        exit();
    } else if (empty($full_name)) {
        $em = "Full name is required";
        header("Location: ../edit-profile.php?error=$em");
        exit();
    } else if ($confirm_password != $new_password) {
        $em = "Passwords do not match!";
        header("Location: ../edit-profile.php?error=$em");
        exit();
    } else {
        include "Model/User.php";

        $user = get_user_by_id($conn, $id);
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $new_password = password_hash($new_password, PASSWORD_DEFAULT);

                $data = array($full_name, $new_password, $id);
                update_profile($conn, $data);

                $em = "User updated successfully";
                header("Location: ../edit-profile.php?success=$$em");
                exit();
            } else {
                $em = "Incorrect password";
                header(header: "Location: ../edit_profile.php?error=$em");
                exit();
            }
        } else {
            $em = "Unknown error occuerd";
            header("Location: ../edit_profile.php?error$em");
            exit();
        }
    }
} else {
    $em = "Unknown error occuerd";
    header("Location: ../login.php?error$em");
    exit();
}
