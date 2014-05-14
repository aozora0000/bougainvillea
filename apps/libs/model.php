<?php
	class Model {
		private $db;

		public function __construct() {
			$config = $this->_config(getenv("APPLICATION"));
			try {
				ORM::configure('mysql:host=localhost;dbname={$config[dbname]}');
				ORM::configure('username',$config["user"]);
				ORM::configure('password',$config["pass"]);
				ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
				ORM::configure('error_mode', PDO::ERRMODE_WARNING);
			} catch(PDOException $e) {
				header("HTTP",true,503);
				die("Sorry DataBase Server Down");
			}
		}

		public function validate($prefix) {
			$valid_file = VALIDATE_DIR.$prefix.".php";
			$class_name = $prefix."Validate";
			if(is_file($valid_file)) {
				require $valid_file;
				if(class_exists($class_name)) {
					return new $class_name;
				}
			} else {
				die("valid class not exist!");
			}
		}

		public function __destruct() {
			$this->pdo = NULL;
		}
	}