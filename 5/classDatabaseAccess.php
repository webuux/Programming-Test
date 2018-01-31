<?php
// AUTHOR : BESIM HADŽIĆ
// PAGE: classDatabaseAccess.php
// DESCRIPTION: PHP FILE FOR DATABASEACCESS CLASS THAT USE FOR CONNECTING TO DATABASE

class databaseAccess {
	
	protected $database_name = 'database';          // ENTER HERE DATABASE NAME
	protected $database_user = 'root';          // ENTER HERE DATABASE USERNAME
	protected $database_password = '';          // ENTER HERE DATABASE PASSWORD
	protected $database_host = 'localhost';     // ENTER HERE DATABASE HOST
	
	protected $connect_database;
	
	public function __construct() {
        if (!isset($this->connect_database)) {
             $this->connect_database = new mysqli($this->database_host, $this->database_user, $this->database_password, $this->database_name);
             if ( mysqli_connect_error() ) {
			   printf("Connection to database failed because: %s", mysqli_connect_error());
			   exit();
		    }           
        }    
        return $this->connect_database;
    }
}