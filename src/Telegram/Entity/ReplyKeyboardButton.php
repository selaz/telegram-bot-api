<?php

namespace Selaz\Telegram\Entity;

class ReplyKeyboardButton extends Entity {
	protected $text;
	protected $requestContact;
	protected $requestLocation;
	
	/**
	 * Text of the button. If none of the optional fields are used, it will be sent as a message when the button is pressed
	 * 
	 * @return string
	 */
	public function getText(): string {
		return $this->text;
	}

	/**
	 * Optional. If True, the user's phone number will be sent as a contact when the button is pressed. Available in private chats only
	 * 
	 * @return bool
	 */
	public function getRequestContact(): bool {
		return $this->requestContact;
	}

	/**
	 * Optional. If True, the user's current location will be sent when the button is pressed. Available in private chats only
	 * 
	 * @return bool
	 */
	public function getRequestLocation(): bool {
		return $this->requestLocation;
	}

	/**
	 * Text of the button. If none of the optional fields are used, it will be sent as a message when the button is pressed
	 * 
	 * @param string $text
	 * @return void
	 */
	public function setText(string $text): void {
		$this->text = $text;
	}

	/**
	 * Optional. If True, the user's phone number will be sent as a contact when the button is pressed. Available in private chats only
	 * 
	 * @param bool $requestContact
	 * @return void
	 */
	public function setRequestContact(bool $requestContact): void {
		$this->requestContact = $requestContact;
	}

	/**
	 * Optional. If True, the user's current location will be sent when the button is pressed. Available in private chats only
	 * 
	 * @param bool $requestLocation
	 */
	public function setRequestLocation(bool $requestLocation) {
		$this->requestLocation = $requestLocation;
	}


}