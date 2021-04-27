<?php 

// This is the logout page for this site
require ('includes/config2.inc.php');
$page_title = 'Logout';
include ('includes/header.php');

//If no forst_name session varable exists, reirect the user:

    if(!isset($_SESSION['first_name'])) {
        $url = BASE_URL . '/index.php'; //Define the URL.

        ob_end_clean(); //Delete the buffer.

        header("Location: $url");
        exit(); //Quit the script. 
    } else {
        //Log out the user if they are currently logged in. 

        $_SESSION = array(); //Destroy the variables
        //The above code resets the session variables
        

        session_destroy(); //Destroy the session itself. 
        setcookie(session_name(), '', time() - 300); //Destroy the cookie.
    }

    //Print a customized message: 
    echo '<h3>You are now logged out. </h3>';
    include ('includes/footer.php');
?>
