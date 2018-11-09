<?php
 namespace Library\Entities ;

class Professeurs extends \Library\Entities\Personnes
{
    protected $matricule ;
    protected $grade_enseignant ;

    const MESSAGE_ERREUR_MATRICULE = '<span style="color:red">matricule est incorrecte </span>' ;
    const MESSAGE_ERREUR_GRADE = '<span style="color:red">le grade est incorrecte </span>' ;

    public function matricule()
    {
        return $this->matricule ;
    }

    public function grade_enseignant()
    {
        return $this->grade_enseignant ;
    }

    public function setMatricule($val)
    {
        if (!empty($val)) {
            $this->matricule = $val ;
        } else {
            $this->setErreurs(array('matricule' => self::MESSAGE_ERREUR_MATRICULE )) ;
        }
    }

    public function setGrade_enseignant($val)
    {
        if (!empty($val)){
            $this->grade_enseignant = $val ;
        } else {
            $this->setErreurs(array('grade_enseignant' => self::MESSAGE_ERREUR_GRADE )) ;
        }
    }
}
