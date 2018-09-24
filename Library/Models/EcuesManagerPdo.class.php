<?php
   namespace Library\Models ;

   class EcuesManagerPdo extends EcuesManager
   {
     public function add(\Library\Entities\Ecues $ecues){

     }
     public function update(\Library\Entities\Ecues $ecues){

     }
     public function getUnique(int $id){
       try {
           $sql = "SELECT * FROM ecues WHERE id=$id";
           $statement = $this->db->query($sql);
           $array = $statement->fetch(\PDO::FETCH_ASSOC) ;
           return $array ;
       } catch (\PDOException $e) {
           return $e ;
       }
     }
     public function getListAll(){
     }
     public function getList($debut=0,$offset=1){
       try {
           $sql = "SELECT * FROM ecues LIMIT $debut,$offset";
           $statement = $this->db->query($sql);
           $array = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
           return $array ;
       } catch (\PDOException $e) {
           return $e ;
       }
     }
     public function count(){
       $sql = 'SELECT COUNT(*) AS ecues FROM ecues' ;
       $statement = $this->db->query($sql) ;
       $resultat = $statement->fetch(\PDO::FETCH_ASSOC) ;
       return $resultat['ecues'] ;
     }
     public function delete(int $id){
       $sql = 'DELETE FROM ecues WHERE id='.$id ;
       $statement = $this->db->query($sql) ;
     }
   }
