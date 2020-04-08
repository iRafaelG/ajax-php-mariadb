<?php
include('database.php');

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];

$query = "UPDATE tasks SET name = '$name', description = '$description' WHERE id = '$id'";

$result = mysqli_query($conn,$query);

if (!$result) {
    die('Query error');
}

echo "Task updated successfully";