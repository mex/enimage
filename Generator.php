<?php
require_once('./AbstractBase.php');

class Generator extends AbstractBase {

	private $characters = array(
		'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
		'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
		'0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
		' ', ',', '.', '/', '<', '>', '?', '`', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '_', '=', '+', '[', ']', '{', '}', '\\', '|', ';', ':', '\'', '"',
		"\n", "\t"
	);
	private $encodes = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');

	public function run() {
		foreach ($this->characters as $character) {
			if (array_key_exists($character, $this->getCharacterMap(true))) {
				continue;
			}
			for ($i = 1; $i <= $this->getInstances(); $i++) {
				$this->addToMap(array(
					'a' => $character,
					'b' => $this->generateEncode()
				));
			}
		}
		$this->save();
	}

	private function generateEncode() {
		$encode = $this->getRandomEncode() . $this->getRandomEncode() . $this->getRandomEncode() . $this->getRandomEncode();
		if (array_key_exists($encode, $this->getEncodeMap())) {
			return $this->generateEncode();
		}
		if ($encode === '0000') {
			return $this->generateEncode();
		}
		return $encode;
	}

	private function getRandomEncode() {
		$i = rand(0, 15);
		return $this->encodes[$i];
	}

}

$generator = new Generator();
$generator->run();
