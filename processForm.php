<?php

session_start();
include "DBConn.php";

//when submit button is clicked
if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

   if (!empty($name) && !empty($email) && !empty($message) ) {
        $link = mysqli_connect("localhost", "root", "","easynet" );
        if ($link ==false) {
            die(mysqli_connect_error());
        }
        $sql = "INSERT INTO message (name, email, message) VALUES ('$name','$email' ,'$message')";
        if (mysqli_query($link, $sql)) {
            echo "Message sent successfully...";
        } else {
            echo "something went wrong :(";
        }
   } else {
        echo "please provide all information!";
   }
}





