<?php
// Inialize session
session_start();

// Delete certain session
//unset($_SESSION['username']);
// Delete all session variables
session_destroy();
header('Location:../index.php?logout=success');

?>
