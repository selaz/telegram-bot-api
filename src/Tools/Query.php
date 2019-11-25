<?php

namespace Selaz\Tools;

class Query {
	
	protected $url;
	
	protected $error;
	
	protected $result;
	
	protected $resultInfo;
	
	protected $options;
	
	protected $headers;


	public function __construct(?string $url = null) {
		$this->url = $url;
	}
	
	/**
	 * Set postfields from array
	 * 
	 * @param array $fields
	 */
	public function setPost(array $fields) {
		$this->set(CURLOPT_POST, true);
		$this->set(CURLOPT_POSTFIELDS, $fields);
	}
	
	/**
	 * Return current query url
	 * 
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}
	
	public function setUrl(string $url) {
		$this->url = $url;
	}

		
	/**
	 * return curl query options
	 * 
	 * @return array
	 */
	protected function getOptions() : array {
		
		if ( !empty( $this->headers ) ) {
			$this->options[CURLOPT_HTTPHEADER] = $this->headers;
		}
		
		return $this->options ?? [ ];
	}
	
	/**
	 * set curl option
	 * 
	 * @param int $curlOpt
	 * @param type $val
	 */
	public function set(int $curlOpt, $val) {
		$this->options[ $curlOpt ] = $val;
	}
	
	public function addHeader( string $name, string $value ) {
		$header = sprintf("%s: %s", $name, $value);
		
		$this->headers[] = $header;
	}
	
	/**
	 * return last query error, or empty string 
	 * 
	 * @return string
	 */
	public function getError() {
		return $this->error;
	}
	
	public function download( File $file = null ) {
		if ( empty( $file ) ) {
			$file = new File();
		}
		
		$this->set( CURLOPT_FILE, $file->getDecriptor('w+') );
		
		if ( $this->query() ) {
			return $file;
		} else {
			return false;
		}
	}
	
	/**
	 * curl query 
	 * 
	 * @return bool
	 */
	public function query() {
		$ch = curl_init($this->getUrl());
		curl_setopt_array($ch, $this->getOptions());
		
		$this->result = curl_exec($ch);
		
		$this->collectQueryInfo($ch);
		$this->error = curl_error($ch) ?: null;
		
		curl_close($ch);
		
		return ($this->result === false) ?: true;
	}
	
	/**
	 * Return query result if CURLOPT_RETURNTRANSFER set true, or bool
	 * @return string|bool
	 */
	public function getQueryResult() {
		return $this->result;
	}
	
	/**
	 * return json_decode from query result
	 * 
	 * @param bool $array
	 * @return mixed
	 */
	public function getQueryResultFromJson(bool $array = true) {
		return json_decode($this->result, $array);
	}

	/**
	 * Return query result by key (CURLINFO_* consts)
	 * @param int $opt
	 * @return type
	 */
	public function getQueryInfo(int $opt = null) {
		return $this->resultInfo[ $opt ] ?? null;
	}
	
	/**
	 * collect curl query result to array
	 * 
	 * @param resource $ch
	 */
	protected function collectQueryInfo($ch) {
		$values = [
			CURLINFO_EFFECTIVE_URL => null,
			CURLINFO_HTTP_CODE => null,
			CURLINFO_FILETIME => null,
			CURLINFO_TOTAL_TIME => null,
			CURLINFO_NAMELOOKUP_TIME => null,
			CURLINFO_CONNECT_TIME => null,
			CURLINFO_PRETRANSFER_TIME => null,
			CURLINFO_STARTTRANSFER_TIME => null,
			CURLINFO_REDIRECT_COUNT => null,
			CURLINFO_REDIRECT_TIME => null,
			CURLINFO_REDIRECT_URL => null,
			CURLINFO_PRIMARY_IP => null,
			CURLINFO_PRIMARY_PORT => null,
			CURLINFO_LOCAL_IP => null,
			CURLINFO_LOCAL_PORT => null,
			CURLINFO_SIZE_UPLOAD => null,
			CURLINFO_SIZE_DOWNLOAD => null,
			CURLINFO_SPEED_DOWNLOAD => null,
			CURLINFO_SPEED_UPLOAD => null,
			CURLINFO_HEADER_SIZE => null,
			CURLINFO_HEADER_OUT => null,
			CURLINFO_REQUEST_SIZE => null,
			CURLINFO_SSL_VERIFYRESULT => null,
			CURLINFO_CONTENT_LENGTH_DOWNLOAD => null,
			CURLINFO_CONTENT_LENGTH_UPLOAD => null,
			CURLINFO_CONTENT_TYPE => null,
			CURLINFO_PRIVATE => null,
			CURLINFO_RESPONSE_CODE => null,
			CURLINFO_HTTP_CONNECTCODE => null,
			CURLINFO_HTTPAUTH_AVAIL => null,
			CURLINFO_PROXYAUTH_AVAIL => null,
			CURLINFO_OS_ERRNO => null,
			CURLINFO_NUM_CONNECTS => null,
			CURLINFO_SSL_ENGINES => null,
			CURLINFO_COOKIELIST => null,
			CURLINFO_FTP_ENTRY_PATH => null,
			CURLINFO_APPCONNECT_TIME => null,
			CURLINFO_CERTINFO => null,
			CURLINFO_CONDITION_UNMET => null,
			CURLINFO_RTSP_CLIENT_CSEQ => null,
			CURLINFO_RTSP_CSEQ_RECV => null,
			CURLINFO_RTSP_SERVER_CSEQ => null,
			CURLINFO_RTSP_SESSION_ID => null
		];
		
		foreach ($values as $key => &$val) {
			$val = curl_getinfo($ch, $key);
		}
		
		$this->resultInfo = $values;
	}
}