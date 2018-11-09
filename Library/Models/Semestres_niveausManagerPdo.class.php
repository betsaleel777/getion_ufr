<?php
   namespace Library\Models ;

   class Semestres_niveausManagerPdo extends Semestres_niveausManager
   {
     public function getUnique(int $id){
       try {
           $sql = "SELECT * FROM semestres_niveaus WHERE id=$id";
           $statement = $this->db->query($sql);
           $array = $statement->fetch(\PDO::FETCH_ASSOC) ;
           return $array ;
       } catch (\PDOException $e) {
           return $e ;
       }
     }
     public function getListAll(){
       try {
           $sql = "SELECT grades.nom,grades_niveaus.niveau,semestres.nom,semestres_niveaus.id FROM semestres_niveaus
           INNER JOIN grades_niveaus ON grades_niveaus.id=semestres_niveaus.grades_niveau LEFT JOIN semestres
           ON semestres_niveaus.semestre=semestres.id INNER join grades ON grades_niveaus.grade=grades.id";
           $statement = $this->db->query($sql);
           $data = [] ;
           $resultat = $statement->fetchAll(\PDO::FETCH_GROUP|\PDO::FETCH_ASSOC) ;
           foreach ($resultat as $key => $options) {
             $max = count($options) ;
             for ($i=0; $i <$max ; $i++) {
               unset($resultat[$key][$i]) ;
               $data = array('"'.$options[$i]['id'].'"' => $key.'-'.$options[$i]['niveau'].'-'.$options[$i]['nom']) ;
               $resultat[$key]=array_merge($resultat[$key],$data) ;
             }
           }
           foreach ($resultat as $key => $value) {
             foreach ($value as $clef => $interieur) {
               if(is_int($clef)){
                 unset($resultat[$key][$clef]) ;
               }
             }
           }
           $resultat = $resultat+array('choix' => 'choix....') ;
           return $resultat ;
       } catch (\PDOException $e) {
           return $e ;
       }
     }
}
