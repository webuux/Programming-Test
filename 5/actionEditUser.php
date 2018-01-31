<?php
// AUTHOR : BESIM HADŽIĆ
// PAGE: actionEditUser.php
// DESCRIPTION: PHP FILE FOR ACTION TO UPDATE USER

//INCLUDING OTHER REQUIRED PHP FILES
require_once 'classUsers.php';

//CREATE AN INSTANCE OF A CLASS USERS
$user = new users();

if(isset($_POST['update'])) {    
    $idUser = $user->escape_string($_POST['id']);
    $name = $user->escape_string($_POST['name']);
    $username = $user->escape_string($_POST['username']);
    $email = $user->escape_string($_POST['email']);
    $password = $user->escape_string($_POST['password']);
    $result = $user->editUser($name, $username, $email, $password, $idUser);
    header("Location: index.php");
}
?>



