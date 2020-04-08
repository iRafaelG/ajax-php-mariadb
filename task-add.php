<?php

include('database.php');

if(isset($_POST['name'])){
    $name = $_POST['name'];
    $description = $_POST['description'];

    $query = "INSERT INTO tasks(name, description) VALUE('$name', '$description')";

    $result = mysqli_query($conn, $query);

    if(!$result){
        die('Query error');
    }

    echo 'Task added successfully';
}