<?php

namespace Selaz\Telegram\Entity;

class User extends Entity {
	
	use Traits\User;
	
	protected $isBot;


	/**
	 * true if user is bot
	 * 
	 * @return bool
	 */
	public function getIsBot() : bool {
		return $this->isBot;
	}

	/**
	 * true if user is bot
	 * 
	 * @param bool $isBot
	 */
	public function setIsBot(bool $isBot) {
		$this->isBot = $isBot;
	}
	
}