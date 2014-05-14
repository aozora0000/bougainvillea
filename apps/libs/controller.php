<?php
	class Controller {
		public $_templete_dir;
		public $_display;

		public function __construct() {
			$this->view = new stdClass();
			$this->smarty = new Smarty;
			$this->smarty->caching = false;
			$this->smarty->compile_dir = SMARTY_CONPILE_DIR;
		}

		/*
		*	呼び出し系
		*/
		public function model($model_file) {
			if(is_file(MODEL_DIR.$model_file.".php")) {
				require_once MODEL_DIR.$model_file.".php";
				$class_name = ucwords($model_file)."Model";
				if(class_exists($class_name)) {
					return new $class_name;
				}
			}
		}

		/*
		*	Smarty系
		*/
		public function template_dir($dir) {
			$this->_template_dir = $dir;
		}
		public function display($tpl) {
			$this->_display = $tpl;
		}

		/*
		* ライブラリ依存のメソッド(要require)
		*/
		public function request() {
			//request.php
			return new Request;
		}
		public function session() {
			//session.php
			return new Session();
		}

		//便利系
		public function redirect($location = "/") {
			header("Location: ".$location);
			exit;
		}

		public function __destruct() {
			if(!empty($this->view)) {
				foreach($this->view as $key=>$value) {
					$this->smarty->assign($key,$value);
				}
			}
			$this->template_dir = (!empty($this->_template_dir)) ? $this->_template_dir."/" : "";
			$this->smarty->template_dir = SMARTY_TEMPLATE_DIR.$this->_template_dir;
			if(!empty($this->_display)) {
				$this->smarty->display($this->_display);
			}
		}
	}