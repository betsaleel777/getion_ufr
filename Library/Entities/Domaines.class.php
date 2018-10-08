<?php
 namespace Library\Entities ;

 class Domaines extends \Library\Entity{
   private $nom ;

   const ERREUR_NOM ='<span style="color:red">le nom du domaine est incorrecte</span>' ;

   public function nom(){ return $this->nom ;}

   public function setNom($val){
     if(!empty($val)){
       $this->nom = $val ;
     }else {
       $this->setErreurs(array('nom' => self::ERREUR_NOM )) ;
     }
   }
 }
