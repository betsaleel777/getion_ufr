<?php
   namespace Library\Models ;

   abstract class Semestres_parcoursManager extends \Library\Manager
   {
     abstract protected function getListAll() ;
     abstract protected function getUnique(int $id) ;
     abstract protected function getList() ; //qui utilise pagination
     abstract protected function count() ;
     abstract protected function delete(int $id) ;


     public function save(\Library\Entities\Semestres_parcours $semestres_parcours)
     {
        $semestres_parcours->isNew()?$this->add($semestres_parcours):$this->update($semestres_parcours) ;
     }
   }
?>
