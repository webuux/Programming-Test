# Programming Test

Programming test for bicom


## #1: N-last lines

Make a program that reads last N lines from file F.

Program must be written in either C or C++.

Program may be executed like this:

```
./program -n 10 file.txt
```

Above should display up to 10 last lines from file.txt.

Arguments that must be implemented are:

* -n Read N lines from file F
* -f Wait for new lines in file as they are written and output them on terminal


## #2: System information

Make a program that shows some basic information about a Linux system.

Program must be written in either C or C++.

Program may be executed like this:

```
./program
```

Program output may show the following:

```
Linux kernel: 4.4.30
Architecture: 64-bit
Available Memory: 1000M
Free Memory: 10MB
eth0 IP address: 10.1.2.3
sda disk size: 250GB
Current username: root
```

All this information is to be collected via available system calls or via files exposed via Linux kernel. You
must not execute external programs to get such information.


## #3: IP address lookup

Program must be written in either C or C++.
Program may be executed like this:

```
./program --database ./database.txt 10.1.2.3
```

database.txt will be a text file that contains IP address ranges in form of:

```
10.1.0.0/16
127.0.0.0/8
192.168.8.0/24
...
```

The task of the program is to find and print out all ranges for the IP address supplied as an argument.
Expected output for the above may be:

```
10.1.0.0/16
```

Make a second version of the program that does the same, but this time, instead of plain-text file have it
read SQLite database as a file.
You have all freedom to design SQLite database.


## #4: User administration (JavaScript)

Make a test admin web page that has the following:

* Add User
* Edit User
* Delete User
* Search User

Each user should have at least these properties:

* Full name
* Username
* E-mail
* Password

Other properties may be implemented.
List should have pagination at certain record limit (e.g. 10 records per page).

Bonus points:

* Local storage of data
* Looks good (and font icons)
* Duplicates not allowed
* Search works well
* Performance
* Additional clever bits

Make it so that it works as a single JavaScript-based web page and make sure it looks good (it may be split
into multiple resources, stylesheets etc. but it is not to be written in some server-side language).
This has to be done without any complex JavaScript frameworks and it should work on modern browsers.


## #5: User administration (PHP)

Same as task #4, but implemented in PHP. You have a freedom to implement it as you wish.