<?php
// AUTHOR : BESIM HADŽIĆ
// PAGE: actionDeleteUser.php
// DESCRIPTION: PHP FILE FOR ACTION TO DELETE USER

//INCLUDING OTHER REQUIRED PHP FILES
require_once 'classUsers.php';

//CREATE AN INSTANCE OF A CLASS USERS
$user = new users();

$idUser = $user->escape_string($_GET['id']);
$result = $user->deleteUser($idUser);

if ($result) {
    header("Location:index.php");
}
?>
