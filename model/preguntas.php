<?php
class Preguntas{
    private $con;

    public function __construct(){
        $this->con = new PDO("mysql:host=localhost;dbname=examenator", "root");
        $this->con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function getTemas(){
        $sql = "SELECT * FROM Temas;";
        $res = $this->con->query($sql);
        return $res->fetchAll();
    }

    public function getPreguntas($titleURL){
        $sql = <<<sql
        SELECT pregunta, tema
        FROM Preguntas
        JOIN LEFT Temas ON titulo_url='${titleURL}';";
sql;
        $res = $this->con->query($sql);
        return $res->fetch();
    }


    public function getAnswers($titleURL){
        $sql = <<<sql
        SELECT pregunta, tema
        FROM Preguntas
        JOIN LEFT Temas ON titulo_url='${titleURL}';";
sql;
        $res = $this->con->query($sql);
        return $res->fetch();
    }


    public function getRightAnswer($titleURL){
        $sql = <<<sql
        SELECT pregunta, tema
        FROM Preguntas
        JOIN LEFT Temas ON titulo_url='${titleURL}';";
sql;
        $res = $this->con->query($sql);
        return $res->fetch();
    }
}
?>
