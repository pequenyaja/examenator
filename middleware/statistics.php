<?php
  class Statistics{
    public function __invoke($request, $response, $next){
      $con = $this->connect_to_database("localhost", "examenator", "root", "");

      $path = $request->getUri()->getPath();
      if(strpos($path, "check") || strpos($path, "statistics")) {
        return $next($request, $response);
      }

      $res = $con->query("SELECT clicks FROM Estadisticas WHERE path='$path'");
      $res = $res->fetch();
      if(!$res){
        $con->exec("INSERT INTO Estadisticas(path, clicks) VALUES('$path', 1)");
      }else{
        $clicks = $res['clicks']+1;
        $con->exec("UPDATE Estadisticas SET clicks=$clicks WHERE path='$path';");
      }

      return $next($request, $response);
    }
    
    private function connect_to_database($host, $database_name, $username, $password){
      try{
        $connection = new PDO("mysql:host=$host;dbname=$database_name", $username, $password);
        $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $connection;
      }catch(PDOException $e){
        die();
        return NULL;
      }
    }
  }
?>
