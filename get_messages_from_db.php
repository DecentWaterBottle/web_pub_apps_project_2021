<?php
$db = mysqli_connect("localhost", "root", "", "assign_1");

    $result = mysqli_query ($db, "SELECT * FROM user_posts ORDER BY post_id DESC LIMIT 20;");
    while ($row = mysqli_fetch_array ($result))
    {
        $user_id = $row['user_id'];
        $user_result = mysqli_query($db, "SELECT * FROM users WHERE user_id = '$user_id';");
        $user_array = mysqli_fetch_array($user_result);
        echo "<div class='user_post'>";
        echo "<tr>";
        echo '<th rowspan=2> <img height=100px src=images/'.$user_array["image"].'></th>';
        echo "<td class='user_name'>{$user_array['name']}</td>";
        echo "</tr><tr>";
        echo "<td class='user_message'>{$row['text']}</td>";
        echo "</tr>";
        echo "</div>";
    }
?>