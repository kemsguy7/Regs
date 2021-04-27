<?php 
//This script is responsible for showing success or failure alerts
//if the session has been started already, ignore
    if (session_status() == PHP_SESSION_NONE){ 
            session_start();
        }

function ErrorMessage() {
    if(isset($_SESSION["ErrorMessage"])) {
        $Output = "<div class=\"alert alert-danger\">";
        $Output.=htmlentities($_SESSION["ErrorMessage"]);
        $Output.="</div>";
        $_SESSION["ErrorMessage"] = null; //This line clears the session and makes it null after the first attempt
        return $Output;
    }
}
function SuccessMessage() {
    if(isset($_SESSION["SuccessMessage"])) {
        $Output = "<div class=\"alert alert-success\">";
        $Output.=htmlentities($_SESSION["SuccessMessage"]);
        $Output.="</div>";
        $_SESSION["SuccessMessage"] = null; //This line clears the session and makes it null after the first attempt
        return $Output;
    }
}

?>