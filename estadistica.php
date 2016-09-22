<<?php 
class Estadistica {
  public function __invoke ($request, $response, $next)
  {

    return $next ($request, $response);
  }

 ?>
