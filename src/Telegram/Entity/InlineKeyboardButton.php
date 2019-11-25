<?php

namespace Selaz\Telegram\Entity;

class InlineKeyboardButton extends Entity {
	protected $text;
	protected $url;
	protected $callbackData;
	
	/**
	 * Button text
	 * 
	 * @return string
	 */
	public function getText() : string {
		return $this->text;
	}

	/**
	 * Button url
	 * 
	 * @return string
	 */
	public function getUrl() : string {
		return $this->url;
	}

	/**
	 * Button callback data
	 * 
	 * @return string
	 */
	public function getCallbackData() : string {
		return $this->callbackData;
	}

	/**
	 * Button text
	 * 
	 * @param string $text
	 */
	public function setText( string $text ) {
		$this->text = $text;
	}

	/**
	 * Button url
	 * 
	 * @param string $url
	 */
	public function setUrl( string $url ) {
		$this->url = $url;
	}

	/**
	 * button callback data
	 * 
	 * @param string $callbackData
	 */
	public function setCallbackData( string $callbackData ) {
		$this->callbackData = $callbackData;
	}


}