<?php
$db = mysqli_connect("localhost", "root", "", "assign_1");

user_id = $_POST["id"];

    $result = mysqli_query ($db, "SELECT * FROM user_posts;");

    // while ($row = mysqli_fetch_array ($result))
    // {
    //     echo "<p>User ID: {$row['user_id']}</p>\n";
    //     echo "<p>Text: {$row['text']}</p>\n";
    // }
?>