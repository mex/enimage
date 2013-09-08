<?php

abstract class AbstractBase {

	private $instances = 10;
	private $null = '0000';

	private $mapFile = './map.json';
	private $map = array();
	private $characterMap = array();
	private $encodeMap = array();

	public function __construct() {
		$handle = file_get_contents($this->getMapFile());
		$this->map = json_decode($handle, true);
	}

	protected function getInstances() {
		return $this->instances;
	}

	protected function getNull() {
		return $this->null;
	}

	protected function getMapFile() {
		return $this->mapFile;
	}

	protected function getMap() {
		return $this->map;
	}
	protected function addToMap($character) {
		$this->map[] = $character;
	}

	protected function getChar($encode) {
		$map = $this->getEncodeMap();
		return $map[$encode];
	}
	protected function getEncode($char) {
		$map = $this->getCharacterMap();
		$i = rand(0, $this->getInstances()-1);
		return $map[$char][$i];
	}

	protected function save() {
		file_put_contents($this->getMapFile(), json_encode($this->getMap()));
	}

	protected function getCharacterMap($reload = false) {
		if (!count($this->characterMap) || $reload) {
			foreach ($this->map as $characters) {
				if (!$this->characterMap[$characters['a']]) {
					$this->characterMap[$characters['a']] = array();
				}
				$this->characterMap[$characters['a']][] = $characters['b'];
			}
		}
		return $this->characterMap;
	}
	protected function getEncodeMap($reload = false) {
		if (!count($this->encodeMap) || $reload) {
			foreach ($this->map as $characters) {
				$this->encodeMap[$characters['b']] = $characters['a'];
			}
		}
		return $this->encodeMap;
	}

}
