<?php
   namespace Library\Models ;

   abstract class ParcoursManager extends \Library\Manager
   {
     abstract protected function getListAll() ;
     abstract protected function getUnique(int $id) ;
     abstract protected function getList() ; //qui utilise pagination
     abstract protected function count() ;
     abstract protected function delete(int $id) ;


     public function save(\Library\Entities\Parcours $parcours)
     {
        $parcours->isNew()?$this->add($parcours):$this->update($parcours) ;
     }
   }
?>
