
<?php
   error_reporting(E_ALL);
   ini_set('display_errors', 'on');
    /* Send an SMS using Twilio. You can run this file 3 different ways:
     *
     * - Save it as sendnotifications.php and at the command line, run 
     *        php sendnotifications.php
     *
     * - Upload it to a web host and load mywebhost.com/sendnotifications.php 
     *   in a web browser.
     * - Download a local server like WAMP, MAMP or XAMPP. Point the web root 
     *   directory to the folder containing this file, and load 
     *   localhost:8888/sendnotifications.php in a web browser.
     */
 
    // Step 1: Download the Twilio-PHP library from twilio.com/docs/libraries, 
    // and move it into the folder containing this file.
    require "twilio_files/Services/Twilio.php";
    // Step 2: set our AccountSid and AuthToken from www.twilio.com/user/account
    $AccountSid = "AC2a1ad69e3f0d719a5d69210e17f72ebc";
    $AuthToken = "626e488568fd8f353e1bdb503bca39bf";

    // Google Map Coordinates
    $lat = $_POST["lat"];
    $lng = $_POST["lng"];
    $content = $_POST["content"];
 
    // Step 3: instantiate a new Twilio Rest Client
    $client = new Services_Twilio($AccountSid, $AuthToken);
 
    // Step 4: make an array of people we know, to send them a message. 
    // Feel free to change/add your own phone number and name here.
    $people = array(
        //"+16365421462" => "Casey Leadbetter",
        "+16365447239" => "Thomas Scully"
    );
 
    // Step 5: Loop over all our friends. $number is a phone number above, and 
    // $name is the name next to it
    foreach ($people as $number => $name) {
 
        $sms = $client->account->messages->sendMessage(
 
        // Step 6: Change the 'From' number below to be a valid Twilio number 
        // that you've purchased, or the (deprecated) Sandbox number
            "636-590-7488", 
 
            // the number we are sending to - Any phone number
            $number,
 
            // the sms body
            "Hey $name, Monkey Party at 6PM. Bring Bananas!\n\nIt's at $lat East and $lng North. See you there!\n\n$content"
        );
 
        // Display a confirmation message on the screen
        echo "<p>Sent message to $name</p>";
    }
?>
