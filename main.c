/* This program is just for testing */
#include "wave.h"
#include <stdio.h>
#include <math.h>
#include <time.h>
#include <stdlib.h>
#include <signal.h>
#include "screen.h"

//this program will open a wave file, a display WAV header info
//this program will create a wave file

int main(int argc, char *argv[])
{
	FILE *fp;
	WAVHDR myhdr;
	int ret;
	short int sa[SAMPLE_RATE];
/*	if (argc!=2) 
	{
		printf("Usage: %s wav_file\n",argv[0]);
		return -1;
	}
	fp = fopen(argv[1],"r"); //try to open wav file
	if (fp==NULL)
	{
		printf("Cannot find file %s\n",argv[1]);
		return -1;
	}
*/
	for (;;)
	{
		ret = system("arecord -r16000 -c1 -d1 -f S16_LE -q data.wav");
		clearScreen(); //a fresh screen to display
		if (WIFSIGNALED(ret) && (WTERMSIG(ret)==SIGINT || WTERMSIG(ret)==SIGQUIT)) break;
		fp = fopen("data.wav","r");
		fread(&myhdr,sizeof(myhdr),1,fp);
		displayWAVHDR(myhdr);
		fread(&sa, sizeof(short int),SAMPLE_RATE,fp);
		displayWAVdata(sa);
		fclose(fp);
	}
/*	int ans;
	printf("Do you want to generate a test tone? (1:yes, 0: no)");
	scanf("%d",&ans);
	testTone(440,3);
*/
	return 0;
}

