<?php
/**
 * Image 2011/04/15
 * Copyright (C) Naoyuki Kataoka.
 * http://twitter.com/katty0324/
 * Modified kohei kinoshita
 * All Image to Jpeg
 */
class Image {

	private $image;
	private $width;
	private $height;
	private $name;

	public function __construct($file) {
		$this->name = $file;
		$func = 'imagecreatefromjpeg';
		$this->image = $func($file);
		$this->width = imagesx($this->image);
		$this->height = imagesy($this->image);
		return $this;
	}

	public function Resize($width, $height, $bgcolor = 0x000000) {
		$ratio = min($width / $this->width, $height / $this->height);
		return $this->__Resize($width, $height, $ratio, $bgcolor);
	}

	public function Crop($width, $height) {
		$ratio = max($width / $this->width, $height / $this->height);
		return $this->__Resize($width, $height, $ratio);
	}

	public function Output() {
		header('Content-Type: image/jpeg');
		$func = 'imagejpeg';
		$func($this->image);
		return $this;
	}

	public function Save($name = null,$quality = 100) {
		if (is_null($name))
			$name = $this->name;
		$func = 'imagejpeg';
		$func($this->image, $name, $quality);
		return $this;
	}

	public function Frame($color = 0x000000 ) {
		return $this->Rectangle(0, 0, $this->width - 1, $this->height - 1, $color);
	}

	public function Rectangle($x1, $y1, $x2, $y2, $color = 0x000000 ) {
		imagerectangle($this->image, $x1, $y1, $x2, $y2, $color);
		return $this;
	}

	private function __Resize($width, $height, $ratio, $bgcolor = 0x000000 ) {
		$new = imagecreatetruecolor($width, $height);
		imagefill($new, 0, 0, $bgcolor);
		$dst_width = $this->width * $ratio;
		$dst_height = $this->height * $ratio;
		$dst_x = ($width - $dst_width) / 2;
		$dst_y = ($height - $dst_height) / 2;
		imagecopyresampled($new, $this->image, $dst_x, $dst_y, 0, 0, $dst_width, $dst_height, $this->width, $this->height);
		$this->image = $new;
		$this->width = $width;
		$this->height = $height;
		return $this;
	}

}
