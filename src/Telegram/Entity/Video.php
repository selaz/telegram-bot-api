<?php

namespace Selaz\Telegram\Entity;

class Video extends Entity {
	use Traits\File;
	use Traits\Media;
	
	protected $duration;
	protected $thumb;
	protected $mimeType;
	
	/**
	 * Get video duration time
	 * @return int
	 */
	public function getDuration() : int {
		return $this->duration;
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
	 * set video duration
	 * 
	 * @param int $duration
	 */
	public function setDuration(int $duration) {
		$this->duration = $duration;
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