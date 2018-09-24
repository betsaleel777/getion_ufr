<?php
   namespace Library\Models ;

   class UesManagerPdo extends UesManager
   {
     public function add(\Library\Entities\Ues $objetUes){
      try {
        $sql = 'INSERT INTO ues(nom,annee_universitaire,volume_horaire) VALUES(:nom,:annee,:volume)' ;
        $statement = $this->db->prepare($sql) ;
        $statement->bindValue(':nom',$objetUes->nom(),\PDO::PARAM_STR) ;
        $statement->bindValue(':annee',$objetUes->annee_universitaire(),\PDO::PARAM_STR) ;
        $statement->bindValue(':volume',$objetUes->volume_horaire(),\PDO::PARAM_STR) ;
        $statement->execute() ;
       } catch (\Exception $e) {
          return $e ;
       }

     }
     public function update(\Library\Entities\Ues $objetUes){
      try {
        $sql = 'UPDATE ues SET nom=:nom,annee_universitaire=:annee,volume_horaire=:vol WHERE id=:id' ;
        $statement = $this->db->prepare($sql) ;
        $statement->bindValue(':nom',$objetUes->nom(),\PDO::PARAM_STR) ;
        $statement->bindValue(':annee',$objetUes->annee_universitaire(),\PDO::PARAM_STR) ;
        $statement->bindValue(':vol',$objetUes->volume_horaire(),\PDO::PARAM_STR) ;
        $statement->bindValue(':id',$objetUes->id(),\PDO::PARAM_INT) ;
        $statement->execute() ;
      }catch (\Exception $e) {

      }

     }
     public function getUnique(int $id){
       try {
           $sql = "SELECT * FROM ues WHERE id=$id";
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
           $sql = "SELECT * FROM ues LIMIT $debut,$offset";
           $statement = $this->db->query($sql);
           $array = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
           return $array ;
       } catch (\PDOException $e) {
           return $e ;
       }
     }
     public function count(){
       $sql = 'SELECT COUNT(*) AS ues FROM ues' ;
       $statement = $this->db->query($sql) ;
       $resultat = $statement->fetch(\PDO::FETCH_ASSOC) ;
       return $resultat['ues'] ;
     }
     public function delete(int $id){
       $sql = 'DELETE FROM ues WHERE id='.$id ;
       $statement = $this->db->query($sql) ;
     }

   }
