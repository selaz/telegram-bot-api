<?php

namespace Selaz;

use CURLFile,
	InvalidArgumentException,
	Selaz\Exceptions\QueryException,
	Selaz\Telegram\Entity\Chat,
	Selaz\Telegram\Entity\Entity,
	Selaz\Tools\File,
	Selaz\Telegram\Entity\File as TFile,
	Selaz\Telegram\Entity\KeyboardMarkup,
	Selaz\Telegram\Entity\Message,
	Selaz\Telegram\Entity\Update,
	Selaz\Telegram\Entity\User,
	Selaz\Tools\Query;

class BotApi {
	
	private $token;
	private $debug;
	
	const API_URL = 'https://api.telegram.org/%sbot%s/%s';
	
	public function __construct(string $token, bool $debug = false) {
		$this->token = $token;
		$this->debug = $debug;
	}
	
	/**
	 * Return info about current bot
	 * @return User
	 */
	public function getMe() : User {
		return new User($this->query('getMe'));
	}
	
	/**
	 * Return updates
	 * 
	 * @param int $offset
	 * @param int $limit
	 * @param int $timeout
	 * @return Update[]
	 */
	public function getUpdates(int $offset = 0, int $limit = 0, int $timeout = 0) {
		$updates = $this->query('getUpdates', [
			'offset' => $offset,
			'limit' => $limit,
			'timeout' => $timeout
		]);
		
		return array_map(function($v) {
			return new Update($v);
		}, $updates);
	}
	
	/**
	 * Return file by path
	 * 
	 * @param string $path
	 * @return File
	 */
	public function getFile(string $path) {
		$data = $this->query('getFile', [ 'file_id' => $path ]);
		return new TFile($data);
	}
	
	/**
	 * Send message to chat
	 * 
	 * @param Chat $chat
	 * @param string $text
	 * @param Message $replyToMessageId
	 * @param KeyboardMarkup $keyboardMarkup
	 * @param string $parseMode
	 * @param bool $disableWebPagePreview
	 * @param bool $disableNotification
	 * @return Message
	 */
	public function sendMessage( 
		Chat $chat, 
		string $text, 
		Message $replyToMessageId = null,
		KeyboardMarkup $keyboardMarkup = null,
		string $parseMode = null, 
		bool $disableWebPagePreview = null, 
		bool $disableNotification = null
	) {
		$params = [
			'chatId' => $chat->getId(),
			'text' => $text,
			'parseMode' => $parseMode,
			'disableWebPagePreview' => $disableWebPagePreview,
			'disableNotification' => $disableNotification,
			'replyToMessageId' => ($replyToMessageId) ? $replyToMessageId->getMessageId() : null,
			'replyMarkup' => ($keyboardMarkup) ? $keyboardMarkup->serialize() : null,
		];
		
		$this->sendChatAction($chat, 'typing');
		
		return new Message($this->query('sendMessage', $params));
	}
	
	/**
	 * Send photo to chat
	 * 
	 * @param Chat $chat
	 * @param \Selaz\File $photo
	 * @param string $caption
	 * @param bool $disableNotification
	 * @param Message $replyToMessageId
	 * @return Message
	 */
	public function sendPhoto( 
		Chat $chat, 
		File $photo, 
		string $caption = null, 
		bool $disableNotification = null, 
		Message $replyToMessageId = null 
	) {
		$params = [
			'chatId' => $chat->getId(),
			'photo' => new CURLFile($photo),
			'caption' => $caption,
			'disableNotification' => $disableNotification,
			'replyToMessageId' => ($replyToMessageId) ? $replyToMessageId->getMessageId() : null,
		];
		
		$this->sendChatAction($chat, 'upload_photo');
		
		return new Message($this->query('sendPhoto', $params));
	}
	
	/**
	 * Send video to chat
	 * 
	 * @param Chat $chat
	 * @param \Selaz\File $video
	 * @param string $caption
	 * @param int $duration
	 * @param int $width
	 * @param int $height
	 * @param bool $disableNotification
	 * @param Message $replyToMessageId
	 * @return Message
	 */
	public function sendVideo(
		Chat $chat,
		File $video,
		string $caption = null,
		int $duration = null,
		int $width = null,
		int $height = null,
		bool $disableNotification = null,
		Message $replyToMessageId = null 
	) {
		$params = [
			'chatId' => $chat->getId(),
			'video' => new CURLFile($video),
			'caption' => $caption,
			'duration' => $duration,
			'width' => $width,
			'height' => $height,
			'disableNotification' => $disableNotification,
			'replyToMessageId' => ($replyToMessageId) ? $replyToMessageId->getMessageId() : null,
		];
		
		$this->sendChatAction($chat, 'upload_video');
		
		return  new Message($this->query('sendVideo', $params));
	}
	
	/**
	 * Send chat action
	 * 
	 * @param Chat $chat
	 * @param string $action
	 * @return type
	 * @throws InvalidArgumentException
	 */
	public function sendChatAction(Chat $chat, string $action) {
		
		$validActions = [
			Chat::ACTION_TYPING,
			Chat::ACTION_UPLOAD_PHOTO,
			Chat::ACTION_RECORD_VIDEO,
			Chat::ACTION_UPLOAD_VIDEO,
			Chat::ACTION_RECORD_AUDIO,
			Chat::ACTION_UPLOAD_AUDIO,
			Chat::ACTION_UPLOAD_DOCUMENT,
		];
		
		if (!in_array($action, $validActions)) {
			throw new InvalidArgumentException('Wrong parameter action in request');
		}
		
		return $this->query('sendChatAction', [ 'chatId' => $chat->getId(), 'action' => $action ]);
	}
	
	/**
	 * Return webhook settings info
	 * @return array
	 */
	public function getWebhookInfo() : array {
		return $this->query( 'getWebhookInfo');
	}
	
	/**
	 * Set webhook
	 * 
	 * @param string $url
	 * @param \Selaz\File $key
	 * @return bool
	 */
	public function setWebhook( string $url, File $key = null ) {
		return $this->query( 'setWebhook', [ 'url' => $url, 'certificate' => $key ] );
	}
	
	/**
	 * Delete webhook
	 * 
	 * @return bool
	 */
	public function deleteWebhook() : bool {
		return $this->query( 'deleteWebhook');
	}

	/**
	 * Query to telegram bot api
	 * 
	 * @param string $method
	 * @param array $params
	 * @param string $prefix
	 * @return type
	 * @throws QueryException
	 */
	private function query( string $method, array $params = [], $prefix = null ) {
		
		if (!empty($prefix) && substr($prefix, -1) != '/') {
			$prefix .= '/';
		}
		
		$params = Entity::arrayFromCamelCase(array_filter($params));
		
		$http = new Query(sprintf(self::API_URL, $prefix, $this->token, $method));
		$http->set(CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5_HOSTNAME);
		$http->set(CURLOPT_POST, true);
		$http->set(CURLOPT_POSTFIELDS, $params);
		$http->set(CURLOPT_RETURNTRANSFER, true);
		$http->query();

		if ($this->debug) {
			printf(">>> %s\n", $http->getUrl());
			printf(">>> %s\n", json_encode($params));
			printf("<<< %s\n", $http->getQueryResult());
		}
		$result = $http->getQueryResultFromJson(true);
		if (!($result[ 'ok' ] ?? false)) {
			//throw new QueryException($result[ 'description' ], $result[ 'error_code' ]);
		}
		
		return $result[ 'result' ] ?? [ ];
	}
}
