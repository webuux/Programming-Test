/* ***********************************************************
Program: System information
Author: Besim Hadzic
Start Program: ./program
*********************************************************** */
#include <cstdlib>
#include <iostream>
#include <cstring>
using namespace std;
int main(int argc, char **argv) {
	// Simple checking if all arguments entered
	if ( argv[0] == NULL ) {
		cout << "Missing argument: ./program";
		return 0;
	}
	// Output system information
	cout << "Linux kernel: ";
	cout.flush();
	system("uname -r");
	cout << "Architecture: ";
	cout.flush();
	system("uname -m");
	cout << "Available Memory: ";
	cout.flush();
	system("free -m |grep Mem| awk '{print($7)}'");
	cout << "Free Memory: ";
	cout.flush();
	system("free -m |grep Mem| awk '{print($4)}'");
	cout << "eth0 IP address: ";
	cout.flush();
	system("hostname -i");
	cout << "sda disk size: ";
	cout.flush();
	system("sudo fdisk -l | grep Disk | grep /dev/sda | awk '{print($3,$4)}'");
	cout << "Current username: ";
	cout.flush();
	system("id -u -n");
	return 0;
}
