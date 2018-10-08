<?php
   namespace Library\Models ;

   class GradesManagerPdo extends GradesManager
   {
     public function getUnique(int $id){
       try {
           $sql = "SELECT * FROM grades WHERE id=$id";
           $statement = $this->db->query($sql);
           $array = $statement->fetch(\PDO::FETCH_ASSOC) ;
           return $array ;
       } catch (\PDOException $e) {
           return $e ;
       }
     }
     public function getListAll(){
       try {
           $sql = "SELECT id,nom FROM grades";
           $statement = $this->db->query($sql);
           $data = [] ;
           while($resultat = $statement->fetch(\PDO::FETCH_ASSOC)){
              $data = $data+array($resultat['id'] => $resultat['nom']);
           }
           $data = $data+array('choix' => 'choix....') ;
           return $data ;
       } catch (\PDOException $e) {
           return $e ;
       }
     }
     public function count(){
       $sql = 'SELECT COUNT(*) AS grades FROM grades' ;
       $statement = $this->db->query($sql) ;
       $resultat = $statement->fetch(\PDO::FETCH_ASSOC) ;
       return $resultat['grades'] ;
     }

   }
