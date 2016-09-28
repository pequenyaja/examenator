<?php error_reporting(E_ALL); ?>
<?php
class Themes{
    private $c;

    public function __construct(Interop\Container\ContainerInterface $ci){
        $this->c = $ci;
    }

    public function showThemes($request, $response, $args){
      $con = $this->connect_to_database("localhost", "examenator", "root", "");
      $result = $con->query("SELECT * FROM Temas;");
      $datos['themes'] = $result->fetchAll();
      $datos['url_base'] = $this->c->urlbase;
      $response = $this->c->view->render($response, "themes.php", $datos);
      return $response;
    }
    
    public function startTheme($request, $response, $args){
      $con = $this->connect_to_database("localhost", "examenator", "root", "");
      $result = $con->query("SELECT * FROM Temas WHERE titulo_url ='".$args['name_theme']."';");
      $datos['theme'] = $result->fetchAll()[0];
      $datos['url_base'] = $this->c->urlbase;
      $response = $this->c->view->render($response, "startTheme.php", $datos);
      return $response;
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
