<?php 

//This page begins the html header for the site

//Start output buffering
ob_start(); 


//Initialize a session: 
  if (session_status() == PHP_SESSION_NONE){ 
            session_start();
        }


//Check for a $page_title value: 

    if(isset($page_title)) {
        $page_title = 'User Registration';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
</head>
<body>
    <div id="Header" > User Registration</div>
    <div id="Content"> 
        <!--End of Header -->
