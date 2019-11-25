<?php

namespace Selaz\Telegram\Entity;

class InlineKeyboardMarkup {
	
	protected $buttons = [];
	
	protected $columns = 3;
	
	public function __construct() {
		
	}
	
	/**
	 * Add buttons to markup
	 * @param \Selaz\TelegramEntity\InlineKeyboardButton $button
	 */
	public function addButton( InlineKeyboardButton $button ) {
		$this->buttons[] = $button;
	}
	
	/**
	 * Flush murkup buttons
	 */
	public function flush() {
		$this->buttons = [];
	}

	/**
	 * Set buttons columns count
	 * 
	 * @param int $columns
	 */
	public function setColumns( int $columns ) {
		$this->columns = $columns;
	}
	
	/**
	 * return json serialized markup
	 * @return string
	 */
	public function serialize() {
		$btns = array_map(function($v) {
			if ( $v instanceof InlineKeyboardButton ) {
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
		
		return (!empty($return)) ? json_encode(['inline_keyboard' => $return]) : false;
	}
}