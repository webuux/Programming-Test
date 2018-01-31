/* ***********************************************************
Program: IP address lookup
Author: Besim Hadzic
Start Program: ./program --database ./database.txt 10.1.2.3
*********************************************************** */
#include <iostream>
#include <fstream>
#include <sstream>
#include <cstdio>
#include <cstring>
#include <cstdlib>
using namespace std;
//Function to convert IP Address
unsigned long IPConvert(string ip) {
	int b1, b2, b3, b4;
	unsigned long address = 0;
	if (sscanf(ip.c_str(), "%d.%d.%d.%d", &b1, &b2, &b3, &b4) != 4)
			return 0;
	address = b1 << 24;
	address |= b2 << 16;
	address |= b3 << 8;
	address |= b4;
	return address;
}
//Function to convert Mask
string MaskConvert(string netmask) {
	int mem = atoi(netmask.c_str());
	unsigned long l = 0xFFFFFFFF << (32 - mem);
	ostringstream m;
	m << (l >> 24) << '.' << (l >> 16 & 0xFF) << '.' << (l >> 8 & 0xFF) << '.' << (l & 0xFF);
	return m.str();
}
//Function that check if IP Address in range
bool isIPinRange(const string ip, const string dbip, const string dbmask) {
	string maskC = MaskConvert(dbmask);
	unsigned long ip_address = IPConvert(ip);
	unsigned long db_address = IPConvert(dbip);
	unsigned long db_mask_address = IPConvert(maskC);
	unsigned long ip_lower = (db_address & db_mask_address);
	unsigned long ip_upper = (ip_lower | (~db_mask_address));
	if (ip_address >= ip_lower && ip_address <= ip_upper)
	    return true;
	return false;
}
int main(int argc, char **argv) {
	// Variables
	string IP;
	string databaseIP;
	string databaseMask;
	string databasefile;
	string l;
	ifstream file;
	// Simple checking if all arguments entered
	if ( argv[0] == NULL ) {
		cout << "Missing argument: ./program";
		return 0;
	}
	if ( argv[1] == NULL ) {
		cout << "Missing argument: --database";
		return 0;
	}
	if ( argv[2] == NULL ) {
		cout << "Missing argument: TXT File ./database.txt";
		return 0;
	}
	if ( argv[3] == NULL ) {
		cout << "Missing argument: IP Address 10.1.2.3";
		return 0;
	}
	// assigns IP argument
	IP = argv[3];
	// assigns File argument
	databasefile = argv[2];
	// Open File
	file.open( databasefile.c_str() );
	if (file.is_open()) {
		// Getlines from file
		while (getline(file,l)) {
			string databaseIP = l.substr(0,l.find("/"));
			string databaseMask = l.substr(l.find("/")+1,l.size());
			if (isIPinRange(IP, databaseIP , databaseMask))
						cout << l << endl;
		}
	} else
	cout << "Cannot open file." << endl;
	file.close();
	return 0;
}
