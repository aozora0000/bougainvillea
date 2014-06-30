<?php
/* */
class Routes {
	public $routes = array();

	public function __construct() {}

	public static function getInstance() {
		static $instance = array();
		if(!isset($instance[0]) || !$instance[0]) {
			$instance[0] =& new Routes();
		}
		return $instance[0];
	}

	public static function connect($path, $default = array(), $rules = array()) {
		$route = new URL($path, $default, $rules);
		self::getInstance()->addRoute($route);
		return $route;
	}

	private function addRoute($route) {
		array_push($this->routes, $route);
	}

	public static function getRoute($path) {
		$self = self::getInstance();
		$controller = "index";
		$action = "index";
		$obj = new stdClass;

		$route = $self->routes[$self->matchPattern($path)];

		$values = $route->getValues();
		$defaults = $route->getDefaults();

		$segments = split("/", ltrim($path, "/"));
		if(is_null($values["controller"])) {
			$obj->controller = $defaults["controller"];
		} else {
			$obj->controller = $segments[$values["controller"]];
		}
		if(is_null($values["action"])) {
			$obj->action = $defaults["action"];
		} else {
			$obj->action = $segments[$values["action"]];
		}
		if(count($values["params"]) > 0) {
			foreach($values["params"] as $key => $value) {
				$obj->$key = $segments[$value];
			}
		}
		$obj->controller 	= (is_null($obj->controller)) 	? $controller 	: $obj->controller;
		$obj->action 		= (is_null($obj->action)) 		? $action 		: $obj->action;
		return (array)$obj;
	}

	private function matchPattern($path) {
		for($i = 0; $i < count($this->routes); $i++) {
			$pattern = $this->routes[$i]->getPattern();
			if(preg_match($pattern, $path)) {
				return $i;
			}
		}
		// exception
	}
}
