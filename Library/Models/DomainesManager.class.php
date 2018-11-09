<?php
   namespace Library\Models ;

   abstract class DomainesManager extends \Library\Manager
   {
     abstract protected function getListAll() ;
     abstract protected function getUnique(int $id) ;
     abstract protected function getList() ; //qui utilise pagination
     abstract protected function count() ;


     public function save(\Library\Entities\Domaines $domaines)
     {
        $domaines->isNew()?$this->add($domaines):$this->update($domaines) ;
     }
   }
?>
