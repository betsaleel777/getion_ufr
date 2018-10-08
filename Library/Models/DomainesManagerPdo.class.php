<?php
   namespace Library\Models ;

   class DomainesManagerPdo extends DomainesManager
   {
     public function add(\Library\Entities\Domaines $domaines){
       try{
          $sql = 'INSERT INTO domaines(nom) VALUES (:nom)' ;
          $statement = $this->db->prepare($sql);
          $statement->bindValue(':nom',$domaines->nom(),\PDO::PARAM_STR) ;
          $statement->execute() ;
       }catch (\PDOException $e) {
         $_SESSION['MYSQL_ERROR'] = serialize($e) ;
       }

     }
     public function update(\Library\Entities\Domaines $domaines){
       try{
         $sql = 'UPDATE domaines SET nom=:nom WHERE id=:id' ;
         $statement = $this->db->prepare($sql) ;
         $statement->bindValue(':nom',$domaines->nom(),\PDO::PARAM_STR) ;
         $statement->bindValue(':id',$domaines->id(),\PDO::PARAM_INT) ;
         $statement->execute() ;
       }catch (\PDOException $e) {
          $_SESSION['MYSQL_ERROR'] = serialize($e) ;
       }

     }
     public function getUnique(int $id){
       try {
           $sql = "SELECT * FROM domaines WHERE id=$id";
           $statement = $this->db->query($sql);
           $array = $statement->fetch(\PDO::FETCH_ASSOC) ;
           return $array ;
       } catch (\PDOException $e) {
           return $e ;
       }
     }
     public function getListAll(){
       try {
           $sql = 'SELECT * FROM domaines';
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

     public function getListForCustomForm(){
       try {
           $sql = 'SELECT * FROM domaines';
           $statement = $this->db->query($sql);
           $resultat = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
           return $resultat ;
       } catch (\PDOException $e) {
           return $e ;
       }
     }

     public function getList($debut=0,$offset=1){
       try {
           $sql = "SELECT * FROM domaines LIMIT $debut,$offset";
           $statement = $this->db->query($sql);
           $array = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
           return $array ;
       } catch (\PDOException $e) {
           return $e ;
       }
     }
     public function count(){
       $sql = 'SELECT COUNT(*) AS domaines FROM domaines' ;
       $statement = $this->db->query($sql) ;
       $resultat = $statement->fetch(\PDO::FETCH_ASSOC) ;
       return $resultat['domaines'] ;
     }
   }
