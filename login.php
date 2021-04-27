<?php 
    // This is the login page page for the site. 

    require ('includes/config2.inc.php');
   


    if (isset($_POST['submit'])) {

      $e = '';
      $p = '';
      $pass = '';

      $msgs = array();

      require (MYSQL);
      
       //Validate the email address: 
       if (!empty($_POST['email'])) {
           $e = clean($_POST['email']);
       } else {
           //$e = FALSE;
           $msgs[] =  'You forgot to enter your email address!<br/>';
           $css_class = "alert-danger";
       }

       //Validate the password: 
       if (!empty($_POST['pass'])) {
          $p = clean($_POST['pass']);
       } else {
           //$p = FALSE; 
            $msgs[] =  'You forgot to enter your password!<br/>';
             $css_class = "alert-danger";
       }

       if(isset($_POST['pass'])) {
        //Check if password form has been filled
        $p = clean($_POST['pass']); //sanitize user input
        $q = "SELECT password FROM users WHERE (email='$e') AND active IS NULL"; //query to check for password in database
        $r = mysqli_query ($mysqli, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($mysqli));

        while($row = mysqli_fetch_array($r)) { //loop through the returned results from the database 
          $pass = $row['password'];
        }

        if ($p != $pass) {
          $msgs[] = "Invalid password";
          $css_class = "alert-danger";
        }
       }

       if ($e && $p) {
           //If everything's OK.

          //Query the database to check if the user exists and has been registered

            $q = "SELECT * FROM users WHERE (email='$e' AND password=md5(SHA1('$p')) ) AND active IS NULL";

            //get the results of the query
            $r = mysqli_query ($mysqli, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($mysqli));


            if (@mysqli_num_rows($r) == 1) { // A match was made.

            // Register the values & redirect:
            $_SESSION = mysqli_fetch_array ($r,MYSQLI_ASSOC);
            $_SESSION['login'] = $p;
            mysqli_free_result($r);
            mysqli_close($mysqli);
               // A match was made. 

              
              
             
               //Define the url 
               ob_end_clean(); //Delete the buffer

               header("Location: ../Regs/admin/"); 
               exit(); //Quit the script. 
              }
           } else {
               //if No match was made with the database files. 
                $msgs[] = 'Either the email address and password entered do not 
               match those on file or you have not yet activated your
               account.<br>Please make sure your account has been activated.';
               $css_class = "alert-danger";
           }
           
           
       } //END of SUBMIT conditional. 
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
                    <h2 class="title">Login to your Account</h2>

                  
                    <form method="post" action="login.php" id="form">
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
                         
                        

                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Password</label>
                                    <input class="input--style-4" type="password" name="pass">
                                </div>
                            </div>
                        
                        
                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" type="submit" name="submit">Submit</button>
                        </div>
                        <div class="col-12 text-center"> 
                            Not registered? <a href="index.php">Sign up</a> or forgot password? <a href="forgot_password.php">Reset</a>
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