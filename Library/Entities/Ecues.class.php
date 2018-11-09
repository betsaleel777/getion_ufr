<?php
 namespace Library\Entities ;

class Ecues extends \Library\Entity
{
    private $nom ;
    private $code_ecue ;
    private $credits ;
    private $tp ;
    private $td ;
    private $cm ;
    private $ue ;
    private $tpe ;
    private $projet ;

    const MESSAGE_ERREUR_NOM ='<span style="color:red">le nom de l\'ecue est incorrecte</span>' ;
    const MESSAGE_ERREUR_CREDIT = '<span style="color:red">le nombre de crédit incorrecte</span>' ;
    const MESSAGE_ERREUR_UE = '<span style="color:red">aucune ue selectionée</span>' ;
    const MESSAGE_ERREUR_TPE = '<span style="color:red">tpe incorrecte</span>' ;
    const MESSAGE_ERREUR_PROJET = '<span style="color:red">projet incorrecte</span>' ;
    const ERREUR_UE = 0 ;
    const ERREUR_NOM = 1 ;
    const ERREUR_CREDIT = 2 ;
    const ERREUR_CM = 3 ;
    const ERREUR_TD = 4 ;
    const ERREUR_TP = 5 ;
    const ERREUR_TPE = 6 ;
    const ERREUR_PROJET = 7 ;
    const ERREUR_CODE = 8 ;

    public function nom()
    {
        return $this->nom ;
    }
    public function cm()
    {
        return $this->cm ;
    }
    public function td()
    {
        return $this->td ;
    }
    public function tp()
    {
        return $this->tp ;
    }
    public function credits()
    {
        return $this->credits ;
    }
    public function code_ecue()
    {
        return $this->code_ecue ;
    }
    public function ue()
    {
        return $this->ue ;
    }
    public function tpe(){
      return $this->tpe ;
    }
    public function projet(){
      return $this->projet ;
    }

    public function setNom($val)
    {
        if (!empty($val) and strlen($val)<=80) {
            $this->nom = $val ;
        } else {
            //  $this->setErreurs(array('nom' => self::MESSAGE_ERREUR_NOM)) ;
            $this->setCustomErrors(self::ERREUR_NOM) ;
        }
    }
    public function setCm($val)
    {
        if (is_numeric($val)) {
            $this->cm = $val ;
        } else {
            //  $this->setErreurs(array('nom' => self::MESSAGE_ERREUR_NOM)) ;
            $this->setCustomErrors(self::ERREUR_CM) ;
        }
    }
    public function setTp($val)
    {
        if (is_numeric($val)) {
            $this->tp = $val ;
        } else {
            //  $this->setErreurs(array('nom' => self::MESSAGE_ERREUR_NOM)) ;
            $this->setCustomErrors(self::ERREUR_TP) ;
        }
    }
    public function setTd($val)
    {
        if (is_numeric($val)) {
            $this->td = $val ;
        } else {
            //this->setErreurs(array('nom' => self::MESSAGE_ERREUR_NOM)) ;
            $this->setCustomErrors(self::ERREUR_TD) ;
        }
    }
    public function setCredits($val)
    {
        if (!empty($val) and strlen($val)<=2) {
            $this->credits = $val ;
        } else {
            //  $this->setErreurs(array('credits' => self::MESSAGE_ERREUR_CREDIT)) ;
            $this->setCustomErrors(self::ERREUR_CREDIT) ;
        }
    }
    public function setUe($val)
    {
        $val = (int)$val ;
        if (!empty($val)) {
            $this->ue = $val ;
        } else {
            // $this->setErreurs(array('ue' => self::MESSAGE_ERREUR_UE)) ;
            $this->setCustomErrors(self::ERREUR_UE) ;
        }
    }
    public function setProjet($val){
      if(\is_numeric($val)){
        $this->projet = $val ;
      }else {
        $this->setCustomErrors(self::ERREUR_PROJET) ;
      }
    }
    public function setTpe($val){
      if(\is_numeric($val)){
        $this->tpe = $val ;
      }else {
        $this->setCustomErrors(self::ERREUR_TPE) ;
      }
    }
    public function setCode_ecue($val){
      if(!empty($val) and \strlen($val)<=30){
        $this->code_ecue = $val ;
      }else{
        $this->setCustomErrors(self::ERREUR_CODE) ;
      }
    }
}
