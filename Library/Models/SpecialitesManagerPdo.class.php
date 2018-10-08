<?php
   namespace Library\Models ;

   class SpecialitesManagerPdo extends SpecialitesManager
   {
     public function add(\Library\Entities\Specialites $specialites){
      try {
        $sql = 'INSERT INTO specialites(nom) VALUES(:nom) ' ;
        $statement = $this->db->prepare($sql) ;
        $statement->bindValue(':nom',$specialites->nom(),\PDO::PARAM_STR) ;
        $statement->execute() ;
      } catch (\PDOException $e) {
       $_SESSION['MYSQL_ERROR'] = serialize($e) ;
      }

     }
     public function update(\Library\Entities\Specialites $specialites){
      try {
         $sql = 'UPDATE specialites SET nom=:nom WHERE id=:id' ;
         $statement = $this->db->prepare($sql) ;
         $statement->bindValue(':nom',$specialites->nom(),\PDO::PARAM_STR) ;
         $statement->bindValue(':id',$specialites->id(),\PDO::PARAM_INT) ;
         $statement->execute() ;
      } catch (\PDOException $e) {
        $_SESSION['MYSQL_ERROR'] = serialize($e) ;
      }

     }
     public function getUnique(int $id){
       try {
           $sql = "SELECT * FROM specialites WHERE id=$id";
           $statement = $this->db->query($sql);
           $array = $statement->fetch(\PDO::FETCH_ASSOC) ;
           return $array ;
       } catch (\PDOException $e) {
           return $e ;
       }
     }
     public function getListAll(){
       try {
           $sql = "SELECT id,nom FROM specialites";
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
     public function getList($debut=0,$offset=1){
       try {
           $sql = "SELECT * FROM specialites LIMIT $debut,$offset";
           $statement = $this->db->query($sql);
           $array = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
           return $array ;
       } catch (\PDOException $e) {
           return $e ;
       }
     }
     public function count(){
       $sql = 'SELECT COUNT(*) AS specialites FROM specialites' ;
       $statement = $this->db->query($sql) ;
       $resultat = $statement->fetch(\PDO::FETCH_ASSOC) ;
       return $resultat['specialites'] ;
     }
     public function delete(int $id){
       $sql = 'DELETE FROM specialites WHERE id='.$id ;
       $statement = $this->db->query($sql) ;
     }

     public function search(string $keyword){
       try {
         $sql = "SELECT * FROM specialites WHERE nom LIKE :key" ;
         $statement = $this->db->prepare($sql) ;
         $statement->bindValue(':key',$keyword.'%',\PDO::PARAM_STR) ;
         $statement->execute() ;
         return $statement ;
       } catch (\PDOException $e) {
         $_SESSION['MYSQL_ERROR'] = serialize($e) ;
       }
     }
   }
