# README
# Written by The Anh
# This project is written for Linux OS

OVERVIEW:
	Raspberry Pi acoustic sensor project

	This project will turn a raspberry Pi 3 into an acoustic sensor

1. Configuration:

	1.1 Hardware configuration:

		A raspberry Pi 3 is recommended. If an older version of Pi is used, corresponding configuration might be changed

		The Pi is mounted with a USB sound card, and plug-in microphone

		It is recommonded to have Ethernet connection for your Pi.

	1.2 Software configuration:

		The USB sound card has to be set as default audio device.
		To do so, you need to modify two files with following contents:

		a) Use “lsusb” command to check if your USB sound card is mounted
		b) Use "sudo nano /etc/asound.conf" command and put the following content:

			pcm.!default {
			  type plug
			  slave {
			    pcm "hw:1,0"	
			  }
			}
			ctl.!default {
			    type hw
			    card 1
			}

		c) Go to your home directory. Use “nano .asoundrc” command and put the same content to the file.
		d) Run “alsamixer” you should be able to see that USB sound card is the default audio device

		If you are using Raspbian Jessie, you have to roll back alsa-utils to an earlier version:

		a) Use “sudo nano /etc/apt/sources.list” command and add the last line:

			deb http://mirrordirector.raspbian.org/raspbian/ jessie main contrib non-free rpi
			# Uncomment line below then 'apt-get update' to enable 'apt-get source'
			#deb-src http://archive.raspbian.org/raspbian/ jessie main contrib non-free rpi
			deb http://mirrordirector.raspbian.org/raspbian/ wheezy main contrib non-free rpi

			b) Run “sudo apt-get update”
			c) Run “sudo aptitude versions alsa-utils” to check if version 1.0.25 of alsa-util is available:
			d) Run “sudo apt-get install alsa-utils=1.0.25-4” to downgrade
			e) Reboot


2. Installation instruction:

	a) Download all the source from my GitHub: https://github.com/e1601118/APPDEV and store in ONE directory
	b) Open Terminal Windows on Linux and change directory to your folder containing all the source code
	c) Type "make" to compile and link all the source code
	d) Change your terminal to UTF-8

3. Opertating instruction:

	a) Run "./sound.a" to run the program. You will see a screen with many vertical bars and information of 
		duration, bits per sample, and sample rate

	b) View in DEBUG mode, where you can see the file WAV header: go to "wave.h" and add line "#define DEBUG"
	c) View in COMM  mode, where your program will send the record information to the server: go to "comm.h" and add line "#define COMM"
	d) To view the visualization, go to: https://www.cc.puv.fi/~e1601118/php/realtime.php
	e) To stop the program: press Crtl+C or Crtl+Z

4. Files include in this project:
	main.c	wave.c	wave.h	comm.h	comm.c	screen.h  screen.c  makefile README.md

5. Coppyright and licensing information:
	This is a open source project. No coppyright and licensing

6. Contact information for the distributor or programmer:
	Name: 	Nguyen The Anh
	Phone:  +358 469 518 740
	Email:  e1601118@edu.vamk.fi
	
7. Credit and acknowledgement:
	This project is made by following the instruction of Doctor Gao Chao, supervisor of Application Development course, VAMK.
