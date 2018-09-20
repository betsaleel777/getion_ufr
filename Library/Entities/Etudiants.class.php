<?php

namespace Library\Entities ;

class Etudiants extends Personnes
{
  private $numero_carte ;
  private $numero_bac ;

  const MESSAGE_ERREUR_CARTE ='<span style="color:red" >le champ numero_carte n\'est pas valide ,veuillez renseignez une valeur</span>' ;
  const MESSAGE_ERREUR_BAC ='<span style="color:red">le champ numero_bac est incorrecte ,veuillez renseignez une valeur</span>' ;

    //accesseurs
    public function numero_carte()
    {
        return $this->numero_carte ;
    }
    public function numero_bac()
    {
        return $this->numero_bac ;
    }
    //setter
    public function setNumero_carte($val)
    {   if(!empty($val)){
         $this->numero_carte = $val ;
       }else {
         $this->setErreurs(array('numero_carte' => self::MESSAGE_ERREUR_CARTE)) ;
       }
    }
    public function setNumero_bac($val)
    {
        if(!empty($val)){
          $this->numero_bac = $val ;
        }else {
          $this->setErreurs(array('numero_bac' => self::MESSAGE_ERREUR_BAC)) ;
        }
    }
}
