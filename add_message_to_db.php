<?php 
$db = mysqli_connect("localhost", "root", "", "assign_1");

    $user_id = $_POST["id"];
    $content = $_POST["text"];

    $safe_user_id = mysqli_real_escape_string($db, $user_id);
    $safe_content = mysqli_real_escape_string($db, $content);
    $insert_post = mysqli_query ($db, "INSERT into user_posts (user_id, text, date) VALUES ('$safe_user_id','$safe_content', now());");

    $result = mysqli_query ($db, "SELECT * FROM user_posts;");
?>