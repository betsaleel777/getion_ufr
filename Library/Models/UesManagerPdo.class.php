<?php
   namespace Library\Models ;
   use \Library\Entities\Ues;


   class UesManagerPdo extends UesManager
   {
     public function add(Ues $objetUes){
      try {
        $sql = 'INSERT INTO ues(nom,code) VALUES(:nom,:code)' ;
        $statement = $this->db->prepare($sql) ;
        $statement->bindValue(':nom',$objetUes->nom(),\PDO::PARAM_STR) ;
        $statement->bindValue(':code',$objetUes->code(),\PDO::PARAM_STR) ;
        $statement->execute() ;
        $_SESSION['ue'] = $this->db->lastInsertId() ;
      } catch (\PDOException $e) {
          $_SESSION['MYSQL_ERROR'] = serialize($e) ;
       }
     }

     public function update(Ues $objetUes){
      try {
        $sql = 'UPDATE ues SET nom=:nom,code=:code WHERE id=:id' ;
        $statement = $this->db->prepare($sql) ;
        $statement->bindValue(':nom',$objetUes->nom(),\PDO::PARAM_STR) ;
        $statement->bindValue(':code',$objetUes->code(),\PDO::PARAM_STR) ;
        $statement->bindValue(':id',$objetUes->id(),\PDO::PARAM_INT) ;
        $statement->execute() ;
      }catch (\PDOException $e) {
         $_SESSION['MYSQL_ERROR'] = serialize($e) ;
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
              $data = $data+array($resultat['id'] => '('.$resultat['code'].')  '.$resultat['nom']);
           }
           $data = $data+array('choix' => 'choix....') ;
           return $data ;
       } catch (\PDOException $e) {
           return $e ;
       }
     }

     public function getList($debut=0,$offset=1){
       try {
           $sql = "SELECT ues.id,ues.code,ues.nom,GROUP_CONCAT(ecues.nom) AS ecues FROM ues INNER JOIN
                   ecues ON ues.id=ecues.ue GROUP BY ues.id ORDER BY ues.id DESC LIMIT $debut,$offset";
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

     public function getListForCustomForm(){
       try {
         $sql = 'SELECT * FROM ues' ;
         $statement = $this->db->query($sql);
         return $statement->fetchAll(\PDO::FETCH_ASSOC) ;
       } catch (\PDOException $e) {
         return $e ;
       }
     }

     public function search(string $keyword){
       try {
         $sql = "SELECT ues.id,ues.code,ues.nom,GROUP_CONCAT(ecues.nom) AS ecues FROM ues INNER JOIN
                 ecues ON ues.id=ecues.ue WHERE ues.nom LIKE :key GROUP BY ues.id" ;
         $statement = $this->db->prepare($sql) ;
         $statement->bindValue(':key',$keyword.'%',\PDO::PARAM_STR) ;
         $statement->execute() ;
         return $statement ;
       } catch (\PDOException $e) {
         $_SESSION['MYSQL_ERROR'] = serialize($e) ;
       }
     }

     public function getEcues(int $id){
       try {
         $sql = "SELECT ecues.* FROM ecues WHERE ue=$id" ;
         $statement = $this->db->query($sql);
         return $statement->fetchAll(\PDO::FETCH_ASSOC) ;
       } catch (\PDOException $e) {
         $_SESSION['MYSQL_ERROR'] = serialize($e) ;
       }
     }

     public function getUniqOtherWay(int $id){
       try {
         $sql = "SELECT ues.*,dispensees.id AS dispenseeId,semestres_parcours.nom AS sempar,semestres_parcours.id AS idSempar FROM
         dispensees INNER JOIN semestres_parcours ON semestres_parcours.id=dispensees.semestres_parcour
         INNER JOIN ues ON dispensees.ue=ues.id WHERE ues.id=$id" ;
         $statement = $this->db->query($sql);
         return $statement->fetch(\PDO::FETCH_ASSOC) ;
       } catch (\PDOException $e) {
         $_SESSION['MYSQL_ERROR'] = serialize($e) ;
       }
     }

   }
