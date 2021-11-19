<!-- <meta http-equiv="content-type" content="text-html; charset=ISO-8859-1"> -->

<?php 
$db = mysqli_connect ("localhost", "root", "", "assign_1");

if (!$db)
{
	echo "Sorry! Can't connect to database";
	// exit();
}

else{
    echo "Working"
}

$myresult = mysqli_query ($db, "SELECT * FROM user_posts;");
while ($row = mysqli_fetch_array ($result))
{
    echo "<div class = 'result'>{$row['text']}</div>\n";
}


?>
