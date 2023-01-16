<?php
  $email = $_REQUEST['email'] ;
  $message = $_REQUEST['message'] ;

  mail( "khyatipandya.95@gmail.com", "Feedback Form Results",
    $message, "From: $email" );
  header( "Location: http://www.example.com/thankyou.html" );
?>
