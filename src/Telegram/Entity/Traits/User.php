<?php

namespace Selaz\Telegram\Entity\Traits;

trait User {
	
	protected $id;
	protected $username;
	protected $firstName;
	protected $lastName;
	
	/**
	 * User id
	 * 
	 * @return int
	 */
	public function getId() : int {
		return $this->id;
	}
	
	/**
	 * Alternative user id (@channelusername)
	 * 
	 * @return string
	 */
	public function getUsername() : string {
		return $this->username;
	}

	/**
	 * First name
	 * 
	 * @return string
	 */
	public function getFirstName() : string {
		return $this->firstName;
	}

	/**
	 * Last name
	 * 
	 * @return string
	 */
	public function getLastName() : string {
		return $this->lastName;
	}
	
	/**
	 * Alternative user id (@channelusername)
	 * @param string $username
	 */
	public function setUsername(string $username) {
		$this->username = $username;
	}

	/**
	 * First name
	 * 
	 * @param string $firstName
	 */
	public function setFirstName(string $firstName) {
		$this->firstName = $firstName;
	}

	/**
	 * Last name
	 * @param string $lastName
	 */
	public function setLastName(string $lastName) {
		$this->lastName = $lastName;
	}
	
	/**
	 * User id
	 * @param int $id
	 */
	public function setId(int $id) {
		$this->id = $id;
	}
}