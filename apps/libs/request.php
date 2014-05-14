<?php
	class Request {
		public $post;
		public $get;

		public function __construct() {
			$this->post = (object)$_POST;
			$this->get = (object)$_GET;
			$this->file = (object)$_FILES;
			unset($this->get->class);
			unset($this->get->method);
		}

		public function post($key = "ALL") {
			if(isset($this->post->$key) OR $key === "ALL") {
				return ($key !== "ALL") ? $this->post->$key : $this->post;
			} else {
				return null;
			}
		}

		public function get($key = "ALL") {
			if(isset($this->get->$key) OR $key === "ALL") {
				return ($key !== "ALL") ? $this->get->$key : (object)$this->get;
			} else {
				return null;
			}
		}

		public function file($key = "ALL") {
			if(isset($this->file->$key) OR $key === "ALL") {
				return ($key !== "ALL") ? $this->file->$key : (object)$this->file;
			} else {
				return null;
			}
		}

	}