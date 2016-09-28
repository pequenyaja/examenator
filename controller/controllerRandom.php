<?php error_reporting(E_ALL); ?>
<?php
class Random{
    private $c;

    public function __construct(Interop\Container\ContainerInterface $ci){
        $this->c = $ci;
    }

    public function startRandom($request, $response, $args){
      $datos['url_base'] = $this->c->urlbase;
      $con = $this->connect_to_database("localhost", "examenator", "root", "");
      
      $result = $con->query("SELECT * FROM Preguntas ORDER BY Rand() LIMIT 1;");
      $datos['question'] = $result->fetchAll()[0];
      
      $sql="SELECT *  
FROM Respuestas re
WHERE re.pregunta = ".$datos['question']['id'].";";
      $result = $con->query($sql);
      $datos['answers'] = $result->fetchAll();
      
      $datos['actionForm']=$datos['url_base']."/index.php/random/question/check";
      
      $datos['nextQuestion']=$datos['url_base']."/index.php/random";
      
      $response = $this->c->view->render($response, "question.php", $datos);
      return $response;
    }
    
   public function evaluateAnswer($request, $response, $args){
      $datos['url_base'] = $this->c->urlbase;
      $con = $this->connect_to_database("localhost", "examenator", "root", "");
      
      $sql="SELECT *  
FROM Respuestas
WHERE id = ".$_POST['answerIdSelected'].";";
      $result = $con->query($sql);
      
      $datos['right_answer'] = $result->fetchAll()[0];
      $datos['nextQuestion']=$datos['url_base']."/index.php/random";
      
      $response = $this->c->view->render($response, "right_answer.php", $datos);
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
