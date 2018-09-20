<?php
//PEAR notation respected ;
  namespace Library ;

  abstract class Application
  {
    protected $httpResponse,
              $httpRequest,
              $name,
              $error,
              $user;

    public function __construct()
    {
      $this->httpRequest = new HTTPRequest($this) ;
      $this->httpResponse = new HTTPResponse($this) ;
      $this->error = new Error($this) ;
      $this->name = '' ;
      $this->user = new User($this) ;
    }

    //getters
    public function user():User
    {
      return $this->user ;
    }
    public function httpRequest():HTTPRequest
    {
     return $this->httpRequest ;
    }

    public function httpResponse():HTTPResponse
    {
     return $this->httpResponse ;
    }
    public function error():Error
    {
      return $this->error ;
    }

    public function name():string
    {
     return $this->name ;
    }

    abstract public function run() ;

    public function getControllers()
    {
      $router = new \Library\Router ;
      $xml = new \DOMDocument ;
      $xml->load(__DIR__.'/../Applications/'.$this->name().'/Config/routes.xml') ;

      $routes = $xml->getElementsByTagName('route') ;

      /*chaque route xml récupérée est parsée pour faire un objet Route qui est ensuite ajouté au tableau des routes
      contenues dans la classe Router nous vérifions la présence de variable dans le xml  */
      foreach ($routes as $route) {

        $variable = array();

        if($route->hasAttribute('vars'))
        {
          //on forme le tableau variables à partir de la liste des variables contenu dans l'attribut vars de chaque routes
          $variable = explode(',',$route->getAttribute('vars')) ;

        }
        //ajoutons la route au routeur
         $router->addRoute(new Route($route->getAttribute('url'),$route->getAttribute('action'),$route->getAttribute('module'),$variable)) ;
        }

        try
        {
          $matchedRoute = $router->getRoute($this->httpRequest->requestURI()) ;
        }
        catch (\RuntimeException $e)
        {
          if($e->getCode() == \Library\Router::NO_ROUTE)
          {
            $this->httpResponse->redirect404() ;
          }

        }

        $_GET = array_merge($_GET,$matchedRoute->variables()) ;

        $controllerClass = 'Applications\\'.$this->name.'\\Modules\\'.$matchedRoute->module().'\\'.$matchedRoute->module().'Controller';

        return new $controllerClass($this,$matchedRoute->module(),$matchedRoute->action()) ;

    }


  }




 ?>
