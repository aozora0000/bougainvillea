<?php
	class Cast {
		static function _isNULL($obj) {
			return (is_null($obj))				? TRUE : FALSE;
		}
		static function _isSet($obj) {
			return (isset($obj))				? TRUE : FALSE;
		}
		static function _isNotEmpty($obj) {
			return (isset($obj) && $obj !== "") ? TRUE : FALSE;
		}

		static function _convert($obj) {
			switch($obj) {
				case preg_match("/^[0-9]{1,}$/",$obj) :
					return (int)$obj;
					break;
				case is_array($obj) :
					return (object)$obj;
					break;
				default :
					return $obj;
					break;
			}
		}

		static function Obj($array) {
			return (isset($array)) ? (object)$array : FALSE;
		}

		public function JsonDecode($json) {
			return json_decode($json);
		}
	}