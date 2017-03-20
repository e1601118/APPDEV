// includes the function prototypes for screen manipulation

enum COLOR{BLACK=30, RED, GREEN, YELLOW, BLUE, MAGENTA, CYAN, WHITE};

#define UNICODE
#define BAR "\u2590"		//define unicode for a bar

//function prototypes

void setFGcolor(int fg);
void resetColor();
void gotoXY(int row, int col);
void clearScreen();
void displayBar(double rms, int i);

