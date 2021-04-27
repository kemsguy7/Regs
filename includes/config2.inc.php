<?php 
    /* This script:
 * - define constants and settings
 * - dictates how errors are handled
 * - defines useful functions
 */

 // Document who created this site, when, why, <e class="t c">
    ob_start();

    session_start();

 //Flag variable for site status: 
    define('LIVE', FALSE);

    //Admin contact address:
    define('EMAIL', 'mattidungafa@gmail.com');

    //Site url (base for all redirections):
    define ('BASE_URL', 'http://localhost/Regs/');

    //define the registration url
     define ('REG_URL', 'http://localhost/Regs/');

    //Locaiton of the Mysql connection script: 
 
    define ('MYSQL', 'includes/db.php');

    //Adjust the time zone for PHP 5.1 and greater: 
    date_default_timezone_set ('Africa/Lagos');

    // ***********SETTINGS**********//
    //***************************** *//

    //****************************

    //**************ERROR MANAGEMENT
    //********** */
    //Create the error handler: 
 /* function my_error_handler ($e_number, $e_message, $e_file, $e_line, $e_vars) {

        //Build the error message. 
        $message = "<p>An error occured in the script
        '$e_file' on line $e_line: $e_message\n<br/> </p>";

        //Add the date and time: 
        $message = "Date/Time: " . date('n-j-Y H:i:s'). "\n<br/>";

        //Append $_vars to the $message: 
        $message = "<pre>". print_r($e_vars, 1).  "</pre>\n</p>";

        if (!LIVE) {
            //Development (print the error)

            echo '<div id="Error">' . $message . '</div><br/>';
        } else {
            //Don't show the error: 
            //Send an email to the admin: 

            mail(EMAIL, 'Site Error!', $message, 'From: email@djls.com.ng.com');

            //Only print an error message if the error isn't a notice: 

            if ($_number !=E_NOTICE)  {
                echo '<div id="Error">A system error occured. We apologize for the inconvenience.</div><br/>';
            }
        } //End of !LIVE IF.
    } // End of my_error_handler() definition. 

    //Use my error handler. 
    set_error_handler ('my_error_handler');

    //**********ERROR MANAGEMENT ********** */

    //********************************* */

    function clean($data) {
        global $mysqli;
        $data = mysqli_real_escape_string($mysqli, $data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        return $data;
  }
?>