<?php
// AUTHOR : BESIM HADŽIĆ
// PAGE: index.php
// DESCRIPTION: PHP FILE FOR INTERFACE USER ADMINISTRATION

//INCLUDING OTHER REQUIRED PHP FILES
require_once 'classUsers.php';

//CREATE AN INSTANCE OF A CLASS USERS
$user = new users();

//GET PAGE NUMBER FOR PAGINATION 
if(isset($_GET["pagePagination"])){
$pagePagination = intval($_GET["pagePagination"]);
} else {
$pagePagination = 1;
}
//GET SEARCH ATTRIBUTE
if(isset($_GET["search"])){
$searchAttribute = $_GET["search"];
} else {
$searchAttribute = '';
}
if(isset($_GET["editID"])){
// GET EDIT USER ID
$editID = $user->escape_string($_GET['editID']);

// CALL EDIT USER DATA FOR EDIT 
$editUserData = $user->getUser($editID);

// SEPARATE EDIT USER DATA 
foreach ($editUserData as $editUser) {
    $editName = $editUser['name'];
    $editUsername = $editUser['username'];
    $editEmail = $editUser['email'];
	$editPassword = $editUser['password'];
}
}

//CALLING USERS FROM DATABASE PER PAGE
if(isset($_GET["search"])){
$allUsers = $user->getSearchUsers($searchAttribute, $pagePagination);
} else {
$allUsers = $user->getUsers($pagePagination);
}
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>User Administration</title>
        <!-- REQUIRED STYLESHEETS START -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
        <!-- REQUIRED STYLESHEETS END -->
    </head>

    <body id="<?php if(isset($_GET["editID"])){ ?>editpage<?php } ?>">
        <!-- ADD USER MODAL START -->
        <div id="addUserModal" class="modal-box">
            <div class="modal-box-overlay"></div>
            <div class="modal-box-container">
                <form action="actionAddUser.php" name="addUserForm" method="post" id="addUserForm" class="add-user-form">
                    <div class="col-12">
                        <h3><i class="fa fa-user-plus" aria-hidden="true"></i>Add New User</h3>
                    </div>
                    <div class="col-12">
                        <input type="text" id="fullname" class="form-input" name="name" placeholder="Full name....">
                    </div>
                    <div class="col-12">
                        <input type="text" id="username" class="form-input" name="username" placeholder="Username....">
                    </div>
                    <div class="col-12">
                        <input type="email" id="email" class="form-input" name="email" placeholder="Email....">
                    </div>
                    <div class="col-12">
                        <input type="text" id="password" class="form-input" name="password" placeholder="Password....">
                    </div>
                    <div class="col-12">
                        <button class="button button-primary" name="Submit" type="submit" id="addUserButton"><i class="fa fa-user-plus" aria-hidden="true"></i>ADD USER</button>
                        <a class="button button-primary" onclick="closeAddForm()"><i class="fa fa-times" aria-hidden="true"></i>CLOSE</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- ADD USER MODAL END -->
        <!-- EDIT USER MODAL START -->
        <?php if(isset($_GET["editID"])){ ?>
            <div id="editUserModal" class="modal-box">
                <div class="modal-box-overlay"></div>
                <div class="modal-box-container">
                    <form id="editUserForm" method="post" action="actionEditUser.php" class="add-user-form">
                        <div class="col-12">
                            <h3><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit User</h3>
                        </div>
                        <div class="col-12">
                            <input type="text" id="editfullname" name="name" class="form-input" value="<?php echo $editName;?>" placeholder="Full name....">
                        </div>
                        <div class="col-12">
                            <input type="text" id="editusername" name="username" class="form-input" value="<?php echo $editUsername;?>" placeholder="Username....">
                        </div>
                        <div class="col-12">
                            <input type="email" id="editemail" name="email" class="form-input" value="<?php echo $editEmail;?>" placeholder="Email....">
                        </div>
                        <div class="col-12">
                            <input type="text" id="editpassword" name="password" class="form-input" value="<?php echo $editPassword;?>" placeholder="Password....">
                        </div>
                        <div class="col-12">
                            <input type="hidden" name="id" value=<?php echo $_GET[ "editID"]?>>
                            <button class="button button-primary" name="update" id="editUserButton"><i class="fa fa-pencil" aria-hidden="true"></i>EDIT USER</button>
                            <a class="button button-primary" href="index.php"><i class="fa fa-times" aria-hidden="true"></i>CLOSE</a>
                        </div>
                    </form>
                </div>
            </div>
            <?php } ?>
                <!-- EDIT USER MODAL END -->
                <!-- HEADER START -->
                <header class="header clearfix">
                    <div class="container">
                        <h1 class="logo">User Administration</h1>
                        <a id="deleteAllUsers" href="actionDeleteAllUsers.php" class="button button-primary last"><i class="fa fa-times" aria-hidden="true"></i>DELETE ALL USERS</a>
                        <a id="addNewUser" onclick="openAddForm()" class="button button-primary"><i class="fa fa-user-plus" aria-hidden="true"></i>ADD NEW USER</a>
                        <form id="searchForm" class="searchform" method="get" action="index.php">
                            <input id="searchInput" name="search" type="text" value="<?php echo $searchAttribute; ?>" class="form-control" placeholder="SEARCH USERS BY NAME....">
                        </form>
                    </div>
                </header>
                <!-- HEADER END -->
                <div class="section clearfix">
                    <div class="container">
                        <!-- SEARCH INFO TEXT START -->
                        <?php if(isset($_GET["search"])){ ?>
                            <h3 class="search-results-text">Search USERS by Name: <strong><?php echo $_GET["search"]; ?></strong></h3>
                            <?php } ?>
                                <!-- SEARCH INFO TEXT END -->
                                <!-- USERS TABLE START -->
                                <ul class="user-list-head">
                                    <li>
                                        Full Name
                                    </li>
                                    <li>
                                        Username
                                    </li>
                                    <li>
                                        E-mail
                                    </li>
                                    <li>
                                        Password
                                    </li>
                                    <li>
                                        Edit User
                                    </li>
                                    <li>
                                        Delete User
                                    </li>
                                </ul>
                                <ul id="showUsers" class="user-lists">
                                    <?php  if(empty($allUsers)) { ?>
                                        <li>
                                            <p>No users added, please add new users.</p>
                                        </li>
                                        <?php  } else { ?>
                                            <?php  foreach ($allUsers as $key => $userKey) { ?>
                                                <li>
                                                    <ul>
                                                        <li>
                                                            <?php echo $userKey['name']; ?>
                                                        </li>
                                                        <li>
                                                            <?php echo $userKey['username']; ?>
                                                        </li>
                                                        <li>
                                                            <?php echo $userKey['email']; ?>
                                                        </li>
                                                        <li>
                                                            <?php echo $userKey['password']; ?>
                                                        </li>
                                                        <li><a class="edit-button" href="index.php?editID=<?php echo $userKey['id']; ?>">Edit</a></li>
                                                        <li><a class="delete-button" href="actionDeleteUser.php?id=<?php echo $userKey['id']; ?>" onClick="return confirm('Are you sure to delete User?');">Delete</a></li>
                                                    </ul>
                                                </li>
                                                <?php  } ?>
                                                    <?php } ?>
                                </ul>
                                <!-- USERS TABLE END -->
                                <!-- PAGINATION START -->
                                <div id="paginationContainer" class="pagination">
                                    <?php if(isset($_GET["search"])){ ?>
                                        <?php  $totalPages = $user->totalsearchpages($searchAttribute); for($i=1; $i <= $totalPages; $i++) {?>
                                            <a href="index.php?pagePagination=<?php echo $i; ?>&search=<?php echo $searchAttribute; ?>">
                                                <?php echo $i; ?>
                                            </a>
                                            <?php } ?>
                                                <?php } else {?>
                                                    <?php  $totalPages = $user->totalpages(); for($i=1; $i <= $totalPages; $i++) {?>
                                                        <a href="index.php?pagePagination=<?php echo $i; ?>">
                                                            <?php echo $i; ?>
                                                        </a>
                                                        <?php } ?>
                                                            <?php } ?>
                                </div>
                                <!-- PAGINATION END -->
                    </div>
                </div>
                <!-- REQUIRED JAVASCRIPT START -->
                <script src="js/scripts.js"></script>
                <!-- REQUIRED JAVASCRIPT END -->
    </body>

    </html>