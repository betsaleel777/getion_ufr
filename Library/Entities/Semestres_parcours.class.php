<?php
 namespace Library\Entities ;

 class Semestres_parcours extends \Library\Entity{
   private $domaine ;
   private $parcour ;
   private $semestres_niveau ;
   private $nom ;

   const ERREUR_NOM = '<span style="color:red">renseignez une ue non vide contenant au plus 80 caractères</span>' ;
   const ERREUR_DOMAINE = '<span style="color:red">renseignez un domaine correcte</span>' ;
   const ERREUR_PARCOUR = '<span style="color:red">veuillez selectioner un parcours</span>' ;
   const ERREUR_SEMESTRE_NIVEAU = '<span style="color:red">selection incorrecte</span>' ;

   public function nom(){ return $this->nom ;}
   public function parcour(){ return $this->parcour ;}
   public function semestres_niveau(){ return $this->semestres_niveau ; }
   public function domaine(){ return $this->domaine ;}

   public function setNom($val)
   {
     if(!empty($val)){
       $this->nom = $val ;
     }else {
       $this->setErreurs(array('nom' => self::ERREUR_NOM )) ;
     }
   }

   public function setDomaine($value)
   {
     if ($value !== 'choix') {
       $this->domaine = $value ;
     }else {
       $this->setErreurs(array('domaine' => self::ERREUR_DOMAINE)) ;
     }
   }

   public function setParcour($value)
   {
     if ($value !== 'choix') {
       $this->parcour = $value ;
     }else {
       $this->setErreurs(array('parcour' => self::ERREUR_PARCOUR)) ;
     }
   }

   public function setSemestres_niveau($value)
   {
     if ($value !== 'choix') {
       $this->semestres_niveau = $value ;
     }else {
       $this->setErreurs(array('semestres_niveau' => self::ERREUR_SEMESTRE_NIVEAU)) ;
     }
   }

 }
