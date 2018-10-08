<?php
 namespace Library\Entities ;

 class Ecues extends \Library\Entity{
   private $nom ;
   private $credits ;
   private $ue ;

   const ERREUR_NOM ='<span style="color:red">le nom de l\'ecue est incorrecte</span>' ;
   const ERREUR_CREDIT = '<span style="color:red">le nombre de crédit incorrecte</span>' ;
   const ERREUR_UE = '<span style="color:red">aucune ue selectionée</span>' ;

   public function nom(){ return $this->nom ;}
   public function credits(){return $this->credits ;}
   public function ue(){ return $this->ue ;}

   public function setNom($val){
     if(!empty($val) and strlen($val)<=80 ){
       $this->nom = $val ;
     }else{
       $this->setErreurs(array('nom' => self::ERREUR_NOM)) ;
     }
   }

   public function setCredits($val){
     if(!empty($val) and \strlen($val)<=2){
       $this->credits = $val ;
     }else {
       $this->setErreurs(array('credits' => self::ERREUR_CREDIT)) ;
     }
   }

   public function setUe($val){
     $val = (int)$val ;
     if(!empty($val)){
      $this->ue = $val ;
     }else {
       $this->setErreurs(array('ue' => self::ERREUR_UE)) ;
     }
   }
 }
