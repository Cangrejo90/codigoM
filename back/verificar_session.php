<?php 
ob_start();
session_start();

if (isset($_SESSION["session_info"]) && $_SESSION["session_info"]["login"]) { 
    if ($_SESSION["session_info"]["data"]["time"] >= time()) {
        //7 pensar mejor como controla la session
        if(isset($_SESSION["session_info"]["data"]["key"])) {
            $urlRedirect = $_SERVER["HTTP_REFERER"];
            header('Location: '.$urlRedirect);
            exit();
        }
    }
    else {
        $_SESSION["session_info"]["login"] = false;
        header('Location: login.php');
        exit();
    }
}
else {
    if (basename($_SERVER["REQUEST_URI"]) !== "login.php") {
        header('Location: login.php');
    }
}

ob_end_flush();
?>