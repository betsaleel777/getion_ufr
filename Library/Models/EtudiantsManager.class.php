<?php
   namespace Library\Models ;

   abstract class EtudiantsManager extends \Library\Manager
   {
     abstract protected function getListAll() ;
     abstract protected function getUnique(int $id) ;
     abstract protected function getList($debut=0,$offset=1) ; //qui utilise pagination
     abstract protected function count() ;
     abstract protected function delete(int $id) ;


     public function save(\Library\Entities\Etudiants $objet)
     {
        $objet->isNew()?$this->add($objet):$this->update($objet) ;
     }
   }
  ?>
