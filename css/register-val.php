<?php 

if(isset($_POST['submit'])) {
	echo "confirmed";

}



    if (isset($_POST['submit'])) {
    //Handle the form. 

    require (MYSQL);

    //create an empty error array
    $msg = [];


    //Trim all the incoming data;
    $trimmed = array_map('trim', $_POST);

    //Assume invalid values: 
    $fn = $ln = $e = $p = $b = $g =$ph = $lv = $dp =  FALSE;

    // Check for a first name: 
    if (isset($_POST['first_name'])) {
         $fn =  clean(['first_name']);
         } else {
            $msg = "Please enter your first name!";
                    $css_class = "alert-danger";
     }

// Check for a last name: 
    if (isset($_POST['last_name'])) {
    $ln = clean($_POST['last_name']);
    } else {
        $msg = "Please enter your Last name!";
           $css_class = "alert-danger";
    }

// Check for a birthday
    if(isset($_POST['birthday'])) {
        $b = clean($_POST['birthday']);
    } else {
        $msg = "Birthday field cannot be empty!";
            $css_class = "alert-danger";
    }

// Check for gender
    if(isset($_POST['gender'])) {
        $msg = clean($_POST['gender']);
    } else {
        $errors = "No gender inputed";
        $css_class = "alert-danger";
    }

// Check for an email address: 
    if (isset($_POST['email'])) {
        $e = clean($_POST['email']);
    } else {
        $msg = "Please enter a valid email Address!";
                $css_class = "alert-danger";
    }

//Check for phone number
    if(isset($_POST['phone'])) {
        $ph = clean($_POST['phone']);
    } else {
        $msg = "Phone field cannot be empty!";
        $css_class = "alert-danger";
    }


// Check for a password and match against the confirmed passwodrd:
    if (isset($_POST['password1'])  {
        if ($_POST['password1'] == $_POST['password2']) { //If the two passwords match
            $p = clean($_POST['password1']);
        } else {
            //$msg = "Your password did not match the confirmed password!";
            //$css_class = "alert-danger";
            echo "Your passwords did not match";
        }
    } else {
        $msg ='<p class="error">Please enter a valid password, it must be greater than 4 and not more than 20 characters! </p>';
            $css_class = "alert-danger";
    }

//Check for deparment
    if(isset($_POST['department'])){
        $dp = clean($_POST['department']);
    } else {
        $msg = "department not selected department";
        $css_class = "alert-danger";
    }
//Check for a valid Level
    if(isset($_POST['level'])){
        $lv = clean($_POST['level']);
    } else {
        $msg = "Level not selected";
        $css_class = "alert-danger";
    } 

    if ($fn && $e &&$p  ) {
        //If everything's OK...
        //Make sure the email address is available: 
        $q = "SELECT id FROM users WHERE email='$e' ";

        $r = mysqli_query($db, $q) or trigger_error("Query: $q\n<br/>MYSQL Error: " . mysqli_error($dbc)); 

        if(mysqli_num_rows($r) == 0 ) {
            //If the email address is  Available(Not been registered already). 
            //Create the activation code: 
            $a = md5(uniqid(rand(), true));

            //Add the user to the database: 
            $q = "INSERT INTO users (email, pass, first_name, last_name, active, registration_date) VALUES ('$e', md5(SHA1('$p')), '$fn', '$ln', '$a', NOW() )";

            $r = mysqli_query($db, $q) or trigger_error("Query: $q\n<br/> MySQL Error: ".mysqli_error($db));

            if (mysqli_affected_rows($db) == 1) {
                // If it ran OK. 

                // Send the email: 
                $body = "Thank your for registering at our site. To activate your account, please click on this link: \n\n";

                $body .= BASE_URL . 'activate.php?x=' . urlencode($e) . "&y=$a";
                mail($trimmed['email'], 'Registration Confirmation', $body, 'From: Admin@djls.com.ng');

                //Finish the page: 
                $msg = '<h3>Thank you for
                registering! A confirmation email
                has been sent to your address.
                Please click on the link in that
                email in order to activate your
                account.</h3>';
                $css_class = "alert-danger";

                include ('includes/footer.php');
                // Include the HTML  footer.
                exit(); //Stop the page. 

            } else {
                // If it did not OK.
                $msg = '<p class="error">You could
                        not be registered due to a system
                        error. We apologize for any
                        inconvenience.</p>';
                $css_class = "alert-danger";

                 }        
            } else {
                //The email address is not available
                
                $msg = '<p class="error">That email
                address has already been registered.
                If you have forgotten your password,
                use the link at right to have your
                password sent to you.</p>';
                $css_class = "alert-danger";
            }
        }
            /*} else {
                //If one of the data tests failed. 
                $msg = '<p class="error">Please make sure you fill alll fields. </p>';
                $css_class;

            }*/
            mysqli_close($db);
        }// End  of the main submit conditional. 


    


       
        

 

?>