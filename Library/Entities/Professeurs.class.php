<?php
 namespace Library\Entities ;

class Professeurs extends \Library\Entities\Personnes
{
    protected $matricule ;

    const MESSAGE_ERREUR_MATRICULE = '<span style="color:red">matricule est incorrecte </span>' ;

    public function matricule()
    {
        return $this->matricule ;
    }

    public function setMatricule($val)
    {
        if (!empty($val)) {
            $this->matricule = $val ;
        } else {
            $this->setErreurs(array('matricule' => self::MESSAGE_ERREUR_MATRICULE )) ;
        }
    }
}
