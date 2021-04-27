<?php //This is the main page for the site. 

    //Include the configuration file: 
 //
 

    require ('includes/config2.inc.php');


    if (isset($_POST['submit'])) {
    //Handle the form. 

    require (MYSQL);

    //create an empty error array
    $msg = [];


    //Trim all the incoming data;
    $trimmed = array_map('trim', $_POST);

    //Assume invalid values: 
    $fn = $ln = $e = $p =  =  FALSE;

    // Check for a first name: 
    if (isset($_POST['name'])) {
         $fn =  clean(['name']);
         } else {
            $msg = "Please enter your first name!";
                    $css_class = "alert-danger";
     }



// Check for an email address: 
    if (isset($_POST['email'])) {
        $e = clean($_POST['email']);
    } else {
        $msg = "Please enter a valid email Address!";
                $css_class = "alert-danger";
    }




// Check for a password and match against the confirmed passwodrd:
    if (isset($_POST['password1']) && strlen($_POST['password1'] > 4) ) {
        if ($_POST['password1'] == $_POST['password2']) { //If the two passwords match
            $p = clean($_POST['password2']);
        } else {
            $msg = "Your password did not match the confirmed password!";
            $css_class = "alert-danger";
        }
    } else {
        $msg ='<p class="error">Please enter a valid password, it must be greater than 4 and not more than 20 characters! </p>';
            $css_class = "alert-danger";
    }


    if ($fn && $ln && $e &&$p &&$b &&$ph &&$g &&$lv &&$dp ) {
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
                          <?php if(!empty($msg)): ?>
                        <div class ="alert <?php echo $css_class; ?>">
                             <p class="text-center" id="msg"> </p>
                            <?php echo $msg; ?>

                        </div>
                    <?php endif; ?>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">first name</label>
                                    <input class="input--style-4" type="text" name="first_name" 
                                    value="<?php if (isset($trimmed['first_name'])) echo $trimmed['first_name'];?>">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">last name</label>
                                    <input class="input--style-4" type="text" name="last_name" 
                                    value="<?php if (isset($trimmed['last_name'])) echo $trimmed['last_name'];?>">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Birthday</label>
                                    <div class="input-group-icon">
                                        <input class="input--style-4 js-datepicker" type="text" name="birthday">
                                        <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Gender</label>
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">Male
                                            <input type="radio" name="gender" 
                                              value="m">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">Female
                                            <input type="radio" name="gender" 
                                             value="f">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Email</label>
                                    <input class="input--style-4" type="email" name="email"
                                       value="<?php if (isset($_POST['email'])) echo $_POST['email'];?>">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Phone Number</label>
                                    <input class="input--style-4" type="text" name="phone"
                                    value="<?php if (isset($_POST['phone'])) echo $_POST['phone'];?>">
                                </div>
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
                        
                        <div class="input-group">
                            <label class="label">Department</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="department"
                                 value="<?php if (isset($_POST['department'])) echo $_POST['department'];?>">
                                    <option disabled="disabled" selected="selected">Choose option</option>
                                    <option>Medicine</option>
                                    <option>Pharmacy</option>
                                    <option>Anatomy</option>
                                    <option>Physiololgy</option>
                                    <option>Biochemistry</option>
                                    <option>Nursing Science</option>
                                    <option>Radiology</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="label">Level</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="level"
                                 value="<?php if (isset($_POST['level'])) echo $_POST['level'];?>">
                                    <option disabled="disabled" selected="selected">Choose option</option>
                                    <option>100Level</option>
                                    <option>200Level</option>
                                    <option>300Level</option>
                                    <option>400Level</option>
                                    <option>500Level</option>
                                    <option>600Level</option>
                                </select>
                                <div class="select-dropdown"></div>                     
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