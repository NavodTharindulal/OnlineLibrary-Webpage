<?php
session_start(); 
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 60*60,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
unset($_SESSION['user_id']);
unset($_SESSION['login']);
session_destroy(); // destroy session

if(isset($_GET['log_out_code']))
{
	$code=$_GET['log_out_code'];
}
header("location:index.php?log_out=". $code); 
?>

