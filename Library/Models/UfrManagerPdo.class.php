<?php
   namespace Library\Models ;

   class UfrManagerPdo extends UfrManager
   {
     public function add(\Library\Entities\Ufr $ufr){

     }
     public function update(\Library\Entities\Ufr $ufr){

     }
     public function getUnique(int $id){
       try {
           $sql = "SELECT * FROM ufr WHERE id=$id";
           $statement = $this->db->query($sql);
           $array = $statement->fetch(\PDO::FETCH_ASSOC) ;
           return $array ;
       } catch (\PDOException $e) {
           return $e ;
       }
     }
     public function getListAll(){
       try {
           $sql = "SELECT * FROM ufr";
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
     public function getList(){
       try {
           $sql = "SELECT ufr.id, ufr.nom, concat(annees_universitaires.debut,'-',annees_universitaires.fin)
                   AS annees_universitaire FROM ufr INNER JOIN annees_universitaires
                   ON ufr.annees_universitaire=annees_universitaires.id" ;
           $statement = $this->db->query($sql);
           $array = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
           return $array ;
       } catch (\PDOException $e) {
           return $e ;
       }
     }
     public function count(){
       $sql = 'SELECT COUNT(*) AS ufr FROM ufr' ;
       $statement = $this->db->query($sql) ;
       $resultat = $statement->fetch(\PDO::FETCH_ASSOC) ;
       return $resultat['ufr'] ;
     }
     public function delete(int $id){
       $sql = 'DELETE FROM ufr WHERE id='.$id ;
       $statement = $this->db->query($sql) ;
     }
   }
