<?php

namespace Selaz\Telegram\Entity;

use Selaz\Telegram\Entity\Traits\CamelCase;

abstract class Entity {
	use CamelCase;

	public function __construct(array $data = null) {
		if (!empty($data)) {
			$this->arrayToCamelCaseSetters($data);
			$this->load($data);
		}
	}
	
	/**
	 * Fill entity object from array
	 * 
	 * @param array $data
	 */
	protected function load(array $data) {
		$log = \Selaz\Tools\Log::init();
		foreach ($data as $method => $data) {
			if (is_callable([ $this, $method ])) {
				call_user_func([ $this, $method ], $data);
			} else {
//				$log->info('Uncnown property %s in %s', $method, static::class);
			}
		}
	}
	
	/**
	 * Return converted to array object
	 * 
	 * @return array
	 */
	public function toArray() {
		return self::arrayFromCamelCase(get_object_vars($this));
	}
	
	/**
	 * Convert object vars to camel case
	 * 
	 * @param array $values
	 * @return type
	 */
	public static function arrayFromCamelCase(array $values) {
		$arr = [ ];
		foreach ($values as $varName => $varValue) {
			if ($varValue instanceof Entity) {
				$arr[ self::fromCamelCase($varName) ] = $varValue->toArray();
			} elseif (is_array($varValue)) {
				$arr[ self::fromCamelCase($varName) ] = self::arrayFromCamelCase($varValue);
			} else {
				$arr[ self::fromCamelCase($varName) ] = $varValue;
			}
		}
		return array_filter($arr, function ($z){return !is_null($z);});
	}
}