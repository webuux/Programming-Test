# #4: User administration (PHP)


Admin web page can: 

* Add User
* Edit User
* Delete User
* Use database to store data
* Search users by name
* Pagination 10 records per page.

Only included styles : 

* Fontawesome 
* Google Font

All other custom coded.


In file classDatabaseAccess.php is needed to setup database access data.

```
protected $database_name = 'database';          // ENTER HERE DATABASE NAME
protected $database_user = 'root';          // ENTER HERE DATABASE USERNAME
protected $database_password = '';          // ENTER HERE DATABASE PASSWORD
protected $database_host = 'localhost';     // ENTER HERE DATABASE HOST
```

Also have included database.sql for import data for example or can create: 

```
CREATE TABLE users (
id int(11) NOT NULL auto_increment,
name varchar(100) NOT NULL,
username varchar(100) NOT NULL,
email varchar(100) NOT NULL,
password varchar(50) NOT NULL,
PRIMARY KEY (id)
);
```


 


