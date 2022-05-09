<?php
session_start();

//remove all session variables
session_unset();

//destroy the session
session_destroy();

setcookie("cart", "", time() - 3600);

header('Location: http://localhost/web_fix2/index.php');