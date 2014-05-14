<?php
	class Config {
		protected $config;
		public function __construct($config) {
			$this->config = parse_ini_file(CONFIG_DIR.$config.".ini",TRUE);
		}

		public function get($key) {
			return $this->config[$key];
		}

		public function __destruct() {
			$this->config = NULL;
		}
	}