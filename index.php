<html>
    <head>
        <script>
            window.onload = init;
            function init () {
                document.getElementById("submit_message").onclick = sendMessage;
            }
            function sendMessage() {
                var id = document.querySelector( 'input[name="user"]:checked').value;      
                var text = document.getElementById('message').value;
                console.log(text);
                var url = "add_message_to_db.php";
                var xmlReq = new XMLHttpRequest();
                xmlReq.open ("POST", url);
                xmlReq.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
                
                xmlReq.onreadystatechange = function ()
                {
                    if (xmlReq.readyState == 4 && xmlReq.status == 200)
                    {
                        console.log(xmlReq.responseText);
                        document.getElementById("posts").innerHTML = xmlReq.responseText; 
                    } 		
                };
            var data = `id=${id}&text=${text}`;
            xmlReq.send(data);
            }


        </script>
    </head>
    <body>
        <p><a href="add_user.php">Add User</a></p>
        <p>Users: <span id="userTxt"></span></p>

        <h1>Blog</h1>
        <p>Names: </p>
        <?php 
            $db = mysqli_connect("localhost", "root", "", "assign_1");
            $result = mysqli_query ($db, "SELECT * FROM users;");
            while ($row = mysqli_fetch_array ($result))
            {
                echo '<input type="radio" name="user" value='.$row["user_id"].'> '.$row["name"];
                echo "<br>";
            }
        ?>
            </br>
            <textarea name = "message" id="message"></textarea>
            <button value="Submit" name="submit_post" id="submit_message">Submit</button>

        <div id="posts"></div>


    </body>
</html>
