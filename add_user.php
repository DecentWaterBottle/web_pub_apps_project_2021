<html>
<head>
	<title>Add User</title>
</head>
<body>

<form action="add_user.php" method = "POST" id="submit_user_form">
<p>Name:  <br> <input type = "text" name = "name" required>
<p>Image: <br>
<input type='radio' name='image' id='noavatar.jpg' value='noavatar.jpg' checked required>No Avatar<br>

<!-- PRINTING IMAGES FROM THE IMAGES FOLDER-->
<?php 
    $directory = "images";
    if(is_dir($directory)){
        $open_dir = opendir($directory);
        while (($file = readdir($open_dir)) !== false) {
            if($file != "." && $file != "..") {
                echo "<img src='$directory/$file' height=100px width=100px>";
                echo "<input type='radio' name='image' id='$file' value='$file' checked required><br>";
            }
        }
    }
    else {
        echo "This is not a directory";
    }
?>
<!-- Submit information to database -->
<p><input type = "submit" name="submit"></p>
</form>

<!-- Link to return to homepage -->
<p><a href="index.php">Homepage</a></p>

<?php
    // Connect to database
    $db = mysqli_connect ("localhost", "root", "", "assign_1");
    // Set charset
    $charset = mysqli_set_charset ($db, 'utf8');
        // Check if submit was clicked
        if(isset($_POST["submit"])) {
            $image = $_POST['image'];
            $name = $_POST['name'];
            // Make variables safe
            $safe_image = mysqli_real_escape_string($db, $image);
            $safe_name = mysqli_real_escape_string($db, $name);
            // Send the data to the database
            $result = mysqli_query ($db, "INSERT into users (image, name) VALUES ('$safe_image','$safe_name');");
        }

?> 

</body>

<script>
</script>

</html>