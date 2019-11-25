<?php

namespace Selaz\Telegram\Entity;

class CallbackQuery extends Entity {
	protected $id;
	protected $from;
	protected $message;
	protected $inlineMessageId;
	protected $data;
	
	/**
	 * return callback id
	 * 
	 * @return string
	 */
	public function getId() : string {
		return $this->id;
	}

	/**
	 * Return user from whom callback came
	 * 
	 * @return \Selaz\TelegramEntity\User
	 */
	public function getFrom() : User {
		return $this->from;
	}

	/**
	 * Return callback message
	 * 
	 * @return \Selaz\TelegramEntity\Message
	 */
	public function getMessage() : Message {
		return $this->message;
	}

	/**
	 * Return inline message id, if callbak came from inline message
	 * @return string
	 */
	public function getInlineMessageId() : string {
		return $this->inlineMessageId;
	}

	/**
	 * get callback data
	 * 
	 * @return string
	 */
	public function getData() : string {
		return $this->data;
	}

	/**
	 * callback id
	 * 
	 * @param string $id
	 */
	public function setId( string $id ) {
		$this->id = $id;
	}

	/**
	 * set user data from whom callback came
	 * @param array $from
	 */
	public function setFrom( array $from ) {
		$this->from = new User($from);
	}

	/**
	 * set callback message data
	 * @param array $message
	 */
	public function setMessage( array $message ) {
		$this->message = new Message( $message );
	}

	/**
	 * set inline message id, if calback came from inline message
	 * 
	 * @param string $inlineMessageId
	 */
	public function setInlineMessageId( string $inlineMessageId ) {
		$this->inlineMessageId = $inlineMessageId;
	}

	/**
	 * set callback data
	 * 
	 * @param string $data
	 */
	public function setData( string $data ) {
		$this->data = $data;
	}
}