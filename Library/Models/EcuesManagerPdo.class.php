<?php
   namespace Library\Models ;

   class EcuesManagerPdo extends EcuesManager
   {
     public function add(\Library\Entities\Ecues $ecues){
       try {
         $sql = 'INSERT INTO ecues(nom,credits,ue) VALUES(:nom,:credits,:ue)' ;
         $statement = $this->db->prepare($sql) ;
         $statement->bindValue(':nom',$ecues->nom(),\PDO::PARAM_STR) ;
         $statement->bindValue(':credits',$ecues->credits(),\PDO::PARAM_STR) ;
         $statement->bindValue(':ue',$ecues->ue(),\PDO::PARAM_STR) ;
         $statement->execute() ;
        } catch (\Exception $e) {
           return $e ;
        }
     }
     public function update(\Library\Entities\Ecues $ecues){
       try {
         $sql = 'UPDATE ecues SET nom=:nom,credits=:cred,ue=:ue WHERE id=:id' ;
         $statement = $this->db->prepare($sql) ;
         $statement->bindValue(':nom',$ecues->nom(),\PDO::PARAM_STR) ;
         $statement->bindValue(':cred',$ecues->credits(),\PDO::PARAM_STR) ;
         $statement->bindValue(':ue',$ecues->ue(),\PDO::PARAM_INT) ;
         $statement->bindValue(':id',$ecues->id(),\PDO::PARAM_INT) ;
         $statement->execute() ;
        } catch (\Exception $e) {
           return $e ;
        }
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
       try {
           $sql = "SELECT * FROM ecues";
           $statement = $this->db->query($sql);
           $array = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
           return $array ;
       } catch (\PDOException $e) {
           return $e ;
       }
     }
     public function getList($debut=0,$offset=1){
       try {
           $sql = "SELECT ecues.nom,ecues.id,ecues.credits,ues.nom AS 'ue' FROM ecues INNER JOIN ues ON
            ues.id=ecues.ue LIMIT $debut,$offset";
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
