<?php
//Once user logs out of the website, redirected to signin.php page (sign in page).
session_start();
session_unset();
session_destroy();
session_write_close();
header('Location: https://web.ics.purdue.edu/~g1109686/homepage/signin.php');
die;
exit;
?>
