<?php
 namespace Library\Entities ;

class Dispensees extends \Library\Entity
{
    private $ue = array() ;
    private $semestres_parcour ;
    private $annees_universitaire ;

    const MESSAGE_ERREUR_UE = '<span style="color:red" >valeure des ues incorrecte</span></br>' ;
    const MESSAGE_ERREUR_SEMESTRE = '<span style="color:red" >valeure des semestres incorrectes</span></br>' ;
    const MESSAGE_ERREUR_ANNEE = '<span style="color:red" >année universitaire incorrecte/span></br>' ;
    const ERREUR_UE = 0 ;
    const ERREUR_ANNEE = 1 ;
    const ERREUR_SEMESTRE = 2 ;

    public function ue()
    {
        return $this->ue ;
    }

    public function semestres_parcour()
    {
        return $this->semestres_parcour ;
    }

    public function annees_universitaire()
    {
        return $this->annees_universitaire ;
    }

    public function setUe(array $val)
    {
        if (!empty($val)) {
            $this->ue = array_merge($this->ue, $val) ;
        } else {
            $this->setCustomErrors(self::ERREUR_UE) ;
        }
    }

    public function setSemestres_parcour($val)
    {
        if (!empty($val) and is_numeric($val)) {
            $this->semestres_parcour=$val ;
        } else {
            $this->setCustomErrors(self::ERREUR_SEMESTRE) ;
        }
    }

    public function setAnnees_universitaire($val)
    {
        if (!empty($val) and is_numeric($val)) {
            $this->annees_universitaire=$val ;
        } else {
            $this->setCustomErrors(self::ERREUR_ANNEE) ;
        }
    }
}
