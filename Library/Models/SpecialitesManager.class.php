<?php
   namespace Library\Models ;

   abstract class SpecialitesManager extends \Library\Manager
   {
     abstract protected function getListAll() ;
     abstract protected function getUnique(int $id) ;
     abstract protected function getList() ; //qui utilise pagination
     abstract protected function count() ;
     abstract protected function delete(int $id) ;


     public function save(\Library\Entities\Specialites $specialites)
     {
        $specialites->isNew()?$this->add($specialites):$this->update($specialites) ;
     }
   }
?>
