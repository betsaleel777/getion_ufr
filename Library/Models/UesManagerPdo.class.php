<?php
   namespace Library\Models ;

   class UesManagerPdo extends UesManager
   {
     public function add(\Library\Entities\Ues $objetUes){
      try {
        $sql = 'INSERT INTO ues(nom,volume_horaire,code) VALUES(:nom,:volume,:code)' ;
        $statement = $this->db->prepare($sql) ;
        $statement->bindValue(':nom',$objetUes->nom(),\PDO::PARAM_STR) ;
        $statement->bindValue(':volume',$objetUes->volume_horaire(),\PDO::PARAM_STR) ;
        $statement->bindValue(':code',$objetUes->code(),\PDO::PARAM_STR) ;
        $statement->execute() ;
       } catch (\Exception $e) {
          return $e ;
       }

     }
     public function update(\Library\Entities\Ues $objetUes){
      try {
        $sql = 'UPDATE ues SET nom=:nom,volume_horaire=:vol,code=:code WHERE id=:id' ;
        $statement = $this->db->prepare($sql) ;
        $statement->bindValue(':nom',$objetUes->nom(),\PDO::PARAM_STR) ;
        $statement->bindValue(':vol',$objetUes->volume_horaire(),\PDO::PARAM_STR) ;
        $statement->bindValue(':code',$objetUes->code(),\PDO::PARAM_STR) ;
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
       try {
           $sql = "SELECT * FROM ues";
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
