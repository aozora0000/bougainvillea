<?php
	class Validate {

		static function none($string) {
			return TRUE;
		}
		static function required($string) {
			return (!is_null($string) && $string !== "") ? TRUE : FALSE;
		}

		static function is_numeric($string) {
			return (preg_match("/^[0-9]+$/",$string) OR empty($string)) ? TRUE : FALSE;
		}

		static function is_alpha($string) {
			return (preg_match("/^[0-9a-z]+$/i",$string) OR empty($string)) ? TRUE : FALSE;
		}

		static function is_alphamark($string) {
			return (preg_match("/^[a-zA-Z0-9\-@_]+$/i",$string) OR empty($string)) ? TRUE : FALSE;
		}

		static function is_phone($string) {
			return (preg_match("/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{2,4}$/",$string) OR empty($string)) ? TRUE : FALSE;
		}
		static function length($string,$length) {
			return (isset($string[$length-1])) ? TRUE : FALSE;
		}
		static function is_time($string) {
			return (preg_match("/^[0-9]{1,2}:[0-9]{1,2}$/i",$string) OR empty($string)) ? TRUE : FALSE;
		}
		static function is_timestamp($string) {
			return (preg_match("/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/i",$string) OR empty($string)) ? TRUE : FALSE;
		}


		public function execute($obj,$filter_name) {
			$valid = $this->$filter_name;
			return self::_execute($valid,$obj);
		}

		static function _execute($valid,$obj) {

		}
	}