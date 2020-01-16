<?php

namespace Selaz\Telegram\Entity\Traits;

trait File {
	
	protected $fileId;
	protected $fileUniqueId;
	protected $fileSize;
	protected $fileName;
	
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
	
	/**
	 * Unique identifier for this file, which is supposed to be the same over 
	 * time and for different bots. Can't be used to download or reuse the file.
	 * 
	 * @return string
	 */
	public function getFileUniqueId(): string {
		return $this->fileUniqueId;
	}

	/**
	 * Unique identifier for this file, which is supposed to be the same over 
	 * time and for different bots. Can't be used to download or reuse the file.
	 * 
	 * @param string $fileUniqueId
	 */
	public function setFileUniqueId(string $fileUniqueId) {
		$this->fileUniqueId = $fileUniqueId;
	}
	
	/**
	 * Original filename as defined by sender
	 * 
	 * @return string|null
	 */
	public function getFileName(): ?string {
		return $this->fileName;
	}

	/**
	 * Original filename as defined by sender
	 * 
	 * @param string|null $fileName
	 */
	public function setFileName(?string $fileName) {
		$this->fileName = $fileName;
	}


}