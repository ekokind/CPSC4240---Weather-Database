import sys

print sys.argv
if(len(sys.argv) != 2 or len(sys.argv[1]) != 36):
	print "run as ./sendData <UUID4> where UUID4 is a 36 character UUID"
else:
	print len(sys.argv[1])
