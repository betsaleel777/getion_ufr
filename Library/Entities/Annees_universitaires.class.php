<?php
 namespace Library\Entities ;

 class Annees_universitaires extends \Library\Entity{
   private $debut ;
   private $fin ;

   const MESSAGE_ERREUR_DEBUT = '<span style="color:red">cette année n\'est pas correcte</span>' ;
   const MESSAGE_ERREUR_FIN = '<span style="color:red">cette année n\'est pas correcte</span>' ;

   public function debut(){ return $this->debut ;}
   public function fin(){ return $this->fin ;}

   public function setDebut($val){
     if(!empty($val) and is_numeric($val) and \strlen($val) == 4){
       $this->debut = $val ;
     }else {
       $this->setErreurs(array('debut' => self::MESSAGE_ERREUR_DEBUT )) ;
     }
   }

   public function setFin($val){
     if(!empty($val) and is_numeric($val) and strlen($val) == 4){
       $this->fin = $val ;
     }else {
       $this->setErreurs(array('fin' => self::MESSAGE_ERREUR_FIN )) ;
     }
   }
 }
