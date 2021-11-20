<?php 
    // Connect to database
    $db = mysqli_connect("localhost", "root", "", "assign_1");

    // Set variables
    $user_id = $_POST["id"];
    $content = $_POST["text"];

    // Make variables safe
    $safe_user_id = mysqli_real_escape_string($db, $user_id);
    $safe_content = mysqli_real_escape_string($db, $content);

    // Check if the user selected to add the date
    if (isset($_POST["date_checked"])){
        $insert_post = mysqli_query ($db, "INSERT into user_posts (user_id, text, date) VALUES ('$safe_user_id','$safe_content', now());");
    }
    else {
        $insert_post = mysqli_query ($db, "INSERT into user_posts (user_id, text) VALUES ('$safe_user_id','$safe_content');");
    }

    // Return the result 
    // $result = mysqli_query ($db, "SELECT * FROM user_posts;");
?>