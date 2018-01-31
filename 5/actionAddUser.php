<?php
// AUTHOR : BESIM HADŽIĆ
// PAGE: actionAddUser.php
// DESCRIPTION: PHP FILE FOR ACTION TO ADD USER

//INCLUDING OTHER REQUIRED PHP FILES
require_once 'classUsers.php';

//CREATE AN INSTANCE OF A CLASS USERS
$user = new users();

if(isset($_POST['Submit'])) {    
    $name = $user->escape_string($_POST['name']);
    $username = $user->escape_string($_POST['username']);
    $email = $user->escape_string($_POST['email']);
	$password = $user->escape_string($_POST['password']);
    $result = $user->addUser($name, $username, $email, $password);
	unset($_POST['Submit']);
	header("Location: index.php");
}
?>   


