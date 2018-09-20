<?php
 namespace Library;

 session_start();

 class User extends ApplicationComponent
 {
    public function getAttribute($attr) //si un attribut existe déja
    {
     return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
    }

    public function getFlash()   //afficher un message informatif sur la page
    {
     $flash = $_SESSION['flash'];
     unset($_SESSION['flash']);
     return $flash;
    }


    public function hasFlash()  //savoir si un message existe déja
    {
     return isset($_SESSION['flash']);
    }

    public function isAuthenticated() //si l'utilisateur est déja autentifié
    {
     return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
    }

    public function setAttribute($attr, $value) //ajouter un attribut
    {
     $_SESSION[$attr] = $value;
    }

    public function setAuthenticated($authenticated = true) //authentifier un utilisateur
    {
       if (!is_bool($authenticated))
       {
         throw new \InvalidArgumentException('La valeur spécifiée à la méthode User::setAuthenticated() doit être un boolean');
       }
       $_SESSION['auth'] = $authenticated;
    }


    public function setFlash($value) //ecrire le message
    {
      $_SESSION['flash'] = $value;
    }

    public function sessionExists($key)
    {
     return isset($_SESSION[$key]) ;
    }

    public function sessionData($key)
    {
     return isset($_SESSION[$key]) ? $_SESSION[$key] :null ;
    }
 }

 ?>
