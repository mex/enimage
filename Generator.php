<?php
require_once('./AbstractBase.php');

class Generator extends AbstractBase {

	private $characters = array(
		'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
		'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'K', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
		'0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
		' ', ',', '.', '/', '<', '>', '?', '`', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '_', '=', '+', '[', ']', '{', '}', '\\', '|', ';', ':', '\'', '"'
	);
	private $encodes = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');

	public function run() {
		$map = $this->getMap();
		foreach ($this->characters as $character) {
			for ($i = 1; $i <= $this->getInstances(); $i++) {
				$characterMap = $this->getCharacterMap(true);
				if (array_key_exists($character, $characterMap) && count($characterMap[$character]) >= $this->getInstances()) {
					continue;
				}
				$map[] = array(
					'a' => $character,
					'b' => $this->generateEncode()
				);
			}
		}
		file_put_contents($this->getMapFile(), json_encode($map));
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
