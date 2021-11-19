<html>
    <head>
        <script>
            function getUsers() {
                var xmlReq = new XMLHttpRequest();
                xmlReq.open("GET");

                xmlReq.onreadystatechange = function() {
                    if (xmlReq.readyState == 4 && xmlReq.status == 200){
                        document.getElementById("userTxt").innerHTML = xmlReq.responseText;
                    }
                };
                
                xmlReq.send();
            }
        </script>
    </head>
    <body>
        <p><a href="add_user.php">Add User</a></p>
        <p>Users: <span id="userTxt"></span></p>

        <h1>Blog</h1>
        <p>Names: </p>
            <form method="post">
                <?php 
                    $db = mysqli_connect("localhost", "root", "", "assign_1");
                    $charset = mysqli_set_charset ($db, 'utf8');
                    $query_result = mysqli_query($db, "SELECT * FROM user_posts;");
                    if (mysqli_num_rows($query_result) == 0) {
                        echo "No Results\n";
                    }
                    else {
                        echo "Results Found\n";
                    }
                    while ($row = mysqli_fetch_array($query_result))
                    {
                        echo "<p>{$row['text']}\n</p>";
                    }

                ?>
            <input type="radio" name="user" value="bob" checked>First
            <br> 
            <input type="radio" name="user" value="alex">Second
            </br>
            <textarea name = "message"></textarea>
            <input type="submit" value="Submit" name="submit_post">
        </form >
    </body>
</html>
