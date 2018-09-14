<?php

//inicar sessao
session_start();

require_once "vendor/autoload.php";

use \Hcode\Model\User;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Slim\Slim;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function () {

	$page = new Page();

	$page->setTpl("index");

});

$app->get('/admin', function () {

	//validar se existe a sessao
	User::verifiyLogin();

	$page = new PageAdmin();

	$page->setTpl("index");

});

$app->get('/admin/login', function () {

	$page = new PageAdmin([
		"header" => false,
		"footer" => false,
	]);

	$page->setTpl("login");

});

$app->post('/admin/login', function () {

	User::login($_POST["login"], $_POST["password"]);

	header("Location: /admin");

	exit;

});

$app->get('/admin/logout', function () {

	User::logout();

	header("Location: /admin/login");
	exit;

});

$app->get("/admin/users", function () {

	User::verifiyLogin();

	$users = User::listAll();

	$page = new PageAdmin();

	$page->setTpl("users", array(

		"users"=>$users
	));

});

$app->get("/admin/users/create", function () {

	User::verifiyLogin();

	$page = new PageAdmin();

	$page->setTpl("users-create");

});

$app->get("/admin/users/:iduser/delete", function ($iduser) {

	User::verifiyLogin();

});

$app->get("/admin/users/:iduser", function ($iduser) {

	User::verifiyLogin();

	$page = new PageAdmin();

	$page->setTpl("users-update");

});

$app->post("/admin/users/create", function () {

	User::verifiyLogin();
		
	$user = new User();
	
	$user->setData($_POST);

});

$app->post("/admin/users/:iduser", function ($iduser) {

	User::verifiyLogin();

});

$app->run();

?>