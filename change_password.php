<?php  
 // This page allows a logged-in usee to change their password

 require ('includes/config2.inc.php'); 

 $page_title = 'Change your password';

 include ('includes/header.php'); 

 //If no first_name session variable exists, redirect the uset: 
 if (!isset($_SESSION['first_name'])) {

    $url = BASE_URL . '/index.php'; //Define the URL
    ob_end_clean(); //Delete the buffer. 
    header("Location: $url");
    exit(); //Quit the script.

 }

 if (isset($_POST['submitted'])) {
     require (MYSQL);

     //Check for a new password and match against the confirmed password: 

     $p =FALSE;
     
     if (preg_match ('/^(\w){4,20}$/', $_POST['password1'])) {
        if ($_POST['password1'] == $_POST['password2']) {
            $p = mysqli_real_escape_string($db, $_POST['password1']);
        } else {
            echo '<p class="error">Your Password did not match the confirmed password! </p>';
        }
     } else {
        echo '<p class="error">Please enter a
        valid password!</p>';
     }
     if($p) {
         //If everything's OK.
            $password = md5(sha1($p));
         //Make the query. 
         $q ="UPDATE users SET pass= '$password', WHERE id={$_SESSION['id']} LIMIT 1 ";

         $r = mysqli_query($db, $q) or trigger_error("Query: $q\n<br/>MySQL Error:". mysqli_error($db));

         if (mysqli_affected_rows($db) == 1) {
             //If it ran OK.
             //Send an email, if desired. 
             echo '<h3>Your Password has been changed. </h3>';

             mysqli_close($db); //Close the databse connection. 

             include ('includes/footer.php'); 
             // Include the footer file
             exit(); 
         } else {
             //If it is not OK
             echo '<p class="error">Your password
                was not changed. Make sure your new
                password is different than the
                current password. Contact the system
                administrator if you think an error
                occurred.</p>';
         }
     } else {
         // Failed the validation test
         echo '<p class="error">Please try again. </p>';

         mysqli_close($db); //Close the database connection
     } //End of the main Submit conditional. 

?>

<h1>Change Your Password</h1>
 <form action="change_password.php" method="post">
 <fieldset>
 <p><b>New Password:</b> <input type="password" name="password1" size="20" maxlength="20" /> <small>Use only
    letters, numbers, and the underscore.
    Must be between 4 and 20 characters
    long.</small></p>
 <p><b>Confirm New Password:</b> <input type="password" name="password2" size="20" maxlength="20" /></p>
 </fieldset>
 <div align="center"><input type="submit" name="submit" value="Change My Password"
/></div>
 <input type="hidden" name="submitted" value="TRUE" />
 </form>