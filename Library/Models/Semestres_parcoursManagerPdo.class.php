<?php
   namespace Library\Models ;

   class Semestres_parcoursManagerPdo extends Semestres_parcoursManager
   {
     public function add(\Library\Entities\Semestres_parcours $semestres_parcours){
       try {
         $sql = 'INSERT INTO semestres_parcours(domaine,parcour,semestres_niveau,nom)
                 VALUES (:domaine,:parcours,:semniv,:nom)' ;
         $statement = $this->db->prepare($sql) ;
         $statement->bindValue(':domaine',$semestres_parcours->domaine(),\PDO::PARAM_INT) ;
         $statement->bindValue(':parcours',$semestres_parcours->parcour(),\PDO::PARAM_INT) ;
         $statement->bindValue(':semniv',$semestres_parcours->semestres_niveau(),\PDO::PARAM_INT) ;
         $statement->bindValue(':nom',$semestres_parcours->nom(),\PDO::PARAM_STR) ;
         $statement->execute() ;
       } catch (\Exception $e) {
         return $e ;
       }


     }
     public function update(\Library\Entities\Semestres_parcours $semestres_parcours){

     }
     public function getUnique(int $id){
       try {
           $sql = "SELECT * FROM semestres_parcours WHERE id=$id";
           $statement = $this->db->query($sql);
           $array = $statement->fetch(\PDO::FETCH_ASSOC) ;
           return $array ;
       } catch (\PDOException $e) {
           return $e ;
       }
     }
     public function getListAll(){
       try {
           $sql = "SELECT * FROM semestres_parcours";
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
           $sql = "SELECT * FROM semestres_parcours LIMIT $debut,$offset";
           $statement = $this->db->query($sql);
           $array = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
           return $array ;
       } catch (\PDOException $e) {
           return $e ;
       }
     }
     public function count(){
       $sql = 'SELECT COUNT(*) AS semestres_parcours FROM semestres_parcours' ;
       $statement = $this->db->query($sql) ;
       $resultat = $statement->fetch(\PDO::FETCH_ASSOC) ;
       return $resultat['semestres_parcours'] ;
     }
     public function delete(int $id){
       $sql = 'DELETE FROM semestres_parcours WHERE id='.$id ;
       $statement = $this->db->query($sql) ;
     }
   }
