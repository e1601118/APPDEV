OBJ = main.o wave.o screen.o #comm.o (added later)
APPNAME = sound.a

$(APPNAME) : $(OBJ)
	gcc -o $(APPNAME) $(OBJ) -lm

%.o : %.c 
	gcc -c -o $@ $< 

clean : 
	rm $(OBJ) $(APPNAME)

archive :
	tar cf sound.tar *.c *.h makefile
