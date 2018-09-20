<?php

/*cette classe existe pour permettre aux controleur d'instancier des manager lié à leur module plus
   plus facilement */
//respect PEAR notation
  namespace Library ;

class Managers
{
    protected $dao = null;
    protected $api = null;
    protected $manager = array() ;

    public function __construct($api, $dao)
    {
        $this->dao = $dao ;
        $this->api = $api ;
    }

    public function dao(){
      return $this->dao ;
    }

    public function getManagerOf($module)
    {
        if (!is_string($module) or empty($module)) {
            throw new \InvalidArgumentExeption('le module spécifié est invalide') ;
        } else {
            if (!isset($manager[$module])) {
                $manager = '\\Library\\Models\\'.$module.'Manager'.$this->api ;
                $this->manager[$module] = new $manager($this->dao) ;
                return $this->manager[$module] ;
            }
        }
    }
}
