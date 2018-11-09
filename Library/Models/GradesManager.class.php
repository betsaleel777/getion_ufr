<?php
   namespace Library\Models ;

   abstract class GradesManager extends \Library\Manager
   {
     abstract protected function getListAll() ;
     abstract protected function getUnique(int $id) ;
     abstract protected function count() ;
   }
?>
