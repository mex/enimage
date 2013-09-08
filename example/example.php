<?php
require_once('../Enimage.php');

$enimage = new Enimage();

//Encode
$hamlet = file_get_contents('./hamlet.txt');
$enimage->encode($hamlet, './hamlet.png');

//Decode
$string = $enimage->decode('./hamlet.png');

var_dump($string);