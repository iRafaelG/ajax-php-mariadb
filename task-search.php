<?php

include('database.php');

if (!empty($_POST['search'])) {

    $search = $_POST['search'];

    $query = "SELECT * FROM tasks WHERE name LIKE '%$search%'";
    $result = mysqli_query($conn, $query);

    if (!$result) {

        die(json_encode('Query error ' . mysqli_error($conn)));
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
}
