enimage
=======
Hide messages in a image file.

###Examples
```
require_once('./Enimage.php');

$enimage = new Enimage();

$example = 'Hello world! This is a lot of pixels, so please be careful...';
$enimage->encode($example, './image.png');

$string = $enimage->decode('./image.png');

echo '"' . $string . '" should be the same as "' . $example . '"';
```

###Notes
Create an image containing pixels in different hex colors.  
Each character is 4 characters. No character is 0000 (will be inserted randomly to create a square image).  
This gives 65535 possibilities and each character should have at least 500 different codes.  
Has to be created in a png image to keep exact color codes.
