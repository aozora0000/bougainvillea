<?php
	header("Content-type: text/html; charset=UTF-8");
	mb_language("Japanese");
	mb_internal_encoding("UTF-8");

	//Dir Config
	define("ROOT_DIR",		dirname(__FILE__)."/../");
	define("PUBLISH_DIR",	ROOT_DIR."htdocs/");
	define("APPS_DIR",		ROOT_DIR."apps/");
	define("LIBS_DIR",		APPS_DIR."libs/");
	define("MODEL_DIR",		APPS_DIR."model/");
	define("CTRL_DIR",		APPS_DIR."controller/");
	define("CONFIG_DIR",	APPS_DIR."config/");
	define("VALIDATE_DIR",	APPS_DIR."validate/");

	//Smarty Dir Config
	define("SMARTY_DIR",LIBS_DIR."smarty/");
	define("SMARTY_CONPILE_DIR",APPS_DIR."tpl_c/");
	define("SMARTY_TEMPLATE_DIR",APPS_DIR."templates/");

	//Include Script
	include_once LIBS_DIR."bootstrap.php";
	include_once SMARTY_DIR."Smarty.class.php";
	include_once LIBS_DIR."controller.php";
	include_once LIBS_DIR."model.php";
	include_once LIBS_DIR."idiorm.php";
	include_once LIBS_DIR."request.php";
	include_once LIBS_DIR."session.php";
	include_once LIBS_DIR."config.php";
	include_once LIBS_DIR."validate.php";
	include_once LIBS_DIR."cast.php";
	include_once LIBS_DIR."file.php";
	include_once LIBS_DIR."image.php";
	include_once LIBS_DIR."url.php";
	include_once LIBS_DIR."route.php";
	include_once CONFIG_DIR."routing.php";

	//execute controller
	$_GET = array_merge($_GET,Routes::getRoute($_SERVER["REQUEST_URI"]));
	unset($_GET["url"]);
	$bootstrap = new BootStrap;
	$bootstrap->execute($_GET["controller"],$_GET["action"]);