<?php
	Routes::connect("/:controller/bar/:id/",
		array("action"=>"foo"),
		array("id" => "[0-9]+$")
	);

	Routes::connect("/:controller/:action/:id",
		array(),
		array("id" => "[0-9]+$"));
	Routes::connect("/:controller/:action");
	Routes::connect("/:controller");
	Routes::connect("/",array("controller"=>"index"),array("action"=>"index"));