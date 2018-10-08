<?php
  namespace Library ;

  abstract class Entity
  {
    protected $id;
    protected $erreurs = array();
    protected $customErreurs = array() ;

    public function __construct(array $donnees = array())
    {
      if(!empty($donnees))
      {
        $this->hydrate($donnees) ;
      }
    }

    public function id(){ return $this->id ;}

    public function setId($val){
      if(ctype_digit($val))
       {
        $this->id = $val ;
       }
    }

    public function isValid():bool
    {
     return empty($this->erreurs) ;
    }

    public function isValid1():bool
    {
     return empty($this->customErreurs) ;
    }

    public function isNew():bool
    {
      return empty($this->id) ;
    }

    public function erreurs():array
    {
      return $this->erreurs ;
    }

    public function customErreurs():array
    {
      return $this->customErreurs ;
    }

    public function setErreurs(array $val)
    {
      $this->erreurs = array_merge($this->erreurs,$val) ;
    }

    public function setCustomErrors(string $val)
    {
      $this->customErreurs[] = $val ;
    }

    //hydratation
    public function hydrate(array $donnees)
    {
       foreach ($donnees as $key => $value)
        {
         // On récupère le nom du setter correspondant à l'attribut.
         $method = 'set'.ucfirst($key);
         // Si le setter correspondant existe.
         if (method_exists($this, $method))
          {
           // On appelle le setter.
           $this->$method($value);
          }
        }
    }
}

 ?>
