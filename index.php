<html>
    <head>
        <style>
            #posts {
                border: 2px solid black;
                display: flex;
                flex-direction: column;
                justify-content:center;
                width: 500px;
                margin-left: auto;
                margin-right: auto;
            }
            .user_post {   
                width: 100px;
            }
            #form_area {
                text-align: center;
                margin: auto;
            }
        </style>
        <script>
            window.onload = init;

            function init () {
                document.getElementById("submit_message").onclick = sendMessage;
                get_messages();
            }

            function sendMessage() {
                var id = document.querySelector( 'input[name="user"]:checked').value;      
                var text = document.getElementById('message').value;
                console.log(text);
                var url = "add_message_to_db.php";
                var xmlReq = new XMLHttpRequest();
                xmlReq.open ("POST", url);
                xmlReq.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
                
            var data = `id=${escape(id)}&text=${escape(text)}`;
            xmlReq.send(data);
            get_messages();
            }

            function get_messages() {
                var url = "get_messages_from_db.php";
                var xmlReq = new XMLHttpRequest();
                xmlReq.open ("POST", url);

                xmlReq.send(null);
                xmlReq.onreadystatechange = function ()
                {
                    if (xmlReq.readyState == 4 && xmlReq.status == 200)
                    {
                        document.getElementById("posts").innerHTML = xmlReq.responseText; 
                    } 		
                };
            };

            setInterval(function()
            { 
                get_messages();
            }, 
            5000);

        </script>
    </head>
    <body>
        <p><a href="add_user.php">Add User</a></p>
        
        <h1 style="text-align:center;">Blog</h1>
        <div id="form_area">
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
        
            <textarea name = "message" id="message"></textarea><br>
            <button value="Submit" name="submit_post" id="submit_message">Submit</button>
        </div>

        <div>
            <table id="posts">

            </table>
        </div>


    </body>
</html>
