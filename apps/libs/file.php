<?php
	class File {
		CONST DIR = IMAGE_DIR;
		public function makeDir($dir_name) {
			$path = self::DIR.$dir_name;
			return (mkdir($path,0777,true)) ? TRUE : FALSE;
		}

		public function deleteDir($dir_name) {
			$path = self::DIR.$dir_name;
			$items = new RecursiveIteratorIterator(
				new RecursiveDirectoryIterator($path,RecursiveDirectoryIterator::CURRENT_AS_SELF),
				RecursiveIteratorIterator::CHILD_FIRST
			);
			foreach ($items as $item) {
				if ($item->isFile() || $item->isLink()) {
					if(unlink($item->getPathname()) === FALSE) {
						return FALSE;
					}
				} elseif ($item->isDir() && !$item->isDot()) {
					if(rmdir($item->getPathname()) === FALSE) {
						return FALSE;
					}
				}
			}
			if(rmdir($path) === FALSE) {
				return FALSE;
			} else {
				return TRUE;
			}
		}
		public function deleteFile($file_name) {
			$path = self::DIR.$file_name;
			return @unlink($path);
		}
		public function isFile($file_name) {
			$path = self::DIR.$file_name;
			return is_file($path);
		}

		static function ImageResize($source_path,$save_path,$width = 400, $height = 300,$quality = 100) {
			$image = new Image($source_path);
			$image->Resize($width,$height,0xFFFFFF)->Save($save_path,$quality);
			return is_file($save_path);
		}
	}