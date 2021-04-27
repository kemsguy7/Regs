<?php 
//This Page allows a user to reset their password, if forgotten. 


require ('includes/config2.inc.php');
$page_title = 'Forgot Your password';

include ('includes/header.php');

if (isset($_POST['submit'])) {

    $errors = array();

    require (MYSQL);

    // Assume Nothing: 
    $uid = FALSE; 

    //Validate the email address...
    if (!empty($_POST['email'])) {

        // Check for the existence of that email address...
        $q = 'SELECT id FROM users WHERE email="'. clean($_POST['email']). ' "';

        $r = mysqli_query ($mysqli, $q) or trigger_error("Query: $q\n<br/> MySQL Error: ". mysqli_error($mysqli));

        if (mysqli_num_rows($r) == 1) {
            // Retrieve the user ID: 
            list($uid) = mysqli_fetch_array ($r, MYSQLI_NUM);
        } else {
            //No database match
            $errors[] = '<p class="error">The submitted email address does not match those on file! </p>';
        }
    } else {
        //No email
        $errors[] = '<p class="error">You forgot to enter your email address! </p>';
    } //End of empty ($_POST['email']) IF.

    if ($uid) {
        //If everything's OK.

        //Create a new Random password
        // uniqid is fed 2 values, rand() and true which make the returnes string more random
        // The password is now determined by pulling out ten characters starting with the 3rd on
        $p = substr (md5(uniqid(rand(), true)), 3, 10);

        //Update the database: 
        $q = "UPDATE users SET password= md5(sha1('$p')) WHERE id =$uid LIMIT 1";

        $r = mysqli_query ($mysqli, $q) or trigger_error("Query: $q\n<br/>MySQL Error: ".mysqli_error($mysqli));

        if (mysqli_affected_rows($mysqli) == 1) {
            //If it ran OK.

            //Send an email: 
            $body = "Your password to log into
            our website has been temporarily
            changed to ";
            $body .= md5(SHA1($p)). " Please log in using
            this password and this email address.
            Then you may change your password to
            something more familiar.";

            mail (clean($_POST['email']), 'Your temporary password.', $body, 'From:admin@djls.com.ng');

            //Print a message and wrap up
            echo '<h3>Your password has been
            changed. You will receive the new,
            temporary password at the email
            address with which you registered.
            Once you have logged in with this
            password, you may change it by
            clicking on the "Change Password"
            link, click <a href="login.php">here </a> and go back to login.</h3>';

            mysqli_close($mysqli);
           
            exit(); //Stop the script
        } else {
            //If it did not run OK.
            echo '<p class="error">Your password could not be changed due to a system error. We apologize for the inconvenience. </p>';
        }

    } else {
        // Failed the validation test
        echo '<p class="error">Please try again. </p>';
    }

    mysqli_close($mysqli);
} //End of the main Submit conditional. 
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Au Register Forms by Colorlib</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Reset your password</h2>
                     
                  
                    <form method="post" action="forgot_password.php" id="form">
                          <?php if(!empty($msgs)): ?>
                        <div class ="alert <?php echo $css_class; ?>">
                             <p class="text-center" id="msg"> </p>
                            <?php foreach ($msgs as $msg) {
                                    echo $msg;
                                        }
                            ?>

                        </div>
                    <?php endif; ?>

                        <div class="row row-space">
                    
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Email</label>
                                    <input class="input--style-4" type="email" name="email"
                                       value="<?php if (isset($_POST['email'])) echo $_POST['email'];?>">
                                </div>
                            </div>
                         
                        
                        
                        
                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" type="submit" name="submit">Reset Password</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
  
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>



    <!-- Main JS-->
    <script src="js/global.js"></script> 
      

    
</body>

</html>
<!-- end document-->