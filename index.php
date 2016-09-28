<?php
<<<<<<< HEAD
require "vendor/autoload.php";
require "controller/controller.php";
require "controller/controllerThemes.php";
require "controller/controllerQuestions.php";
require "controller/controllerAnswers.php";
require "controller/controllerRandom.php";
require "middleware/statistics.php";

$app = new Slim\App();

//Dependencias
$c = $app->getContainer();
$c['view'] =new Slim\Views\PhpRenderer('view/');
$c['urlbase']=str_replace("/index.php","",$c->get('request')->getUri()->getBasePath());

$auth = new Slim\Middleware\HttpBasicAuthentication([
  "users" => [
    "admin" => "admin",
    "rodolfo" => "contraseñaderodolfo"
  ]
]);

$app->add(new Slim\Middleware\SafeURLMiddleware());
$app->add(new Statistics());

//URLs
$app->get ("/", "\Controller:home");
$app->get("/themes", "\Themes:showThemes");
$app->get("/themes/{name_theme}", "\Themes:startTheme");
$app->get("/themes/{name_theme}/question/{questionPosition}", "\Questions:getQuestion");
$app->post("/themes/{name_theme}/question/{questionPosition}/check", "\Answers:evaluateAnswer");
$app->get("/random", "\Random:startRandom");
$app->post("/random/question/check", "\Random:evaluateAnswer");
$app->get("/statistics", "\Controller:getStatistics");
$app->get("/question/new", "\Controller:newQuestion")->add($auth);
$app->post("/question/new", "\Controller:createQuestion")->add($auth);
$app->run();
?>
=======
  require "vendor/autoload.php";
    $app = new Slim\App();

    $app->get('/', function($request, $response, $args){
        $response->write("<h1>Hola Git! Si no funcionas bien, te desinstalo!!!</h1>");
        return $response;
  });

  $app->run();
 ?>
>>>>>>> 8840f3d2a8dd6de352e92145f7b4bdc15567e17e
