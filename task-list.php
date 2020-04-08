<?php

include('database.php');

$query = "SELECT * FROM tasks";

$result = mysqli_query($conn, $query);

if (!$result) {
    die('Query error ' . mysqli_error($conn));
}

while ($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'id' => $row['id'],
        'name' => $row['name'],
        'description' => $row['description']
    );
}

$jsonString = json_encode($json);

echo $jsonString;