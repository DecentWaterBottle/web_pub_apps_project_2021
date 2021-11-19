
<?php
    $db = mysqli_connect ("localhost", "root", "", "assign_1");
    $charset = mysqli_set_charset ($db, 'utf8');
    $image = $_POST['image'];
    $name = $_POST['name'];
    $safe_image = mysqli_real_escape_string($db, $image);
    $safe_name = mysqli_real_escape_string($db, $name);

    $result = mysqli_query ($db, "INSERT into users (image, name) VALUES ('$safe_image','$safe_name');");

?>
