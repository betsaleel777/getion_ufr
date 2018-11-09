<?php
   namespace Library\Models ;

   abstract class UfrManager extends \Library\Manager
   {
     abstract protected function getListAll() ;
     abstract protected function getUnique(int $id) ;
     abstract protected function getList() ; 
     abstract protected function count() ;
     abstract protected function delete(int $id) ;


     public function save(\Library\Entities\Ufr $ufr)
     {
        $ufr->isNew()?$this->add($ufr):$this->update($ufr) ;
     }
   }
?>
