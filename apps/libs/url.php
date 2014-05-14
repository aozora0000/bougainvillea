<?php
/* */
class URL {
	private $pattern;
	private $values;
	private $path = "";
	private $defaults = array();
	private $rules = array();

	public function __construct($path = "", $defaults = array(), $rules = array()) {
		$this->path = $path;
		$this->defaults = $defaults;
		$this->rules = $rules;

		try {
			$this->parse();
		} catch(Exception $e) {
			header("HTTP",404,TRUE);exit;
		}
	}

	private function parse() {
		$this->pattern= "/";
		$segments = split("/", ltrim($this->path, "/"));
		for($i = 0; $i < count($segments); $i++) {
			if(preg_match("/^:[a-zA-Z0-9_]+/i", $segments[$i], $match)) {
				$s = str_replace(":", "", $match[0]);

				if($s === "controller") {
					$this->values["controller"] = $i;
				} else if($s === "action") {
					$this->values["action"] = $i;
				} else {
					$this->values["params"][$s] = $i;
				}
				if(!is_null($this->rules[$s])) {
					$this->pattern .= "(\/" . $this->rules[$s] . ")";
				} else {
					$this->pattern .= "(\/[a-zA-Z0-9_]+)";
				}
			} else {
				$this->pattern .= "(\/" . $segments[$i] . ")";
			}
		}
		$this->pattern .= "/";
	}

	/**
	 * getter
	 */
	public function getPattern() {
		return $this->pattern;
	}

	public function getValues() {
		return $this->values;
	}

	public function getDefaults() {
		return $this->defaults;
	}

	public function getRules() {
		return $this->rules;
	}
}