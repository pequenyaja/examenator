<!doctype html>
<html lang="es">

<head>
	<meta charset="utf-8"> </head>

<body>
	<?php

    function connect_to_host($host, $username, $password){
      try{
        $connection = new PDO("mysql:host=$host;", $username, $password);
        return $connection;
      }
      catch(PDOException $e){
        die();
        return NULL;
      }
    }

    function result($connection, $res){
      if($res===FALSE){
        //return "ERROR";
      return $connection->errorInfo()[2];
      }else{
          return TRUE;
      }
    }

     function delete_database($connection, $name_database){
      $sql = "drop database if exists $name_database;";
      $res = $connection->exec($sql);
      return result($connection, $res);
    }

    function create_database($connection, $name_database){
      $sql = "create database if not exists $name_database DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;";
      $res = $connection->exec($sql);
      $err = $connection->errorInfo()[2];
      echo "<h1>$err</h1>";
      return result($connection, $res);
    }

    function use_database($connection, $name_database){
      $sql ="use $name_database;";
      $res = $connection->exec($sql);
      return result($connection, $res);
    }

    function create_table_temas($connection){
      $sql = <<<cadenaSQL
create table Temas(
  id int auto_increment primary key,
  titulo varchar(30) not null,
  titulo_url varchar(50) not null unique
)
cadenaSQL;

    $res = $connection->exec($sql);
    return result($connection, $res);
    }

    function create_table_preguntas($connection){
      $sql = <<<cadenaSQL
create table Preguntas(
  id int auto_increment primary key,
  pregunta varchar(500) not null,
  tema int,
  foreign key(tema) references Temas(id)
)
cadenaSQL;

      $res = $connection->exec($sql);
      return result($connection, $res);
    }

    function create_table_respuestas($connection){
      $sql = <<<cadenaSQL
create table Respuestas(
  id int auto_increment primary key,
  respuesta varchar(500) not null,
  verdadera tinyint(1) not null,
  pregunta int,
  foreign key(pregunta) references Preguntas(id)
)
cadenaSQL;

      $res = $connection->exec($sql);
      return result($connection, $res);
    }

    function create_table_estadisticas($connection){
      $sql = <<<cadenaSQL
create table Estadisticas(
  path varchar(500),
  clicks int
  )
cadenaSQL;

      $res = $connection->exec($sql);
      return result($connection, $res);
    }


    function insert_data_to_temas($connection){
      $sql = <<<cadenaSQL
insert into Temas(titulo, titulo_url)
values  ("Musica","music"),
        ("Historia", "history"),
        ("Geografía","geografy"),
        ("Mundo animal","zoo"),
        ("Cine", "film"),
        ("Medicina", "medicine"),
        ("Leteratura", "literature");
cadenaSQL;
        $res = $connection->exec($sql);
        return result($connection, $res);
    }

    function insert_data_to_preguntas($connection){
      $sql = <<<cadenaSQL
insert into Preguntas(pregunta, tema)
values  ('A qué grupo asociarás "Quadrophenia"?', 1),
        ('En qué país nació Mozart?', 1),
        ("Quien era el jefe de las SS que arrebató el poder de la Gestapo a Goering?", 2),
        ("En qué año tuvo lugar el Martes Negro de la economía de Rusia?", 2),
        ("En qué océano o mar estarías si estuvieses en Cerdeña?", 3),
        ("Con qué provincia limita Huelva por el sudeste?", 3),
        ("Con qué dos países limita Moldavia?", 3),
        ('De qué género es la peli "Asesinato en el Orient Express"?', 5),
        ('En qué parte del cuerpo humano se producen los glóbulos rojos?', 6),
        ('Los murciélagos son animales sin el sentido de ...', 4),
        ('Qué concilio se convoca en "El Señor de los Anillos?"',7)

cadenaSQL;
        $res = $connection->exec($sql);
        return result($connection, $res);
    }

    function insert_data_to_respuestas($connection){
      $sql = <<<cadenaSQL
insert into Respuestas(respuesta, verdadera, pregunta)
values  ("Metallica", 0, 1),
        ("The Who", 1, 1),
        ("Linkin Park", 0, 1),
        ("AC/DC", 0, 1),
        ("Suiza", 0, 2),
        ("Hungría", 0, 2),
        ("Alemania", 0, 2),
        ("Austria", 1, 2),
        ("Hess", 0, 3),
        ("Himmler", 1, 3),
        ("Romel", 0, 3),
        ("Hitler", 0, 3),
        ("2014", 0, 4),
        ("1991", 0, 4),
        ("1989", 0, 4),
        ("1998", 1, 4),
        ("Mar Muerto", 0, 5),
        ("Mar Caspio", 0, 5),
        ("Mar Mediterráneo", 1, 5),
        ("Océano Atlantico", 0, 5),
        ("Cádiz", 1, 6),
        ("Málaga", 0, 6),
        ("Sevilla", 0, 6),
        ("Ciudad Real", 0, 6),
        ("Bulgaria y Rumanía", 0, 7),
        ("Rumanía y Ucrania", 1, 7),
        ("Rumanía y Hunría", 0, 7),
        ("Polonia y Ucrania", 0, 7),
        ("Drama", 0, 8),
        ("Comedia", 0, 8),
        ("Suspense", 1, 8),
        ("Terror", 0, 8),
        ("Corazón", 0, 9),
        ("Médula espinal", 0, 9),
        ("Médula ósea", 1, 9),
        ("Pulmones", 0, 9),
        ("El olfato", 0, 10),
        ("El oído", 0, 10),
        ("La vista", 1, 10),
        ("El gusto", 0, 10),
        ("El Concilio de Elrond", 1, 11),
        ("El Concilio de Gandalf", 0, 11),
        ("El Concilio de Mágico", 0, 11),
        ("El Concilio del Anillo", 0, 11)

cadenaSQL;
        $res = $connection->exec($sql);
        return result($connection, $res);
    }

      try {
        $connection = connect_to_host("localhost", "root", "");
        delete_database($connection, "examenator");
        create_database($connection, "examenator");
        use_database($connection, "examenator");
        create_table_temas($connection);
        create_table_preguntas($connection);
				create_table_respuestas($connection);
				create_table_estadisticas($connection);
        insert_data_to_temas($connection);
        insert_data_to_preguntas($connection);
        insert_data_to_respuestas($connection);
      } catch (Exception $e) {
        echo $e.getMessage();
      }
      ?> </body>

</html>
