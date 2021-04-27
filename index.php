<?php //This is the main page for the site. 

    //Include the configuration file: 
 //
 

    require ('includes/config2.inc.php');


    if (isset($_POST['submit'])) {
    //Handle the form. 

    require (MYSQL);

    //create an empty error array
    $msgs = array();

    //Create the time functions
    $CurrentTime=time();
    //Mysql syntax $DateTime=strftime("%Y-%m-%d %H:%M%S", $CurrentTime);

    $DateTime=strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);

    //Create the activation link
    $a = md5(uniqid(rand(), true));

    //Trim all the incoming data;
    $trimmed = array_map('trim', $_POST);

    //Assume invalid values: 
    $fn = $e = $p = FALSE;

    // Check for a first name: 
    if (!empty($_POST['name'])) {
         $fn =  clean($_POST['name']);
         } else {
            $msgs[] = "<p> Please enter your first name! </p>";
            $css_class = "alert-danger";
     }



// Check for an email address: 
     $e = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); 
     if ($e){
        $e = clean($_POST['email']);
     } else {
    
        $msgs[] = "Please enter a valid email Address!";
                $css_class = "alert-danger";
    }




// Check for a password and match against the confirmed passwodrd:
    
        if ($_POST['password1'] == $_POST['password2']) { //If the two passwords match
            $p = clean($_POST['password1']);
        } else {
            $msgs[] = "Your password did not match the confirmed password!";
            $css_class = "alert-danger";
        } 

  
        if(empty($_POST['password1']) || empty($_POST['password2'])) {
            $msgs[] = "Both password fields must be filled out";
            $css_class = "alert-danger";
        } else {
             $p = clean($_POST['password1']);
        }



    if ($fn && $e &&$p) {
        //If everything's OK...
        //Make sure the email address is available: 
        $q = "SELECT id FROM users WHERE email='$e' ";

        $r = mysqli_query($mysqli, $q) or trigger_error("Query: $q\n<br/>MYSQL Error: " . mysqli_error($mysqli)); 

        if(mysqli_num_rows($r) == 0 ) {
            //If the email address is  Available(Not been registered already). 
            //Create the activation code: 
            $a = md5(uniqid(rand(), true));

            //Add the user to the database: 
            $q = "INSERT INTO users (first_name, password, email, active, registration_date)
            VALUES ('$fn', md5(SHA1('$p')), '$e', '$a', '$DateTime' )";

            $r = mysqli_query($mysqli, $q) or trigger_error("Query: $q\n<br/> MySQL Error: ".mysqli_error($mysqli));

            if (mysqli_affected_rows($mysqli) == 1) {
                // If it ran OK. 

                // Send the email: 
                $body = "Thank your for registering at our site. To activate your account, please click on this link: \n\n";

                $body .= REG_URL . 'activate.php?x=' . urlencode($e) . "&y=$a";
                mail(clean($_POST['email']), 'Registration Confirmation', $body, 'From: Admin@djls.com.ng');

                //Finish the page: 
               echo '<h3>Thank you for
                registering! A confirmation email
                has been sent to your address.
                Please click on the link in that
                email in order to activate your
                account.</h3>';
                $css_class = "alert-success";

                include ('includes/footer.php');
                // Include the HTML  footer.
                exit(); //Stop the page. 

            } else {
                // If it did not OK.
                echo  '<p class="error">You could
                        not be registered due to a system
                        error. We apologize for any
                        inconvenience.</p>';
                $css_class = "alert-success";

                 }        
            } else {
                //The email address is not available
                
                $msgs[] = '<p class="error">That email
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
            mysqli_close($mysqli);
        }// End  of the main submit conditional. 


    


       
        

 

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
                    <h2 class="title">Registration Form</h2>

                  
                    <form method="POST" action="index.php" id="form">
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
                                    <label class="label"> name</label>
                                    <input class="input--style-4" type="text" name="name" 
                                    value="<?php if (isset($_POST['name'])) echo $_POST['name'];?>">
                                </div>
                            </div>
                         
                          
                      
                           
                    
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Email</label>
                                    <input class="input--style-4" type="email" name="email"
                                       value="<?php if (isset($_POST['email'])) echo $_POST['email'];?>">
                                </div>
                            </div>
                         
                        
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Password</label>
                                    <input class="input--style-4" type="password" name="password1">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Confirm Password</label>
                                    <input class="input--style-4" type="password" name="password2">
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" type="submit" name="submit">Submit</button>
                        </div>
                        <div class="col-12 text-center"> 
                            Already registered? <a href="login.php">sign in</a>
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
      
    <script> /*
        $(document).ready(function() {
            $('form').submit(function(event){
                let first_name = document.getElementById('first_name').value;
                let last_name = document.getElementById('last_name').value;
                let birthday = document.getElementById('birthday').value;
                let gender = document.getElementById('gender').value;
                let email = document.getElementById('email').value;
                let phone = document.getElementById('phone').value; 
                let password1 = document.getElementById('password1').value;
                let password2 = document.getElementById('password2').value;
                let department = document.getElementById('department').value;
                let level = document.getElementById('level').value;
                let submit = document.getElementById('submit').value;

                $("#msg").load('register-val.php', {
                    first_name: first_name,
                    last_name: last_name,
                    birthday: birthday,
                    gender: gender,
                    email: email,
                    phone: phone,
                    password1: password1,
                    password2: password2,
                    department: department,
                    level: level

                });


                event.preventDefault();
            });
        }); */
    </script>

    
</body>

</html>
<!-- end document-->