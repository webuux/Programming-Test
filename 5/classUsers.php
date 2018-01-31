<?php
// AUTHOR : BESIM HADŽIĆ
// PAGE: classUsers.php
// DESCRIPTION: PHP FILE FOR USERS CLASS THAT USE FOR OPERATING WITH USERS

//INCLUDING OTHER REQUIRED PHP FILES
require_once 'classDatabaseAccess.php';
 
// CREATE USERS CLASS EXTENDED WITH DATABASEACCESS CLASS
class users extends databaseAccess {
    public function __construct() {
        parent::__construct();
    }
	
    // FUNCTION TO GET ALL USERS FROM DATABASE PER PAGINATION PAGE 
    public function getUsers($pagePagination){    
        $perpage = 10;
        $calc = $perpage * $pagePagination;
		$start = $calc - $perpage;
		$query = "SELECT * FROM users ORDER BY id ASC LIMIT $start, $perpage";	
        $result = $this->connect_database->query($query);
        if ($result == false) {
            return false;
        } 
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
	
	// FUNCTION TO SEARCH ALL USERS FROM DATABASE PER PAGINATION PAGE 
    public function getSearchUsers($searchAtt, $pagePagination){   
	    $perpage = 10;
        $calc = $perpage * $pagePagination;
		$start = $calc - $perpage;
        $query = "SELECT * FROM users WHERE (`name` LIKE '%".$searchAtt."%') ORDER BY id ASC LIMIT $start, $perpage";	
        $result = $this->connect_database->query($query);
        if ($result == false) {
            return false;
        } 
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
	
	// FUNCTION TO GET PAGINATION PAGE NUMBERS FOR ALL USERS
	public function totalpages(){ 
        $perpage = 10;	 
        $query = "select Count(*) As Total FROM users";	
        $result = $this->connect_database->query($query);
        if ($result == false) {
            return false;
        } 
        $rs = $result->fetch_assoc();
        $total = $rs["Total"];
        $totalPages = ceil($total / $perpage);
        return $totalPages;
    }
	
	// FUNCTION TO GET PAGINATION PAGE NUMBERS FOR SEARCH USERS
	public function totalsearchpages($searchAtt){ 
        $perpage = 10;	 
        $query = "select Count(*) As Total FROM users WHERE (`name` LIKE '%".$searchAtt."%')";	
        $result = $this->connect_database->query($query);
        if ($result == false) {
            return false;
        } 
        $rs = $result->fetch_assoc();
        $total = $rs["Total"];
        $totalPages = ceil($total / $perpage);
        return $totalPages;
    }
	
	// FUNCTION TO GET USER BY ID FROM DATABASE
    public function getUser($idUser){     
        $query = "SELECT * FROM users WHERE id=$idUser";	
        $result = $this->connect_database->query($query);
        
        if ($result == false) {
            return false;
        } 
        
        $rows = array();
        
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    } 
	
	// FUNCTION TO ADD USERS TO DATABASE
	public function addUser($name, $username, $email, $password) {
		$query = "INSERT INTO users(name,username,email,password) VALUES('$name','$username','$email','$password')";
        $result = $this->connect_database->query($query);
        
        if ($result == false) {
            echo 'Error: Cannot add user.';
            return false;
        } else {
            return true;
        }        
    }
	
	// FUNCTION TO UPDATE USERS IN DATABASE
    public function editUser($name, $username, $email, $password, $idUser) {
		$query = "UPDATE users SET name='$name',username='$username',email='$email',password='$password' WHERE id=$idUser";
        $result = $this->connect_database->query($query);
        
        if ($result == false) {
            echo 'Error: Cannot update user.';
            return false;
        } else {
            return true;
        }        
    }
	
	// FUNCTION TO DELETE USERS FROM DATABASE
    public function deleteUser($id) { 
        $query = "DELETE FROM users WHERE id = $id";
        
        $result = $this->connect_database->query($query);
    
        if ($result == false) {
            echo 'Error: Cannot delete user.';
            return false;
        } else {
            return true;
        }
    }
	
	// FUNCTION TO DELETE ALL USERS FROM DATABASE
    public function deleteAllUsers() { 
        $query = "TRUNCATE TABLE users";
        
        $result = $this->connect_database->query($query);
    
        if ($result == false) {
			echo 'Error: Cannot delete all users.';
            return false;
        } else {
            return true;
        }
    }
	
    // FUNCTION TO ESCAPE SPECIAL CHARACTERS
    public function escape_string($value){
        return $this->connect_database->real_escape_string($value);
    }
}
?>
