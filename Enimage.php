<?php
require_once('./AbstractBase.php');

class Enimage extends AbstractBase {

	private $im;

	public function encode($string, $outputFile) {
		$chars = str_split($string);
		$count = count($chars);
		$encodes = array();
		foreach ($chars as $char) {
			$encodes[] = $this->getEncode($char);
		}
		$root = ceil(sqrt($count * 4 / 6));
		for ($i = 1; $i <= floor(pow($root, 2) / 4 * 6) - $count; $i++) {
			$offset = array_rand($encodes);
			array_splice($encodes, $offset, 0, $this->getNull());
		}
		$colors = str_split(implode('', $encodes), 6);
		$this->generateImage($outputFile, $colors, $root);
	}
	private function generateImage($outputFile, $colors, $size) {
		$this->im = imagecreatetruecolor($size, $size);
		$i = 0;
		for ($y = 0; $y < $size; $y++) {
			for ($x = 0; $x < $size; $x++) {
				imagesetpixel($this->im, $x,$y, $this->getColor($colors[$i]));
				$i++;
			}
		}
		imagepng($this->im, $outputFile);
		imagedestroy($this->im);
	}
	private function getColor($hex) {
		return call_user_func_array('imagecolorallocate', array(
			$this->im,
			hexdec(substr($hex, 0, 2)),
			hexdec(substr($hex, 2, 2)),
			hexdec(substr($hex, 4, 2))
		));
	}

	public function decode($image) {
		$this->im = imagecreatefrompng($image);
		list($width, $height) = getimagesize($image);
		$encoded = '';
		for ($y = 0; $y < $height; $y++) {
			for ($x = 0; $x < $width; $x++) {
				$encoded .= $this->getColorAt($x, $y);
			}
		}
		$encodes = str_split($encoded, 4);
		$string = '';
		foreach ($encodes as $encode) {
			$string .= $this->getChar($encode);
		}
		return $string;
	}
	private function getColorAt($x, $y) {
		$rgb = imagecolorat($this->im, $x, $y);
		return
				str_pad(dechex(($rgb >> 16) & 0xFF), 2, "0", STR_PAD_LEFT) .
				str_pad(dechex(($rgb >> 8) & 0xFF), 2, "0", STR_PAD_LEFT) .
				str_pad(dechex($rgb & 0xFF), 2, "0", STR_PAD_LEFT);
	}

}
