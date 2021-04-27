<?php  
    

    // Set the age title and inclde the HTML header:
    $page_title = 'Welcome to this site!';
    include ('includes/header.php');

    //Welcpme the user (by name if they are logged in): 
    echo '<h1>Welcome </h1>';
    if (isset($_SESSION['first_name'])) {
        echo ", {$_SESSION['first_name']}!";
    }
    echo '</h1>';
?>
<p>Spam spam spam spam spam spam
 spam spam spam spam spam spam
 spam spam spam spam spam spam
 spam spam spam spam spam spam.</p>
 <p>Spam spam spam spam spam spam
 spam spam spam spam spam spam
 spam spam spam spam spam spam
 spam spam spam spam spam spam.</p>
 <p><a href="logout.php">Logout</a> </p>

 <?php //Include the html footer file:
 include ('includes/footer.php');
 ?>