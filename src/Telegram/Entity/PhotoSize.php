<?php

namespace Selaz\Telegram\Entity;

class PhotoSize extends Entity {
	use Traits\File;

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
}