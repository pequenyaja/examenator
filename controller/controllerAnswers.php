<?php error_reporting(E_ALL); ?>
<?php
class Answers{
    private $c;

    public function __construct(Interop\Container\ContainerInterface $ci){
        $this->c = $ci;
    }

    public function evaluateAnswer($request, $response, $args){
      $datos['url_base'] = $this->c->urlbase;
      $con = $this->connect_to_database("localhost", "examenator", "root", "");
      
      $sql="SELECT pr.*  
FROM Preguntas pr
LEFT JOIN Temas te ON te.id=pr.tema
WHERE te.titulo_url = '${args['name_theme']}';";
      $result = $con->query($sql);
      $questions=$result->fetchAll();
      
      $sql="SELECT *  
FROM Respuestas
WHERE id = ".$_POST['answerIdSelected'].";";
      $result = $con->query($sql);
      $datos['right_answer'] = $result->fetchAll()[0];
      if(count($questions)>$args['questionPosition']){
        $datos['nextQuestion']=$datos['url_base']."/index.php/themes/".$args['name_theme']."/question/".($args['questionPosition']+1);
      }
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
