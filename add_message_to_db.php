<?php 
$db = mysqli_connect("localhost", "root", "", "assign_1");
    // $user_id = $_POST['user_id'];
    // $content = $_POST['text'];

    // $data = json_decode(file_get_contents("php://input"), TRUE);
    // $user_id = $data->user_id;
    // $content = $data->text;
    // echo $data->user_id;
    // echo $data->text;
    // $text = isset($_POST["text"]) ? $_POST["text"] : "";
    // $id = isset($_POST["id"]) ? $_POST["id"] : "";
    // $text = isset($_POST["text"]);
    // $id = isset($_POST["id"]);

    $user_id = $_POST["id"];
    $content = $_POST["text"];

    echo "\n$content";
    echo "\n$user_id";
    // echo "\n$norm";

    $safe_user_id = mysqli_real_escape_string($db, $user_id);
    $safe_content = mysqli_real_escape_string($db, $content);
    $insert_post = mysqli_query ($db, "INSERT into user_posts (user_id, text, date) VALUES ('$safe_user_id','$safe_content', now());");

    $result = mysqli_query ($db, "SELECT * FROM user_posts;");

    // while ($row = mysqli_fetch_array ($result))
    // {
    //     echo "<p>User ID: {$row['user_id']}</p>\n";
    //     echo "<p>Text: {$row['text']}</p>\n";
    // }

?>