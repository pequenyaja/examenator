<?php
require "vendor/autoload.php";
require "controler/controler.php";


$app = new Slim\App();

//Dependencias
$c = $app->getContainer();
$c['view'] =new Slim\Views\PhpRenderer('view/');
$c['urlbase']=str_replace("/index.php","",$c->get('request')->getUri()->getBasePath());

//Middlewares
/*1.
$app->add(new \slim\Middleware\HttpBasicAutentication([*/
//2.
$auth = new Slim\Middleware\HttpBasicAuthentication([
  "users" => [
    "admin"=>"admin",
    "adolfo" => "contraseñadeadolfo"
  ]
  //, 1. "path"=>"/question/new"
]);

$app->add(new Slim\Middleware\SafeURLMiddleware());

//URLs
$app->get("/question/new", "\Controler:newQuestion")->add($auth);
$app->post("/question/new", "\Controler:createQuestion")->add($auth);
$app->run();
?>
