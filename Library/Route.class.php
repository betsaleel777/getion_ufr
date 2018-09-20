<?php
//respect PEAR notation
   namespace Library ;

   class Route
   {
     protected $action,
               $url,
               $module,
               $variables = array(),
               $variableNom ;

    public function __construct($url,$action,$module,$var)
    {
      $this->setUrl($url) ;
      $this->setAction($action) ;
      $this->setModule($module)  ;
      $this->setVariableNom($var) ;
    }

    //getter
    public function action(){ return (string)$this->action ; }
    public function url(){ return (string)$this->url ; }
    public function module(){ return (string)$this->module ; }
    public function variableNom(){ return $this->variableNom ; }
    public function variables(){ return $this->variables ; }

    //setter
    public function setUrl($url){
      if(!empty($url) AND is_string($url))
      {
        $this->url = $url ;
      }
    }

    public function setAction($action){
      if(!empty($action) AND is_string($action))
      {
        $this->action = $action ;
      }
    }

    public function setModule($module){
      if(!empty($module) AND is_string($module))
      {
        $this->module = $module ;
      }
    }

    public function setVariables($variables){
      if(is_array($variables))
      {
        $this->variables = $variables ;
      }
    }

    public function setVariableNom($variableNom){
      if(is_array($variableNom))
      {
        $this->variableNom = $variableNom ;
      }
    }

    public function possedeVariable()
    {
      return !empty($this->variableNom) ;
    }

    public function match($url)
    {
      if(preg_match('#^'.$this->url.'$#',$url,$matches))
      {
        return $matches ;
      }
      else {
        return false ;
      }
    }


   }


 ?>
