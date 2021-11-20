<?php
    // Connect to database
    $db = mysqli_connect("localhost", "root", "", "assign_1");

    // Query the database for messages, limiting them to 20 and ordering in reverse
    $result = mysqli_query ($db, "SELECT * FROM user_posts ORDER BY post_id DESC LIMIT 20;");

    // For every row in the table...
    while ($row = mysqli_fetch_array ($result))
    {
        // Query the user database for the user's information
        $user_id = $row['user_id'];
        $user_result = mysqli_query($db, "SELECT * FROM users WHERE user_id = '$user_id';");
        $user_array = mysqli_fetch_array($user_result);
        // Display the information on the page
        echo "<div class='user_post'>";
        echo "<tr>";
        echo '<th rowspan=2> <img height=100px src=images/'.$user_array["image"].'></th>';
        echo "<td class='user_name'><b>{$user_array['name']}</b> <span style='font-size:15px;'>{$row['date']}</span></td>";
        echo "</tr><tr>";
        echo "<td class='user_message'>{$row['text']}</td>";
        echo "</tr>";
        echo "</div>";
    }
?>