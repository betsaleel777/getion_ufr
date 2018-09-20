<?php
//respect PEAR notation
 namespace Library ;

 abstract class Manager
 {
   protected $db ;
   
   public function __construct($db)
   {
     $this->db = $db ;
   }
 }




 ?>
