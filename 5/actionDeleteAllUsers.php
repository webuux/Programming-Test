<?php
// AUTHOR : BESIM HADŽIĆ
// PAGE: actionDeleteAllUsers.php
// DESCRIPTION: PHP FILE FOR ACTION TO DELETE ALL USERS

//INCLUDING OTHER REQUIRED PHP FILES
require_once 'classUsers.php';

//CREATE AN INSTANCE OF A CLASS USERS
$user = new users();

$result = $user->deleteAllUsers();

if ($result) {
    header("Location:index.php");
}
?>