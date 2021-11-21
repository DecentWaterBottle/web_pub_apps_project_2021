<?php
    header("Content-type: text/xml");
    // Connect to database
    $db = mysqli_connect("localhost", "root", "", "assign_1");
    // $xml = new XMLWriter();
    // $xml->openURI('php://output');

    // $xml->startElement('Message');

    // $xml_header = "<?xml version='1.0' encoding='UTF-8'><Messages></Messages>";
    // $xml = new SimpleXMLElement($xml_header);
    $xml = new DOMDocument('1.0', 'UTF-8');
    $main_element = $xml->createElement("messages");
    $xml->appendChild($main_element);
    

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
        // $xml->startElement('message');
        // $xml->writeAttribute("name", "bob");
        // $xml->writeAttribute("image", "david");
        // $xml->writeAttribute("text", "aleks");
        // $xml->startElement("name");
        // $xml->endElement();
        // $xml->endElement();
        // $node = $xml->addChild("message");
        // $node->addAttribute("name", "bob");
        // $node->addAttribute("image", "image");
        // $node->addAttribute("text", "text");
        // Root node
        $root = $xml->createElement("message");
        $main_element->appendChild($root);

        $name = $xml->createElement("name");
        $root->appendChild($name);
        $text = $xml->createTextNode("{$user_array["name"]}");
        $name->appendChild($text);

        $image = $xml->createElement("image");
        $root->appendChild($image);
        $text = $xml->createTextNode("{$user_array["image"]}");
        $image->appendChild($text);

        $user_text = $xml->createElement("text");
        $root->appendChild($user_text);
        $text = $xml->createTextNode("{$row['text']}");
        $user_text->appendChild($text);
        
    }
    echo $xml->saveXML();
    // echo $xml->flush();?
    // echo $xml->asXML();
?>