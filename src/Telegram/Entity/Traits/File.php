<?php

namespace Selaz\Telegram\Entity\Traits;

trait File {
	
	protected $fileId;
	
	protected $fileSize;
	
	/**
	 * Unique file id
	 * @return string
	 */
	public function getFileId() : string {
		return $this->fileId;
	}

	/**
	 * Unique file id
	 * @param string $fileId
	 */
	public function setFileId(string $fileId) {
		$this->fileId = $fileId;
	}
	
	/**
	 * File size in bytes [ optional ]
	 * @return int
	 */
	public function getFileSize() : int {
		return $this->fileSize;
	}

	/**
	 *  File size in bytes [ optional ]
	 * @param int $fileSize
	 */
	public function setFileSize(int $fileSize) {
		$this->fileSize = $fileSize;
	}
}