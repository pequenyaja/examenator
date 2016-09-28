<?php error_reporting(E_ALL); ?>
<?php
class Controller{
    private $c;

    public function __construct(Interop\Container\ContainerInterface $ci){
        $this->c = $ci;
    }

    public function home($request, $response, $args){
      $datos['url_base'] = $this->c->urlbase;
      $response = $this->c->view->render($response, "home.php", $datos);
      return $response;
    }
    
    public function getStatistics($request, $response, $args){
      $datos['url_base'] = $this->c->urlbase;
      $con = $this->connect_to_database("localhost", "examenator", "root", "");
      $result = $con->query("SELECT * FROM Estadisticas;");
      $datos['statistics'] = $result->fetchAll();
      $response = $this->c->view->render($response, "statistics.php", $datos);
      return $response;
    }

    public function newQuestion($request, $response, $args){
      $con = $this->connect_to_database("localhost", "examenator", "root", "");
      $result = $con->query("SELECT * FROM Temas;");
      $datos['themes'] = $result->fetchAll();
      $response = $this->c->view->render($response, "new_question.php", $datos);
      return $response;
    }

    public function createQuestion($request, $response, $args){
      $con = $this->connect_to_database("localhost", "examenator", "root", "");
      $value = $con->quote($_POST["pregunta"]);
      $value2 = $con->quote($_POST["tema"]);
      $new_question="INSERT INTO Preguntas (pregunta, tema) VALUES ($value, $value2);";
      $result = $con->exec($new_question);
      $questionId = $con->lastInsertId();

      if ($_POST["verdadera"] == "1") {
        $verdadera = 1;
      } else {
        $verdadera = 0;
      }

      $answer1 = $con->quote($_POST["respuesta1"]);
      $new_answer="INSERT INTO Respuestas (respuesta, pregunta, verdadera) VALUES ($answer1, $questionId, $verdadera);";
      $result = $con->exec($new_answer);

      if ($_POST["verdadera"] == "2") {
        $verdadera = 1;
      } else {
        $verdadera = 0;
      }

      $answer2 = $con->quote($_POST["respuesta2"]);
      $new_answer="INSERT INTO Respuestas (respuesta, pregunta, verdadera) VALUES ($answer2, $questionId, $verdadera);";
      $result = $con->exec($new_answer);

      if ($_POST["verdadera"] == "3") {
        $verdadera = 1;
      } else {
        $verdadera = 0;
      }

      $answer3 = $con->quote($_POST["respuesta3"]);
      $new_answer="INSERT INTO Respuestas (respuesta, pregunta, verdadera) VALUES ($answer3, $questionId, $verdadera);";
      $result = $con->exec($new_answer);

      if ($_POST["verdadera"] == "4") {
        $verdadera = 1;
      } else {
        $verdadera = 0;
      }

      $answer4 = $con->quote($_POST["respuesta4"]);
      $new_answer="INSERT INTO Respuestas (respuesta, pregunta, verdadera) VALUES ($answer4, $questionId, $verdadera);";
      $result = $con->exec($new_answer);

      $datos=[];
      $response = $this->c->view->render($response, "saved_question.php", $datos);
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
