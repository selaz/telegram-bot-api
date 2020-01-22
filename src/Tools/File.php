<?php

namespace Selaz\Tools;

class File {
	
	/**
	 * @var string
	 */
	protected $path;
	
	/**
	 * @var bool
	 */
	protected $tempFile;


	/**
	 * Create object from file. If path to file is empty, create new temporary file
	 * 
	 * @param string $path to file
	 * @param bool $tempFile - remove file in destructor 
	 */
	public function __construct(string $path = null, $tempFile = false) {
		if (empty($path)) {
			$path = $this->newFile();
		}
		
		$this->path = $path;
		$this->tempFile = $tempFile;
	}
	
	public function __destruct() {
		if ($this->tempFile) {
		$this->remove();
		}
	}
	
	/**
	 * Remove file from disc
	 * 
	 * @return boolean
	 * @throws \Exception
	 */
	public function remove() : bool {
		$result = @unlink($this->path);
		if (!$result) {
			throw new \Exception(sprintf("Can`t remove file %s", $this->path));
		}
		
		return true;
	}

	/**
	 * Generete new file in temporary folder
	 * 
	 * @return string
	 */
	protected function newFile() : string {
		$this->path = tempnam(sys_get_temp_dir(), 'PHP-TBA');
		$this->touch();
		$this->chmod('0664');
		return $this->path;
	}
	
	/**
	 * If file written to disk, return true
	 * 
	 * @return bool
	 */
	public function exists() : bool {
		return is_file($this->path);
	}
	
	/**
	 * Touch object file
	 * 
	 * @return bool
	 */
	public function touch() : bool {
		if (!$this->exists() && !$this->dirExists()) {
			$this->mkDir();
		}
		
		return touch($this->path);
	}
	
	/**
	 * Create <File> dir
	 * 
	 * @param string $path optional custom path mkdir
	 * @throws \Exception
	 */
	protected function mkDir(string $path = null) : bool {
		$result = mkdir($path ?? $this->getDir(), "0755", true);
		if (!$result) {
			throw new \Exception(sprintf('Can`t create dir', $path ?? $this->getDir()));
		}
		return $result;
	}
	
	/**
	 * Change file mode
	 * 
	 * @param string $mode
	 * @return bool
	 */
	public function chmod(string $mode) : bool {
		$result = chmod($this->path, $mode);
		if (!$result) {
			throw new \Exception(sprintf('Can`t change file %s mode', $this->path));
		}
		
		return $result;
	}
	
	/**
	 * Return file dir
	 * 
	 * @return string
	 */
	public function getDir() : string {
		return dirname($this->path);
	}
	
	/**
	 * Return true if file dir is exists
	 * 
	 * @param string $path optional custom path for check
	 * @return bool
	 */
	protected function dirExists(string $path = null) : bool {
		return is_dir($path ?? $this->getDir());
	}
	
	
	/**
	 * Return <fopen> resource of file. If file not exists, tyy touch it
	 * 
	 * @param string $fileName
	 * @param string $mode
	 * @return resource
	 * @throws \Exception
	 */
	public function getDecriptor(string $mode = 'r', string $fileName = null) {
		
		if ( empty($fileName) && !$this->exists()) {
			$this->touch();
		}
		
		$resource = fopen($fileName ?? $this->path, $mode);
		
		if (!$resource) {
			throw new \Exception(sprintf("Can`t open file %s", $fileName ?? $this->path));
		}
		
		return $resource;
	}
	
	/**
	 * return path to file 
	 * 
	 * @return string
	 */
	public function __toString() : string {
		return $this->path;
	}
	
	/**
	 * Return filesize 
	 * 
	 * @param bool $human if true, return filesize in human readable format
	 * @return int|string
	 */
	public function getSize(bool $human) {
		$size = filesize($this->path);
		if (!$human) {
			return $size;
		}
		
		$sz = 'BKMGTP';
		$factor = floor((strlen($size) - 1) / 3);
		if ($factor >= strlen($sz)) {
			$factor = 5;
		}
		
		return sprintf(
			"%.2f%sb", 
			$size / pow(1024, $factor), 
			substr($sz, $factor, 1) 
		);
	}
	
	/**
	 * Move file
	 * 
	 * @param string $newPath
	 * @return bool
	 */
	public function move(string $newPath) : bool {
		if (!$this->dirExists(dirname($newPath))) {
			$this->mkDir(dirname($newPath));
		}
		
		if (!rename($this->path, $newPath)) {
			throw new \Exception(sprintf('Can`t move file %s to %s', $this->path, $newPath));
		} else {
			$this->path = $newPath;
			$this->tempFile = false;
			return true;
		}
	}
	
	/**
	 * Create file copy. Return object of new file
	 * 
	 * @param string $path
	 * @return File
	 * @throws \Exception
	 */
	public function copy(string $newPath) : File {
		if (!$this->dirExists(dirname($newPath))) {
			$this->mkDir(dirname($newPath));
		}
		
		if (!copy($this->path, $newPath)) {
			throw new \Exception(sprintf('Can`t copy file %s to %s', $this->path, $newPath));
		} else {
			return new File($newPath);
		}
	}
	
	/**
	 * Put data into file. If file exists, it will overwrited
	 * 
	 * @param string $data
	 * @return bool
	 */
	public function put(string $data) : bool {
		$this->touch();
		
		return boolval(file_put_contents($this->path, $data));
	}
	
	/**
	 * Put data into file. If file exists, append the data to the end of file
	 * 
	 * @param string $data
	 * @return bool
	 */
	public function append(string $data) : bool {
		$this->touch();
		
		return boolval(file_put_contents($this->path, $data, FILE_APPEND));
	}
	
	/**
	 * Return file content as string
	 * 
	 * @return string
	 * @throws \Exception
	 */
	public function get() : string {
		$content = file_get_contents($this->path);
		
		if ($content === false) {
			throw new \Exception(sprintf('Can`t read file %s', $this->path));
		} else {
			return $content;
		}
	}
	
	/**
	 * Return file content as array
	 * 
	 * @param bool $skipEmpty
	 * @return array
	 * @throws \Exception
	 */
	public function toArray(bool $skipEmpty = false) : array {
		$content = file($this->path, $skipEmpty ? FILE_SKIP_EMPTY_LINES : 0);
		
		if (!is_array($content)) {
			throw new \Exception(sprintf('Can`t read file %s', $this->path));
		} else {
			return $content;
		}
	}
}