<?php

namespace Selaz\Telegram\Entity\Traits;

trait CamelCase {

	/**
	 * Convert to CamelCase from under_scope
	 * @param string $str
	 * @return string
	 */
	protected function toCamelCaseSetters(string $str) : string {
		$underscore = strpos($str, '_');
		if ($underscore) {
			$str = substr_replace($str, strtoupper(substr($str, $underscore + 1, 1)), $underscore, 2);
			$str = $this->toCamelCaseSetters($str);
		}

		return $str;
	}

	/**
	 * Convert array keys to CamelCase from under_scope
	 * @param array $data
	 * @return boolean
	 */
	protected function arrayToCamelCaseSetters(array &$data) {
		$ccData = [ ];
		foreach ($data as $key => $val) {
			$ccData[ sprintf("set%s", ucfirst($this->toCamelCaseSetters($key))) ] = $val;
		}

		$data = $ccData;
		return true;
	}

	/**
	 * Convert CamelCase to under_scope
	 * @param string $str
	 * @return string
	 */
	protected static function fromCamelCase(string $str) : string {
		return strtolower(preg_replace('~([A-Z])~', '_$1', $str));
	}
}
