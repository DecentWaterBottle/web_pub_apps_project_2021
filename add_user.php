<html>
<head>
	<title>Add User</title>
</head>
<body>
<form action="add_user.php" method = "POST" id="submit_user_form">

<p>Name:  <br> <input type = "text" name = "name" required>

<p>Image: <br>
<!-- <p><textarea name = "image" required></textarea> -->
<?php 
    $directory = "images";
    if(is_dir($directory)){
        $open_dir = opendir($directory);
        while (($file = readdir($open_dir)) !== false) {
            if($file != "." && $file != "..") {
                echo "<img src='$directory/$file' height=100px width=100px>";
                echo "<input type='radio' name='image' id='$file' value='$file' checked required>";
            }
        }
    }
    else {
        echo "This is not a directory";
    }


?>
<p><input type = "submit" name="submit"></p>
</form>
<p><a href="index.html">Homepage</a></p>

<?php

    // Database 
    $db = mysqli_connect ("localhost", "root", "", "assign_1");
    $charset = mysqli_set_charset ($db, 'utf8');

        if(isset($_POST["submit"])) {
            $image = $_POST['image'];
            $name = $_POST['name'];
        
        $safe_image = mysqli_real_escape_string($db, $image);
        $safe_name = mysqli_real_escape_string($db, $name);
        $result = mysqli_query ($db, "INSERT into users (image, name) VALUES ('$safe_image','$safe_name');");
        }

?> 

</body>

<script>

	// function sendData() {
	// 	var data = new FormData(document.getElementById("submit_user_form"));
	// 	var xmlReq = new XMLHttpRequest();
	// 	xmlReq.open("POST", "add_user.php");
	// 	xmlReq.send(data);
	// }
</script>

</html>