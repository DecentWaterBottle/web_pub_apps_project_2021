<html>
<head>
<style>
    html *{
        font-family: Arial;
    }
    #posts {
        border: 2px solid black;
        display: flex;
        flex-direction: column;
        width: 500px;
        height: 600px;
        margin-left: auto;
        margin-right: auto;
        overflow: scroll;
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
    // When the page first loads
    function init () {
        document.getElementById("submit_message").onclick = sendMessage;
        get_messages();
    }


    // Sending a message to the database
    function sendMessage() {
        // Setting variables
        var date_checked = document.getElementById("add_time").checked;
        var id = document.querySelector( 'input[name="user"]:checked').value;      
        var text = document.getElementById('message').value;
        // Checking if there is text in the message box
        if (text.trim() == ""){
            document.getElementById("error_msg").innerHTML = "<br>Error. Text field must contain text";
        }
        else {
            // Beginning Request
            var url = "add_message_to_db.php";
            var xmlReq = new XMLHttpRequest();
            xmlReq.open ("POST", url);
            xmlReq.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
            
            // Sending different data depending on whether the user has chosen to include the time
            if (date_checked){
                console.log("Date Checked");
                var data = `id=${escape(id)}&text=${escape(text)}&date_checked="true"`;
            }
            else {
                console.log("Date not checked");
                var data = `id=${escape(id)}&text=${escape(text)}`;
            }
            // Sending data
            xmlReq.send(data);
            // Displaying updated messages
            get_messages();
            // Resetting the message box and error_msg area
            document.getElementById('message').value = "";
            document.getElementById("error_msg").innerHTML = "";
        }
    }


    // Retrieve messages from the database
    function get_messages() {
        var url = "xml_get_messages_from_db.php";
        var xmlReq = new XMLHttpRequest();
        xmlReq.open ("GET", url);
        var xml;

        
        // PHP Response
        xmlReq.onreadystatechange = function ()
        {
            if (xmlReq.readyState == 4 && xmlReq.status == 200)
            {
                // Display the posts
                xml = xmlReq.responseText;
                console.log(xml);
                var table_content = "";
                parser = new DOMParser();
                xmlDoc = parser.parseFromString(xml,"text/xml");
                // console.log(xmlDoc);
                var message = xmlDoc.getElementsByTagName("message");
                for(i = 0; i < message.length; i++){
                    console.log(message[i].getElementsByTagName("text")[0].childNodes[0].nodeValue);
                    table_content += "<div class='user_post'> <tr>";
                    table_content += "<th rowspan=2> <img height=100px src='images/" + message[i].getElementsByTagName("image")[0].childNodes[0].nodeValue + "'></th>"; 
                    table_content += "<td class='user_name'><b>" + message[i].getElementsByTagName("name")[0].childNodes[0].nodeValue + "</b></td>";
                    table_content += "</tr><tr>";
                    table_content += "<td class='user_message'>" + message[i].getElementsByTagName("text")[0].childNodes[0].nodeValue + "</td>";
                    table_content += "</tr>";
                    table_content += "</div>";
                }
                document.getElementById("posts").innerHTML = table_content;
            } 		
        // echo "<div class='user_post'>";
        // echo "<tr>";
        // echo '<th rowspan=2> <img height=100px src=images/'.$user_array["image"].'></th>';
        // echo "<td class='user_name'><b>{$user_array['name']}</b> <span style='font-size:15px;'>{$row['date']}</span></td>";
        // echo "</tr><tr>";
        // echo "<td class='user_message'>{$row['text']}</td>";
        // echo "</tr>";
        // echo "</div>";
        };
        // var parser = new DOMParser();
        // var xmlString = parser.parseFromString(xml, "text/xml");
        // console.log(xmlString);
        // parser = new DOMParser();
        // xmlString = parser.parseFromString(xml, "text/xml");
        // console.log(xmlString);
        
        xmlReq.send(null);
    };
    

    // Finding new posts every 5 seconds
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
        <input type="checkbox" id="add_time" name="add_time" value="add_time">Add Time<br>
        <textarea name = "message" id="message"></textarea><br>
        <button value="Submit" name="submit_post" id="submit_message">Submit</button>
        <span id="error_msg"></span>
    </div>

    <div>
        <table id="posts">

        </table>
    </div>


</body>
</html>
