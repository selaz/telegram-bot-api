<?php

namespace Selaz\Telegram\Entity\Traits;

use Selaz\Telegram\Entity\PhotoSize;

trait Media {

	protected $width;
	protected $height;

	/**
	 * Media width 
	 * 
	 * @return int
	 */
	public function getWidth(): int {
		return $this->width;
	}

	/**
	 * Media height
	 * 
	 * @return int
	 */
	public function getHeight(): int {
		return $this->height;
	}

	/**
	 * Media width
	 * 
	 * @param int $width
	 */
	public function setWidth(int $width) {
		$this->width = $width;
	}

	/**
	 * Media height
	 * @param int $height
	 */
	public function setHeight(int $height) {
		$this->height = $height;
	}
	
	/**
	 * Get video previews
	 * 
	 * @return \Selaz\TelegramEntity\PhotoSize
	 */
	public function getThumb() : PhotoSize {
		return $this->thumb;
	}
	
	/**
	 * set video previews
	 * 
	 * @param array $thumb
	 */
	public function setThumb(array $thumb) {
		$this->thumb = new PhotoSize($thumb);
	}
	
	/**
	 * get video mimetype
	 * 
	 * @return string
	 */
	public function getMimeType() : string {
		return $this->mimeType;
	}

	/**
	 * set video mimetype
	 * 
	 * @param string $mimeType
	 */
	public function setMimeType(string $mimeType) {
		$this->mimeType = $mimeType;
	}

}
