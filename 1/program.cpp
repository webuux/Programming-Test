/* ***********************************************************
Program: N-last lines
Author: Besim Hadzic
Start Program: ./program -n 10 file.txt
*********************************************************** */
#include <cstdlib>
#include <iostream>
#include <cstdio>
#include <cstring>
#include <fstream>
using namespace std;
int main (int argc, char **argv) {
	int numberLines, totalLines, calLines, it;
	totalLines = 0;
	numberLines = 0;
	calLines = 0;
	it = 0;
	string l;
	string filename;
	ifstream file;
	// Simple checking if all arguments entered
	if ( argv[0] == NULL ) {
		cout << "Missing argument: ./program";
		return 0;
	}
	if ( argv[1] == NULL ) {
		cout << "Missing argument: -n or -f";
		return 0;
	}
	if ( argv[2] == NULL ) {
		cout << "Missing argument: number of last lines that need to display";
		return 0;
	}
	if ( argv[3] == NULL ) {
		cout << "Missing argument: file is missing example: file.txt";
		return 0;
	}
	if (argv[1][0] == '-') {
		if (argv[1][1] == 'n') {
			// assigns argument number of last line that will output
			numberLines = atoi(argv[2]);
		} else if (argv[1][1] == 'f') {
			system("watch cat file.txt");
		}
	}
	// assigns File argument
	filename = argv[3];
	// Open file
	file.open(filename.c_str());
	// Check if file is open
	if(file.is_open()) {
		// Calculate total lines of file
		while ( getline (file,l)) {
			totalLines ++;
		}
		if(totalLines > numberLines) {
			calLines = totalLines - numberLines;
		} else {
			calLines = numberLines;
		}
		file.clear();
		file.seekg(0, ios::beg);
		// Outputing last n lines
		while ( getline (file,l)) {
			it++;
			if (totalLines > numberLines) {
				if (it > calLines) {
					cout << l << endl;
				}
			} else {
				cout << l << endl;
			}
		}
	} else {
		cout << "Unable to open file";
		return 0;
	}
	// Close file
	file.close();
	return 0;
}
