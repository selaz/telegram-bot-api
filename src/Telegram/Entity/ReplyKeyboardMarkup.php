<?php

namespace Selaz\Telegram\Entity;

class ReplyKeyboardMarkup extends KeyboardMarkup {
	
	protected $buttons = [];
	
	protected $columns = 3;
	
	protected $resizeKeyboard = false;
	protected $oneTimeKeyboard = false;
	protected $selective = false;
	
	public function __construct() {
		
	}
	
	/**
	 * Add buttons to markup
	 * @param \Selaz\TelegramEntity\ReplyKeyboardButton $button
	 */
	public function addButton(ReplyKeyboardButton $button ) {
		$this->buttons[] = $button;
	}
	
	/**
	 * return json serialized markup
	 * @return string
	 */
	public function serialize() {
		$btns = array_map(function($v) {
			if ( $v instanceof ReplyKeyboardButton ) {
				return $v->toArray();
			}
		}, $this->buttons);
		
		$btns = array_filter( $btns );
		
		$offset = 0;
		$return = [];
		while ( $btnsSlice = array_slice( $btns, $offset, $this->columns ) ) {
			$offset += $this->columns;
			$return[] = $btnsSlice;
		}
		
		$keyBoard = [
			'keyboard' => $return,
			'resize_keyboard' => $this->getResizeKeyboard(),
			'one_time_keyboard' => $this->getOneTimeKeyboard(),
			'selective' => $this->getSelective()
		];
		
		return (!empty($return)) ? json_encode($keyBoard) : false;
	}
	
	/**
	 * Optional. Requests clients to resize the keyboard vertically for optimal fit 
	 * (e.g., make the keyboard smaller if there are just two rows of buttons). 
	 * Defaults to false, in which case the custom keyboard is always of the 
	 * same height as the app's standard keyboard.
	 * 
	 * @return bool
	 */
	public function getResizeKeyboard(): bool {
		return $this->resizeKeyboard;
	}

	/**
	 * Optional. Requests clients to hide the keyboard as soon as it's been used. 
	 * The keyboard will still be available, but clients will automatically display 
	 * the usual letter-keyboard in the chat – the user can press a special button in 
	 * the input field to see the custom keyboard again. Defaults to false.
	 * 
	 * @return bool
	 */
	public function getOneTimeKeyboard(): bool {
		return $this->oneTimeKeyboard;
	}

	/**
	 * Optional. Use this parameter if you want to show the keyboard to specific 
	 * users only. Targets: 1) users that are @mentioned in the text of the 
	 * Message object; 2) if the bot's message is a reply (has reply_to_message_id), 
	 * sender of the original message. 
	 * 
	 * Example: A user requests to change the bot‘s language, bot replies to the 
	 * request with a keyboard to select the new language. Other users in the 
	 * group don’t see the keyboard.
	 * 
	 * @return bool
	 */
	public function getSelective(): bool {
		return $this->selective;
	}

	/**
	 * Optional. Requests clients to resize the keyboard vertically for optimal fit 
	 * (e.g., make the keyboard smaller if there are just two rows of buttons). 
	 * Defaults to false, in which case the custom keyboard is always of the 
	 * same height as the app's standard keyboard.
	 * 
	 * @param bool $resizeKeyboard
	 * @return void
	 */
	public function setResizeKeyboard(bool $resizeKeyboard): void {
		$this->resizeKeyboard = $resizeKeyboard;
	}

	/**
	 * Optional. Requests clients to hide the keyboard as soon as it's been used. 
	 * The keyboard will still be available, but clients will automatically display 
	 * the usual letter-keyboard in the chat – the user can press a special button in 
	 * the input field to see the custom keyboard again. Defaults to false.
	 * 
	 * @param bool $oneTimeKeyboard
	 * @return void
	 */
	public function setOneTimeKeyboard(bool $oneTimeKeyboard): void {
		$this->oneTimeKeyboard = $oneTimeKeyboard;
	}

	/**
	 * Optional. Use this parameter if you want to show the keyboard to specific 
	 * users only. Targets: 1) users that are @mentioned in the text of the 
	 * Message object; 2) if the bot's message is a reply (has reply_to_message_id), 
	 * sender of the original message. 
	 * 
	 * Example: A user requests to change the bot‘s language, bot replies to the 
	 * request with a keyboard to select the new language. Other users in the 
	 * group don’t see the keyboard.
	 * 
	 * @param bool $selective
	 * @return void
	 */
	public function setSelective(bool $selective): void {
		$this->selective = $selective;
	}
	
}