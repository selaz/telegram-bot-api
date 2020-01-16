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
	 * set video duration
	 * 
	 * @param int $duration
	 */
	public function setDuration(int $duration) {
		$this->duration = $duration;
	}
}