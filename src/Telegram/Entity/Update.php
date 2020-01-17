<?php

namespace Selaz\Telegram\Entity;

class Update extends Entity {
	
	protected $updateId;
	
	protected $message;
	
	protected $callbackQuery;

	protected $editedMessage;


	public function getEditedMessage(): ?Message  {
		return $this->editedMessage;
	}

	public function setEditedMessage(?array $editedMessage): void {
		$this->editedMessage = new Message($editedMessage);
	}


	/**
	 * return update id
	 * 
	 * @return int
	 */
	public function getUpdateId() : int {
		return $this->updateId;
	}

	/**
	 * return message
	 * 
	 * @return \Selaz\Telegram\Entity\Message
	 */
	public function getMessage(): ?Message {
		return $this->message;
	}

	/**
	 * set update id
	 * 
	 * @param int $updateId
	 */
	public function setUpdateId(int $updateId) {
		$this->updateId = $updateId;
	}

	/**
	 * set message data
	 * 
	 * @param array $data
	 */
	public function setMessage(?array $data): void {
		$this->message = new Message($data);
	}
	
	/**
	 * return callback query
	 * 
	 * @return \Selaz\TelegramEntity\CallbackQuery
	 */
	public function getCallbackQuery() : CallbackQuery {
		return $this->callbackQuery;
	}

	/**
	 * set callback query data
	 * 
	 * @param array $callbackQuery
	 */
	public function setCallbackQuery( array $callbackQuery ) {
		$this->callbackQuery = new CallbackQuery( $callbackQuery );
	}

}