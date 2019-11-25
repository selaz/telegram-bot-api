<?php

namespace Selaz\Tools;

class Log {

	private static $instance;
	private $defaultOut;
	private $levelLogFiles = [ ];
	private $lastMessage;

	const DEBUG = 'DEBUG';
	const INFO = 'INFO';
	const WARNING = 'WARNING';
	const ERROR = 'ERROR';

	private function __construct(string $defaultOut) {
		$this->defaultOut = $defaultOut;
	}

	/**
	 * Singletone log init method
	 * 
	 * @param string $defaultOut
	 * @return \Selaz\Log
	 */
	public static function init(string $defaultOut = 'php://stdout') {

		if (empty(self::$instance)) {
			self::$instance = new self($defaultOut);
		}

		return self::$instance;
	}

	/**
	 * Return log file for specified level
	 * 
	 * @param int $level
	 * @return string
	 */
	private function getOut(string $level) {
		return $this->levelLogFiles[ $level ] ?? $this->defaultOut;
	}

	/**
	 * Specify log level file
	 * 
	 * @param string $file
	 * @param int $level
	 */
	public function setLogFile(string $file, string $level) {
		$this->levelLogFiles[ $level ] = $file;
	}

	/**
	 * Write message to logfile whith log level DEBUG
	 * @param string $message
	 */
	public function debug(string $message) {
		$params = array_slice(func_get_args(), 1);

		if (count($params) > 0) {
			$message = vsprintf($message, $params);
		}

		$this->write($message, self::DEBUG);
	}

	/**
	 * Write message to logfile whith log level  info
	 * 
	 * @param string $message
	 */
	public function info(string $message) {
		$params = array_slice(func_get_args(), 1);

		if (count($params) > 0) {
			$message = vsprintf($message, $params);
		}

		$this->write($message, self::INFO);
	}

	/**
	 * Write message to logfile whith log level warning
	 * 
	 * @param string $message
	 */
	public function warning(string $message) {
		$params = array_slice(func_get_args(), 1);

		if (count($params) > 0) {
			$message = vsprintf($message, $params);
		}

		$this->write($message, self::WARNING);
	}

	/**
	 * Write message to logfile whith log level error
	 * 
	 * @param string $message
	 */
	public function error(string $message) {
		$params = array_slice(func_get_args(), 1);

		if (count($params) > 0) {
			$message = vsprintf($message, $params);
		}

		$this->write($message, self::ERROR);
	}

	/**
	 * Write log 
	 * 
	 * @param string $message
	 * @param int $level
	 * @return bool
	 */
	public function write(string $message, string $level = self::INFO) {

		$debug = current(debug_backtrace());

		$str = sprintf(
			"[%s] (%s) %s:%s : %s\n", $level, date('c'), $debug[ 'file' ], $debug[ 'line' ], $message
		);

		$this->lastMessage = $message;

		return boolval(file_put_contents($this->getOut($level), $str, FILE_APPEND));
	}

	/**
	 * Return last writed message
	 * 
	 * @return string
	 */
	public function getLastMessage() {
		return $this->lastMessage;
	}

}
