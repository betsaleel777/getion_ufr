<?php
   namespace Library\Models ;

   abstract class ProfesseursManager extends \Library\Manager
   {
     abstract protected function getListAll() ;
     abstract protected function getUnique(int $id) ;
     abstract protected function getList($debut =0,$offset=1) ; //qui utilise pagination
     abstract protected function count() ;
     abstract protected function delete(int $id) ;


     public function save(\Library\Entities\Professeurs $professeurs)
     {
        $professeurs->isNew()?$this->add($professeurs):$this->update($professeurs) ;
     }
   }
?>
