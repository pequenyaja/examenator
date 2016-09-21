<?php
require "vendor/autoload.php";
require "controler/controler.php";

$app = new Slim\App();

//Dependencias
$c = $app->getContainer();
$c['view'] =new Slim\Views\PhpRenderer('view/');
$c['urlbase']=str_replace("/index.php","",$c->get('request')->getUri()->getBasePath());

//URLs
$app->get("/question/new", "\Controler:newQuestion");
$app->post("/question/new", "\Controler:createQuestion");
$app->run();
?>
