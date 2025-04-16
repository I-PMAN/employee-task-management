<?php
function insert_task($conn, $data)
{
    $sql = "INSERT INTO tasks (title, description, assigned_to) VALUES(?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
}
