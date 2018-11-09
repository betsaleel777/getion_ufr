<?php
 namespace Library\Entities ;

 class Ufr extends \Library\Entity{
   private $nom ;
   private $annees_universitaire ;

   const ERREUR_NOM ='<span style="color:red">le nom de la spécialié est incorrecte</span>' ;
   const ERREUR_ANNEES = '<span style="color:red">l\'année universitaire n\'as pas été sélectionnée</span>' ;

   public function nom()
   {
       return $this->nom ;
   }

   public function annees_universitaire()
   {
       return $this->annees_universitaire ;
   }

   public function setNom($val)
   {
       if (!empty($val)) {
           $this->nom = $val ;
       } else {
           $this->setErreurs(array('nom' => self::ERREUR_NOM )) ;
       }
   }

   public function setAnnees_universitaire($val)
   {
       if (!empty($val) and $val !== 'choix') {
           $this->annees_universitaire = $val ;
       } else {
           $this->setErreurs(array('annees_universitaire' => self::ERREUR_ANNEES )) ;
       }
   }
 }
