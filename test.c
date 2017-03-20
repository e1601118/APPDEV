/* This program is just for testing */
#include "wave.h"
#include <stdio.h>
#include <math.h>
#include <time.h>
#include <stdlib.h>

//this program will open a wave file, a display WAV header info
//this program will create a wave file

int main(int argc, char *argv[])
{
	FILE *fp;
	WAVHDR myhdr;
	if (argc!=2)
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
	fread(&myhdr,sizeof(myhdr),1,fp);
	//displayWAVHDR(myhdr);
	fclose(fp);
	int ans;
	//printf("Do you want to generate a test tone? (1:yes, 0: no)");
	//scanf("%d",&ans);
	testTone(440,3);
	return 0;
}

void testTone(int freq, double d)
{
	FILE *fp;
	int i;
	WAVHDR h;
	fp = fopen ("testtone2.wav","w");
	fillID("RIFF",h.ChunkID); // Chunk1size will be calculated later
	fillID("WAVE",h.Format);
	fillID("fmt ",h.Subchunk1ID);
	fillID("data", h.Subchunk2ID);
	h.Subchunk1Size = 16;
	h.AudioFormat = 1;
	h.NumChannels = 2;
	h.SampleRate = SAMPLE_RATE;
	h.BitsPerSample = 16;
	h.ByteRate = h.SampleRate * h.NumChannels * (h.BitsPerSample/8);
	h.BlockAlign = h.NumChannels * (h.BitsPerSample/8);
	h.Subchunk2Size = (int) d*h.ByteRate;
	h.ChunkSize = h.Subchunk2Size + 36;
	fwrite(&h,sizeof(h),1,fp);
	int sample;
	for (i=0;i<=d*SAMPLE_RATE;i++)
	{
		srand(time(NULL));
		sample = (i-32768-i*i/1000)*rand() * sin(2*PI*freq*i/SAMPLE_RATE);
		fwrite(&sample, sizeof(sample),1,fp);
		sample =32768*2 * sin(2*PI*freq*i/SAMPLE_RATE);
		fwrite(&sample, sizeof(sample),1,fp);
	}
	fclose(fp);
}

void fillID(const char *s, char d[])
{
	int i;
	for (i=0;i<4;i++) d[i]=*s++;
}

void displayWAVHDR(WAVHDR hdr)
{
	double Duration;
	printf("Chunk ID: "); printID(hdr.ChunkID);
	printf("ChunkSize: %d\n",hdr.ChunkSize);
	printf("Chunk ID format: "); printID(hdr.Format);
	printf("Sub chunk 1 ID: "); printID(hdr.Subchunk1ID);
	printf("Sub chunk 1 size: %d\n",hdr.Subchunk1Size);
	printf("Audio Format: %d\n",hdr.AudioFormat);
	printf("Number of channels: %d\n",hdr.NumChannels);
	printf("Sample rate: %d\n",hdr.SampleRate);
	printf("Byte rate: %d\n",hdr.ByteRate);
	printf("Block Align: %d\n",hdr.BlockAlign);
	printf("Bit Per Sample: %d\n",hdr.BitsPerSample);
	printf("Sub chunk 2 ID: ");printID(hdr.Subchunk2ID);
	printf("Subchunk2Size: %d\n",hdr.Subchunk2Size);
	Duration = (double)hdr.Subchunk2Size/hdr.ByteRate;
	printf("Duration of Audio %.3f sec\n",Duration);
}

void printID(char id[])
{
	int i;
	for (i=0;i<4;i++) putchar(id[i]);
	printf("\n"); 
}
