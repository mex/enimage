enimage
=======
Hide messages in a image file.

###Notes
Create an image containing pixels in different hex colors.  
Each character is 4 characters. No character is 0000 (will be inserted randomly to create a square image).  
This gives 65535 possibilities and each character should have at least 500 different codes.  
Has to be created in a png image to keep exact color codes.

###Deimage
When deimaging the code should create a string of all of the hex colors without the hash symbol.  
The split that string by blocks of 4 and ignore.  
Each of these blocks should then be decoded (while ignoring 0000).


###Enimage
When enimaging the code should create an array of all encoded values.  
Then count the total number of values, multiply by 4, divide by 6 and ceil().  
Then find smallest square that can hold all of the above count.  
The number of pixels in the square should be multiplied by 6 and divided by 4. If the number is a float, add 00 at the end of the values.  
Take the square count, subtract the value count and add that number of 0000 at random places.
