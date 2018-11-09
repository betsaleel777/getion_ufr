<?php
   namespace Library\Models ;

   abstract class ProfesseursManager extends \Library\Manager
   {
     abstract protected function getListAll() ;
     abstract protected function getUnique(int $id) ;
     abstract protected function getList() ; //qui utilise pagination
     abstract protected function count() ;
     abstract protected function delete(int $id) ;


     public function save(\Library\Entities\Professeurs $professeurs,int $annee=null,array $ecues=array())
     {
        $professeurs->isNew()?$this->add($professeurs,$ecues,$annee):$this->update($professeurs) ;
     }
   }
?>
