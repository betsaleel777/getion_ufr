<?php
 namespace Library;

 class Permissions
 {
   private $groupePermissions=Array() ;
   private $permissionsByItem=Array() ;


   public function __construct(array $data)
   {
     $this->groupePermissions = $data;
   }

   public function permissionsByItem()
   {
     return $this->permissionsByItem ;
   }

   public function getItemPermissions($item)
   {
     $newTab = Array() ;
     $tableauPermissions=Array() ;
     $this->permissionsByItem = array_chunk($this->groupePermissions,5) ;
     $max = count($this->permissionsByItem) ;
     foreach ($this->permissionsByItem as $value){
       $newKey = $value[0]['item'] ;
       if($newKey == $item)
        {
          $tableauPermissions = $value ;
          break ;
        }
     }
     //recuperation u
     if(!empty($tableauPermissions))
     {
       foreach ($tableauPermissions as $value) {
         $newKey = $value['action'] ;
         $data = $value ;
         unset($data['action']) ;
         unset($data['item']) ;
         $calebasse  = array( $newKey => $data ) ;
         $tableauPermissions = array_merge($tableauPermissions,$calebasse) ;
       }
     }
     //nettoyage
     foreach ($tableauPermissions as $key => $value) {
       if(is_numeric($key))
       {
         unset($tableauPermissions[$key]) ;
       }
     }
     return $tableauPermissions ;
   }
 }

 ?>
