<?php
 namespace Library\Entities ;

 class Parcours extends \Library\Entity{
   private $specialite ;
   private $grade ;

   const ERREUR_SPECIALITE = '<span style="color:red">specialité non selectionée</span>' ;
   const ERREUR_GRADE = '<span style="color:red">grade non sélectioné</span>' ;

   public function specialite(){ return $this->specialite ;}
   public function grade(){ return $this->grade ;}

   public function setSpecialite($val){
     if(\ctype_digit($val))
     {
       $this->specialite = $val ;
     }else {
       $this->setErreurs(array('specialite' => self::ERREUR_SPECIALITE )) ;
     }
   }

   public function setGrade($val){
     if(\ctype_digit($val)){
       $this->grade = $val ;
     }else{
       $this->setErreurs(array('grade' => self::ERREUR_GRADE )) ;
     }
   }
 }
