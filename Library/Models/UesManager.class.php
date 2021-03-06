<?php
   namespace Library\Models ;

   abstract class UesManager extends \Library\Manager
   {
     abstract protected function getListAll() ;
     abstract protected function getUnique(int $id) ;
     abstract protected function getList() ; //qui utilise pagination
     abstract protected function count() ;
     abstract protected function delete(int $id) ;

     public function save(\Library\Entities\Ues $objet)
     {
        $objet->isNew()?$this->add($objet):$this->update($objet) ;
     }
   }
?>
