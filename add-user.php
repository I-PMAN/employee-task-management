<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == 'admin') {

?>
  <!DOCTYPE html>
  <html>

  <head>
    <title>Add User</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/style.css" />
  </head>

  <body>
    <input type="checkbox" id="checkbox" />
    <?php include "inc/header.php" ?>
    <div class="body">
      <?php include "inc/nav.php" ?>
      <section class="section-1">
        <h4 class="title">Add Users <a href="user.php">Users</a></h4>
        <form action="app/add-user.php" class="form-1" method="POST">
          <?php if (isset($_GET['error'])) { ?>
            <div class="danger" role="alert">
              <?php echo stripcslashes($_GET['error']); ?>
            </div>
          <?php } ?>
          <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-success" role="alert">
              <?php echo stripcslashes($_GET['success']); ?>
            </div>
          <?php }
          ?>
          <div class="input-holder">
            <label for="">Full Name</label>
            <input type="text" name="full_name" class="input-1" placeholder="Full Name"><br>
          </div>
          <div class="input-holder">
            <label for="">Username</label>
            <input type="text" name="user_name" class="input-1" placeholder="Username"><br>
          </div>
          <div class="input-holder">
            <label for="">Password</label>
            <input type="text" name="password" class="input-1" placeholder="Password"><br>
          </div>
          <button class="edit-btn">Add</button>
        </form>

      </section>
    </div>
  </body>

  </html>

<?php } else {
  $em = "Login First.";
  header("Location: login.php?error=$em");
  exit();
}
?>