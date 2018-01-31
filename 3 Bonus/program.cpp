/* ***********************************************************
Program: IP address lookup with SQLite3
Author: Besim Hadzic
Start Program: ./program --database ./database.db 10.1.2.3
*********************************************************** */
#include <iostream>
#include <fstream>
#include <sstream>
#include <vector>
#include <cstdio>
#include <cstring>
#include <cstdlib>
#include <sqlite3.h>
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
// Function to add data to table
static int callback(void *table, int argc, char **argv, char **azColName) {
	int g;
	vector< vector<string> > &data = *(vector<vector<string> >*)table;
	vector<string> rows;
	for (g = 0; g<argc; g++) {
		rows.push_back(argv[g]);
	}
	data.push_back(rows);
	return 0;
}
int main(int argc, char **argv) {
	// Variables
	string IP;
	string databasefile;
	vector< vector<string> > table;
	sqlite3 *database;
	char *zErrMsg = 0;
	int openDB;
	const char *sql;
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
		cout << "Missing argument: Database File ./database.db";
		return 0;
	}
	if ( argv[3] == NULL ) {
		cout << "Missing argument: IP Address 10.1.2.3";
		return 0;
	}
	// assigns File argument
	databasefile = argv[2];
	// assigns IP argument
	IP = argv[3];
	// Open database
	openDB = sqlite3_open(databasefile.c_str(), &database);
	// Check if have opened database
	if( openDB ) {
		cerr << "Can't open database: " << sqlite3_errmsg(database);
		return 0;
	}
	// Database SQL statement
	sql = "SELECT * from ipaddress";
	// Execute SQL database statement
	openDB = sqlite3_exec(database, sql, callback, &table, &zErrMsg);
	// Check if SQL database statement can been execute if not give errors
	if( openDB != SQLITE_OK ) {
		cerr << "SQL error: " << zErrMsg;
		sqlite3_free(zErrMsg);
	}
	for (int j = 0 ; j < table.size(); j++) {
		vector<string> row(table[j]);
		if(isIPinRange(IP, row[1], row[2]))
					cout << "ID." << row[0] << ": " << row[1] << "/" << row[2]<< endl;
	}
	// Close database
	sqlite3_close(database);
	return 0;
}
