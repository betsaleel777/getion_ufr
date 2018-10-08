<?php
   namespace Library\Models ;

   class ParcoursManagerPdo extends ParcoursManager
   {
     public function add(\Library\Entities\Parcours $parcours){
       try {
         $sql = 'INSERT INTO parcours(grade,specialite) VALUES(:grade,:specialite)' ;
         $statement = $this->db->prepare($sql) ;
         $statement->bindValue(':grade',$parcours->grade(),\PDO::PARAM_INT) ;
         $statement->bindValue(':specialite',$parcours->specialite(),\PDO::PARAM_INT) ;
         $statement->execute() ;
       } catch (\Exception $e) {
         return $e ;
       }

     }
     public function update(\Library\Entities\Parcours $parcours){

     }
     public function getUnique(int $id){
       try {
           $sql = "SELECT * FROM parcours WHERE id=$id";
           $statement = $this->db->query($sql);
           $array = $statement->fetch(\PDO::FETCH_ASSOC) ;
           return $array ;
       } catch (\PDOException $e) {
           return $e ;
       }
     }
     public function getListAll(){
       //faire un fetch en groupant les specialité par grade dans un tableau
       try {
           $sql = "SELECT grades.nom AS grade,specialites.nom AS specialite,parcours.id AS parcours FROM parcours INNER JOIN grades
                   ON grades.id=parcours.grade INNER JOIN specialites ON specialites.id=parcours.specialite";
           $statement = $this->db->query($sql);
           $data = [] ;
           $resultat = $statement->fetchAll(\PDO::FETCH_GROUP|\PDO::FETCH_ASSOC) ;
           foreach ($resultat as $key => $specialites) {
             $max = count($specialites) ;
             for ($i=0; $i <$max ; $i++) {
               unset($resultat[$key][$i]) ;
               $data = array('"'.$specialites[$i]['parcours'].'"' => $key.'-'.$specialites[$i]['specialite']) ;
               $resultat[$key]=array_merge($resultat[$key],$data) ;
             }
           }
           foreach ($resultat as $key => $value) {
             unset($resultat[$key][0]);
           }
           $resultat = $resultat+array('choix' => 'choix....') ;
           return $resultat ;
       } catch (\PDOException $e) {
           return $e ;
       }
     }
     public function getList($debut=0,$offset=1){
       try {
           $sql = "SELECT grades.nom AS grade,specialites.nom AS specialite,parcours.id FROM parcours INNER JOIN grades
           ON grades.id=parcours.grade INNER JOIN specialites ON specialites.id=parcours.specialite LIMIT $debut,$offset";
           $statement = $this->db->query($sql);
           $array = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
           return $array ;
       } catch (\PDOException $e) {
           return $e ;
       }
     }
     public function count(){
       $sql = 'SELECT COUNT(*) AS parcours FROM parcours' ;
       $statement = $this->db->query($sql) ;
       $resultat = $statement->fetch(\PDO::FETCH_ASSOC) ;
       return $resultat['parcours'] ;
     }
     public function delete(int $id){
       $sql = 'DELETE FROM parcours WHERE id='.$id ;
       $statement = $this->db->query($sql) ;
     }
   }
