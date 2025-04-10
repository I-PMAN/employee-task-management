<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])){
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Manage Users</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <input type="checkbox" id="checkbox" />
   <?php include "inc/header.php" ?>
    <div class="body">
    <?php include "inc/nav.php" ?>
      <section class="section-1">
        <h4 class="title">Manage Users <a href="add-user.php">Add User</a></h4>
        <table class="main-table">
          <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>role</th>
            <th>Action</th>
          </tr>
          <tr>
            <td>1</td>
            <td>Raj</td>
            <td>raj</td>
            <td>Employee</td>
            <td>
              <a href="" class="edit-btn">Edit</a>
              <a href=""class="delete-btn">Delete</a>
            </td>
          </tr>
        </table>
      </section>
    </div>
  </body>
</html>

<?php } else{
  $em = "Login First.";
  header("Location: login.php?error=$em");
  exit();
}
?>
