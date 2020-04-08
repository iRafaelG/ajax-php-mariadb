<?php

include('database.php');

isset($_POST['id']) ? $id = $_POST['id'] : $id = '';

$query = "SELECT * FROM tasks WHERE id = '$id'";

$result = mysqli_query($conn, $query);

if(!$result){
    die('Query error');
}

while($row = mysqli_fetch_array($result)){
    $json[] = array(
        'id' => $row['id'],
        'name' => $row['name'],
        'description' => $row['description']
    );
}

$jsonString = json_encode($json[0]);
echo $jsonString;