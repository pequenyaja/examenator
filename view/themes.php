<?php error_reporting(E_ALL); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Te acuerdas de algo?</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?php echo $data["url_base"]?>/view/css/style.css" type="text/css" />
  </head>
  
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo $data['url_base']?>/index.php">Examinator</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo $data['url_base']?>/index.php">Home</a></li>
            <li class="active"><a href="<?php echo $data['url_base']?>/index.php/themes">Elegir un tema</a></li>
            <li><a href="<?php echo $data['url_base']?>/index.php/random">Preguntas aleatorias</a></li>
            <li><a href="<?php echo $data['url_base']?>/index.php/statistics">Statistics</a></li>
          </ul>
        </div>
      </div>
    </nav>
    
    <div class="container">
      <div class="page-header">
        <h1>Te acuerdas de algo?</h1>
      </div>
      
      <main class="text-center">
       <h4>Temas</h4>
        <ol>
          <?php
            foreach($data['themes'] as $themes){
              echo '<a href="../index.php/themes/'.$themes["titulo_url"].'">'.$themes["titulo"].'</a><br/>';
            }
          ?>
        </ol>
      </main>
      
    </div>
    
    <footer class="footer">
      <div class="container">
        <p class="text-muted">All rights reserved | © Copyright 2016 | Alexandra</p>
      </div>
    </footer>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <body>
</html>