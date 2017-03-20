#include "screen.h"
#include <stdio.h>

void setFGcolor(int fg)
{
	printf("\033[%d;1m",fg);
	fflush(stdout);
}

void resetColor(void)
{
	printf("\033[0m");
	fflush(stdout);
}

void gotoXY(int row, int col)
{
	printf("\033[%d;%dH",row,col);
	fflush(stdout);
}

void clearScreen(void)
{
	printf("\033[2J");
	fflush(stdout);
}

void displayBar(double rms, int col)
{
	int i;
	rms = (rms)*3/sizeof(short int);
	if (70-rms/100<0) {setFGcolor(RED);}
	for (i=70;i>70-rms/100;i--)
	{
		if (i<2) break;
		gotoXY(i+2,col);
#ifndef UNICODE
		printf("%c",);
#else
		printf("%s",BAR);
#endif
	}
	fflush(stdout);
}
