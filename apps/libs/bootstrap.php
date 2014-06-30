<?php
	class BootStrap {
		protected $thread;
		public function execute($class_name = "Index",$method = "Index") {
			$class_name = strtolower($class_name);
			if(is_file(CTRL_DIR.$class_name.".php")) {
				require CTRL_DIR.$class_name.".php";
				$class = ucwords($class_name)."Controller";
				if(class_exists($class) && method_exists($class,$method)) {
					$this->thread = new $class;
					$this->thread->$method();
				} else {
					self::call404();
				}
			} else {
				self::call404();
			}
		}

		static function call404() {
			header('HTTP', true, 404);
			exit("404 Not Found");
		}

		public function __destruct() {
			$this->thread = NULL;
			exit;
		}
	}
