<?php
   namespace Library\Models ;

   abstract class Annees_universitairesManager extends \Library\Manager
   {
     abstract protected function getListAll() ;
     abstract protected function getUnique(int $id) ;
     abstract protected function getList($debut =0,$offset=1) ; //qui utilise pagination
     abstract protected function count() ;
     abstract protected function delete(int $id) ;


     public function save(\Library\Entities\Annees_universitaires $annees_universitaires)
     {
        $annees_universitaires->isNew()?$this->add($annees_universitaires):$this->update($annees_universitaires) ;
     }
   }
?>
