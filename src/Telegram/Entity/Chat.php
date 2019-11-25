<?php

namespace Selaz\Telegram\Entity;

use Selaz\Telegram\Entity\Traits\User;

class Chat extends Entity {
	use User;
	
	const ACTION_TYPING = 'typing';
	const ACTION_UPLOAD_PHOTO = 'upload_photo';
	const ACTION_RECORD_VIDEO = 'record_video';
	const ACTION_UPLOAD_VIDEO = 'upload_video';
	const ACTION_RECORD_AUDIO = 'record_audio';
	const ACTION_UPLOAD_AUDIO = 'upload_audio';
	const ACTION_UPLOAD_DOCUMENT = 'upload_document';
	
	protected $type;
	protected $title;
	
	/**
	 * Chat type. Possible values: private, group, supergroup or channel
	 * @return string
	 */
	public function getType() : string {
		return $this->type;
	}

	/**
	 * Chat title
	 * 
	 * @return string
	 */
	public function getTitle() : string {
		return $this->title;
	}

	/**
	 * Chat type. Possible values: private, group, supergroup or channel
	 * 
	 * @param string $type
	 */
	public function setType(string $type) {
		$this->type = $type;
	}

	/**
	 * Chat title
	 * 
	 * @param string $title
	 */
	public function setTitle(string $title) {
		$this->title = $title;
	}
}