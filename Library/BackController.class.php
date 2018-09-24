<?php

namespace Library ;

abstract class BackController extends ApplicationComponent
{
    protected $action = '';
    protected $module = '';
    protected $page = null;
    protected $view = '';
    protected $managers ;

    public function __construct(Application $app, $module, $action)
    {
        parent::__construct($app) ;
        $this->managers = new Managers('Pdo', PdoFactory::getConnexion()) ;
        $this->module = $module ;
        $this->page = new Page($app) ;
        $this->action = $action ;
    }

    //getters
    public function managers(){
      return $this->managers ;
    }
    public function module():string
    {
        return $this->module ;
    }

    public function action():string
    {
        return $this->action ;
    }


    public function view():string
    {
        return $this->view ;
    }

    public function execute()
    {
        $method = 'execute'.ucfirst($this->action) ;
        $object = $this->module.'Controller' ;

        if (!is_callable($object, $method)) {
            throw new \RuntimeException('l\'action '.$this->action.' n\'est pas définie sur ce module');
        }
        $this->$method($this->app->httpRequest()) ;
    }

    public function page()
    {
        return $this->page;
    }

    public function setModule($module)
    {
        if (!is_string($module) || empty($module)) {
            throw new \InvalidArgumentException('Le module doit être une chaine de caractères valide');
        }
        $this->module = $module;
    }

    public function setAction($action)
    {
        if (!is_string($action) || empty($action)) {
            throw new \InvalidArgumentException('L\'action doit être une chaine de caractères valide');
        }
        $this->action = $action;
    }

    public function setView($view)
    {
        if (!is_string($view) || empty($view)) {
            throw new \InvalidArgumentException('La vue doit être une chaine de caractères valide');
        }
        $this->view = $view;
        $this->page->setContentFile(__DIR__.'/../Applications/'.$this->app->name().'/Modules/'.$this->module.'/Views/'.$this->view.'.php');
    }

    public function textNotify($alerte, $message)
    {
        if ($alerte == 'info') {
            return $texte ='<span id="message">'.$message.'</span>
                      <span id="animIn">fadeInRight</span>
                      <span id="animOut">fadeOut</span>
                      <span id="color">#31708f</span>
                      <span id="alert">'.$alerte.'</span>' ;
        } elseif ($alerte == 'success') {
            return $texte ='<span id="message">'.$message.'</span>
                       <span id="animIn">flipInX</span>
                       <span id="animOut">flipInY</span>
                       <span id="color">#3c763d</span>
                       <span id="alert">'.$alerte.'</span>' ;
        } elseif ($alerte == 'danger') {
            return $texte ='<span id="message">'.$message.'</span>
                       <span id="animIn">zoomDown</span>
                       <span id="animOut">zoomOut</span>
                       <span id="color">#a94442</span>
                       <span id="alert">'.$alerte.'</span>' ;
        } elseif ($alerte == 'warning') {
            return $texte ='<span id="message">'.$message.'</span>
                       <span id="animIn">shake</span>
                       <span id="animOut">bounceOut</span>
                       <span id="color">#31708f</span>
                       <span id="alert">'.$alerte.'</span>' ;
        }
    }

    public function processForm(\Library\HTTPRequest $request,$object){
      if($request->method() == 'POST'){
        $post = filter_input_array(INPUT_POST) ;
        if($request->authenticForm($post['uniqid']))
        {
          $linkObject = '\Library\Entities\\'.$object;
          $localObject = new $linkObject($post) ;
          if($request->getExists('id')){
            $localObject->setId($request->getdata('id'));
          }

          if($localObject->isValid())
          {
            $this->managers->getManagerOf($object)->save($localObject);
            $link = lcfirst($this->module()).'.html';
            $this->app->httpResponse()->redirect($link) ;
          }
          else{
            return $localObject ;
          }
        }
      }
    }
}
