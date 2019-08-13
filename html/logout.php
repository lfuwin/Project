<?php
session_start();
session_unset();
session_destroy();
echo "successfully logout,jump back to login page in 3 second";
header('Refresh: 3; url=login.php');
?>
