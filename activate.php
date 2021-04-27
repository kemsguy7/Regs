<?php 
//This page activates the user's account. 
require ('includes/config2.inc.php');
require ('includes/header.html');

$page_title = 'Activate Your Account';

$name = '';

//Validate $_GET['x'] and $_GET['y']:

$x = $y =FALSE;
 if (isset($_GET['x']) && preg_match('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/',$_GET['x']) ) {

 $x = $_GET['x'];

}
if (isset($_GET['y']) && (strlen($_GET['y']) == 32)) {
    $y = $_GET['y'];
}

//If $x and$y aren't correct, redirect the user. 
if ($x && $y) {

    //Update the database...
    require (MYSQL);
 
    $q = "UPDATE users SET active = NULL WHERE (email='" .mysqli_real_escape_string($mysqli, $x) . "' AND active='" . mysqli_real_escape_string($mysqli, $y) . "') LIMIT 1";

    //second query to get the name
    $q2 = "SELECT * FROM users WHERE email='" .mysqli_real_escape_string($mysqli, $x) . "' ";
    $r2 = mysqli_query($mysqli, $q2) or trigger_error("Query falied".mysqli_error($mysqli));
    while($row = mysqli_fetch_array($r2)){
         $name = $row['first_name'];
    }
    
   //After a user has registered, this page will checck if a confirmation code has been set to the databae
    //if the code in the database matches the one in this script, the record will be removed for the database and srt to null thereby confirming the use has been registered
    $r = mysqli_query ($mysqli, $q) or trigger_error("Query: $q\n<br/>MySQL Error: ". mysqli_error($mysqli));

    // Print a customized message: 
    if (mysqli_affected_rows($mysqli) == 1) {
       global $name;
        echo '<div class="jumbotron">';
        echo ' <h1 class="display-4">Hello, '.$name .'';
        echo ' ! </h1>';
        echo '<p class="lead">Your acount is now active. You can now log in by clicking the button below.</p>
            <hr class="my-4">
            <p class="lead">
            <a class="btn btn-primary btn-lg" href="login.php" role="button">Login</a>
            </p>
            </div>';
    } else {
        echo '<p class="error"> Your account could not be activated. Please re-check the link or contact the system administrator.</font></p>'.mysqli_error($mysqli);
    }

    mysqli_close($mysqli);
} else {
    //Redirect
    $url = BASE_URL . '/index.php'; //Define the url
    ob_end_clean(); //Deletr the buffer
    header("Location: $url");
    exit(); //Quit the script. 
} //End of main IF-ELSE

require('includes/footer2.php');
?>