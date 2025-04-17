<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
    include "DB_connection.php";
    include "app/Model/Task.php";
    include "app/Model/User.php";

    if (!isset($_GET['id'])) {
        header("Location: tasks.php");
        exit();
    }
    $id = $_GET["id"];
    $task = get_task_by_id($conn, $id);

    if ($task == 0) {
        header("Location: tasks.php");
        exit();
    }
    $users = get_all_users($conn);
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Edit Task</title>
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
                <h4 class="title">Edit Task <a href="tasks.php">Tasks</a></h4>
                <form action="app/update-task.php" class="form-1" method="POST">
                    <?php if (isset($_GET['error'])) { ?>
                        <div class="danger" role="alert">
                            <?php echo stripcslashes($_GET['error']); ?>
                        </div>
                    <?php } ?>
                    <?php if (isset($_GET['success'])) { ?>
                        <div class="success" role="alert">
                            <?php echo stripcslashes($_GET['success']); ?>
                        </div>
                    <?php }
                    ?>
                    <div class="input-holder">
                        <label for="">Title</label>
                        <input type="text" name="title" class="input-1" placeholder="Title" value="<?= $task['title'] ?>"><br>
                    </div>
                    <div class="input-holder">
                        <label for="">Description</label>
                        <textarea type="text" name="description" rows="5" class="input-1" placeholder="Description"><?= $task['description'] ?></textarea><br>
                    </div>
                    <div class="input-holder">
                        <label for="">Assigned To</label>
                        <select name="assigned_to" id="" class="input-1">
                            <option value="0">Select Employee</option>
                            <?php if ($users != 0) {
                                foreach ($users as $user) {
                                    if ($task['assigned_to'] == $user['id']) { ?>
                                        <option selected value="<?= $user['id'] ?>"><?= $user['full_name'] ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $user['id'] ?>"><?= $user['full_name'] ?></option>

                            <?php }
                                }
                            } ?>
                        </select>
                        <br>
                    </div>
                    <input type="text" name="id" value="<?= $task['id'] ?>" hidden>
                    <button class="edit-btn">Update</button>
                </form>

            </section>
        </div>
        <script type="text/javascript">
            var active = document.querySelector("#navList li:nth-child(4)");
            active.classList.add("active");
        </script>
    </body>

    </html>

<?php } else {
    $em = "Login First.";
    header("Location: login.php?error=$em");
    exit();
}
?>