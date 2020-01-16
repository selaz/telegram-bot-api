<?php

namespace Selaz\Telegram\Entity;

class Message extends Entity {
	protected $messageId;
	protected $from;
	protected $date;
	protected $chat;
	protected $text;
	protected $photo;
	protected $video;
	protected $animation;
	protected $document;
	protected $caption;
	protected $location;
	protected $venue;
	
	/**
	 * return message id
	 * 
	 * @return int
	 */
	public function getMessageId() : int {
		return $this->messageId;
	}

	/**
	 * get message user
	 * @return \Selaz\Telegram\Entity\User
	 */
	public function getFrom() : User {
		return $this->from;
	}

	/**
	 * get message date [unixtime]
	 * @return int
	 */
	public function getDate() : int {
		return $this->date;
	}

	/**
	 * get message chat
	 * 
	 * @return \Selaz\Telegram\Entity\Chat
	 */
	public function getChat() : Chat {
		return $this->chat;
	}

	/**
	 * get message text, or photo caption if photo in message
	 * 
	 * @return string
	 */
	public function getText(): ?string {
		return (!$this->hasPhoto()) ? $this->text : $this->getCaption();
	}
	
	/**
	 * return true if photo in message
	 * 
	 * @return boolean
	 */
	public function hasPhoto() {
		if (!empty($this->photo)) {
			return true;
		}
		
		return false;
	}

	/**
	 * return photos
	 * 
	 * @return PhotoSize[]
	 */
	public function getPhoto(int $index = null) {
		if ($index === null) {
			return $this->photo;
		} else {
			return $this->photo[ 0 ] ?? null;
		}
	}

	/**
	 * 
	 * @return \Selaz\Telegram\Entity\Video
	 */
	public function getVideo() : Video {
		return $this->video;
	}

	/**
	 * return photo or video caption
	 * 
	 * @return string
	 */
	public function getCaption(): ?string {
		return $this->caption;
	}

	/**
	 * return location from message
	 * 
	 * @return \Selaz\Telegram\Entity\Location
	 */
	public function getLocation(): ?Location {
		return $this->location;
	}

	/**
	 * return venue from message
	 * 
	 * @return \Selaz\Telegram\Entity\Venue
	 */
	public function getVenue() : Venue {
		return $this->venue;
	}

	/**
	 * message id
	 * 
	 * @param int $messageId
	 */
	public function setMessageId(int $messageId) {
		$this->messageId = $messageId;
	}

	/**
	 * ser message user data
	 * 
	 * @param array $from
	 */
	public function setFrom(array $from) {
		$this->from = new User($from);
	}

	/**
	 * set message time (unixtime)
	 * @param int $date
	 */
	public function setDate(int $date) {
		$this->date = $date;
	}

	/**
	 * set message chat data
	 * 
	 * @param array $chat
	 */
	public function setChat(array $chat) {
		$this->chat = new Chat($chat);
	}

	/**
	 * set message text
	 * 
	 * @param string $text
	 */
	public function setText(string $text) {
		$this->text = $text;
	}

	/**
	 * set message photo data
	 * 
	 * @param array $photo
	 */
	public function setPhoto(array $photo) {
		$this->photo = array_map(function($v) {
			return new PhotoSize($v);
		}, $photo);
	}
	
	/**
	 * set message video data
	 * 
	 * @param array $video
	 */
	public function setVideo(array $video) {
		$this->video = new Video($video);
	}

	/**
	 * set photo\video caption
	 * 
	 * @param string $caption
	 */
	public function setCaption(string $caption) {
		$this->caption = $caption;
	}

	/**
	 * set location data
	 * 
	 * @param array $location
	 */
	public function setLocation(array $location) {
		$this->location = new Location($location);
	}

	/**
	 * set venur data
	 * 
	 * @param array $venue
	 */
	public function setVenue(array $venue) {
		$this->venue = new Venue($venue);
	}
	
	/**
	 * Message is an animation, information about the animation. 
	 * For backward compatibility, when this field is set, 
	 * the document field will also be set
	 * 
	 * @return \Selaz\Telegram\Entity\Animation|null
	 */
	public function getAnimation(): ?Animation {
		return $this->animation;
	}

	/**
	 * Message is a general file, information about the file
	 * 
	 * @return \Selaz\Telegram\Entity\Document|null
	 */
	public function getDocument(): ?Document {
		return $this->document;
	}

	/**
	 * Message is an animation, information about the animation. 
	 * For backward compatibility, when this field is set, 
	 * the document field will also be set
	 * 
	 * @param array $animation
	 * @return void
	 */
	public function setAnimation(?array $animation): void {
		$this->animation = new Animation($animation);
	}

	/**
	 * Message is a general file, information about the file
	 * 
	 * @param array $document
	 * @return void
	 */
	public function setDocument(?array $document): void {
		$this->document = new Document($document);
	}


}
