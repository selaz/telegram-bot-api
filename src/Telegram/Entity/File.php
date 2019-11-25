<?php

namespace Selaz\Telegram\Entity;

class File extends Entity {

	use Traits\File;
	
	protected $filePath;

	/**
	 * Filepath
	 * 
	 * @return string
	 */
	public function getFilePath() : string {
		return $this->filePath;
	}

	/**
	 * Filepath
	 * 
	 * @param string $filePath
	 */
	public function setFilePath(string $filePath) {
		$this->filePath = $filePath;
	}


}