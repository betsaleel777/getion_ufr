<?php
//PEAR notation respected
  namespace Library ;

  class HTTPRequest extends ApplicationComponent
  {
    public function cookieData($key)
    {
      return isset($_COOKIE[$key]) ? $_COOKIE[$key] :null ;
    }

    public function cookieExists($key):bool
    {
     return isset($_COOKIE[$key]) ;
    }

    public function getData($key)
    {
     return isset($_GET[$key]) ? $_GET[$key] :null ;
    }

    public function getExists($key):bool
    {
      return isset($_GET[$key]) ;
    }

    public function postData($key)
    {
     return isset($_POST[$key]) ? $_POST[$key] :null ;
    }

    public function postExists($key):bool
    {
     return isset($_POST[$key]) ;
    }

    public function method()
    {
      return $_SERVER['REQUEST_METHOD'] ;
    }

    public function requestURI()
    {
     return $_SERVER['REQUEST_URI'] ;
    }

    public function sessionExists($key)
    {
     return isset($_SESSION[$key]) ;
    }

    public function sessionData($key)
    {
     return isset($_SESSION[$key]) ? $_SESSION[$key] :null ;
    }

    public function getToken(){
       return isset($_SESSION['token']) ? $_SESSION['token'] :null ;
    }

    public function authenticForm(string $token)
    {
      return ($retour = ($token == $_SESSION['token'])) ? $retour : null ;
    }


}



?>
