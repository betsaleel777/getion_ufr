<?php
   namespace Library\Models ;

   abstract class Semestres_niveausManager extends \Library\Manager
   {
     abstract protected function getListAll() ;
     abstract protected function getUnique(int $id) ;
   }
?>
