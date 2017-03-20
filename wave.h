/* This header file contains wave header information as a struct
 * It also contains necessary constant definitions, and function
 * prototypes used in this project */

typedef struct
{
	char ChunkID[4];
	int  ChunkSize;
	char Format[4];
	char Subchunk1ID[4];
	int  Subchunk1Size;
	short int AudioFormat;
	short int NumChannels;
	int SampleRate;
	int ByteRate;
	short int BlockAlign;
	short int BitsPerSample;
	char Subchunk2ID[4];
	int Subchunk2Size;
}WAVHDR;

//#define DEBUG
#define SAMPLE_RATE 16000
#define PI 3.1415926

//function prototypes
void displayWAVHDR(WAVHDR);
void printID(char *);
void testTone(int freq, double duration);
void fillID(const char *,char[]);
void displayWAVdata(short int []);
