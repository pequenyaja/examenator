<?php error_reporting(E_ALL); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Add Question</title>
  </head>
  
  <body>
  <h1>Añadir nuevo artículo</h1>
  <form action="" method="POST">
    <label for="pregunta">Pregunta: </label><br>
    <textarea name="pregunta" rows="15" cols="100"></textarea><br>
    
    <label for="respuesta1">Respuesta 1: </label>
    <input type="text" name="respuesta1" placeholder="Posible respuesta 1" required/>
    <input type="radio" name="verdadera" value="1"/><br>
    
    <label for="respuesta2">Respuesta 2: </label>
    <input type="text" name="respuesta2" placeholder="Posible respuesta 2" required/>
    <input type="radio" name="verdadera" value="2"/><br>
    
    <label for="respuesta3">Respuesta 3: </label>
    <input type="text" name="respuesta3" placeholder="Posible respuesta 3" required/>
    <input type="radio" name="verdadera" value="3"/><br>
    
    <label for="respuesta4">Respuesta 4: </label>
    <input type="text" name="respuesta4" placeholder="Posible respuesta 4" required/>
    <input type="radio" name="verdadera" value="4"/><br>
    
    <label for="tema">Tema: </label>
    <select name="tema" required>
    <?php
      echo '<option value="">- Select theme -</option>';
      foreach ($data["themes"] as $themes) {
        echo '<option value="'.$themes["id"].'">'.$themes["titulo"].'</option>';
      }
    ?>
    </select><br>
    
    <input type="submit" name="add" value="Add"/><br><br>
  </form>
  <body>
</html>