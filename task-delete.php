<?php

include('database.php');

isset($_POST['id']) ? $id = $_POST['id'] : $id = '';

$query = "DELETE FROM tasks WHERE id = '$id'";

$result = mysqli_query($conn, $query);

if(!$result){
    die('Query error');
}

echo "Tasks deleted successfully";