
<?php session_start(); ?>

<?php 

$_SESSION['username'] = null;
$_SESSION['Id'] = null;

header ('Location: ./login.php')
    ?>