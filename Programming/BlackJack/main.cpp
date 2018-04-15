/** 
 *	@author		Francis Hackenberger, Alex Prowell, Evan Ly
 *	@version	   2015.01
 *	@since		Dec 2015
 *	@see		   CPRG4202.BlackJackProject.pdf
*/

#include <iostream>		
#include <iomanip> 		
#include <stdexcept>
#include <sstream>
#include <stdio.h>
#include "StandardPlayingCard_Enum.h"
#include "StandardDeck.h"
#include "BlackJack.h"


int main()
{ 
	char choice;
	bool needInput = true;
	do
	{
		cout << "\nMENU " << endl
			 << "=====" << endl << endl
			 << "\'1\' Start Game" << endl
			 << "\'3\' Other option" << endl
			 << "\'4\' Other Other option" << endl
			 << "\'Q\' Quit" << endl << endl
			 << ": ";
			 
		fflush(stdin);
		choice = cin.get();
		choice = toupper(choice);
		
		switch(choice)
		{
			case '2':
				cout << "Starting Game..." << endl;
				break;
			case '3':
				cout << "Option 1 " << endl;
				break;
		   case '4':
		      cout << "Option 2" << endl;
		      break;
			case 'Q':
				needInput = false;
				break;
			default:
				cout << "\nUnrecognized choice. Please try again.";
		}
	}while (needInput);
  
	cout << endl << endl;
   return 0;
}
