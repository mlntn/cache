<?php

class FileCache {

	private $lifetime;
	private $prefix;
	private $path;

	public function __construct($prefix = 'cache', $lifetime = 3600, $path = '../../../cache/') {
		$this->lifetime  = $lifetime;
		$this->prefix    = $prefix;
		$this->path      = dirname(__FILE__) . DIRECTORY_SEPARATOR . $path;
	}

	public function set($key, $response) {
		file_put_contents($this->getFilename($key), serialize($response));
	}

	public function get($key) {
		$c = $this->getFilename($key);

		if ($this->has($c)) {
			return unserialize(file_get_contents($c));
		}

		return false;
	}

	private function getFilename($key) {
		return $this->path . $this->prefix . '_' . md5($key);
	}

	public function has($key) {
		$filename = $this->getFilename($key);

		return file_exists($filename) && (time() - filemtime($filename)) < $this->lifetime;
	}

}