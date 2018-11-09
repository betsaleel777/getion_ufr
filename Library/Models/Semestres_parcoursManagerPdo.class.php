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
       } catch (\PDOException $e) {
         $_SESSION['MYSQL_ERROR'] = serialize($e) ;
       }


     }
     public function update(\Library\Entities\Semestres_parcours $semestres_parcours){
       try {
         $sql = 'UPDATE semestres_parcours SET domaine=:domaine,parcour=:parcours,
                 semestres_niveau=:semniv,nom=:nom WHERE id=:id' ;
         $statement = $this->db->prepare($sql) ;
         $statement->bindValue(':domaine',$semestres_parcours->domaine(),\PDO::PARAM_INT) ;
         $statement->bindValue(':parcours',$semestres_parcours->parcour(),\PDO::PARAM_INT) ;
         $statement->bindValue(':semniv',$semestres_parcours->semestres_niveau(),\PDO::PARAM_INT) ;
         $statement->bindValue(':nom',$semestres_parcours->nom(),\PDO::PARAM_STR) ;
         $statement->bindValue(':id',$semestres_parcours->id(),\PDO::PARAM_INT) ;
         $statement->execute() ;
       } catch (\PDOException $e) {
         $_SESSION['MYSQL_ERROR'] = serialize($e) ;
       }
     }
     public function getUnique(int $id){
       try {
           $sql = "SELECT semestres_parcours.nom,semestres_niveaus.id AS semestre_niveau,semestres.nom AS semestre,
           parcours.id AS parcour,concat(grades.nom,'-',specialites.nom) AS parcoursString,
           domaines.id AS domaine,domaines.nom AS domaineString FROM semestres_parcours INNER JOIN parcours
           ON parcours.id=semestres_parcours.parcour INNER JOIN semestres_niveaus ON
           semestres_parcours.semestres_niveau=semestres_niveaus.id INNER JOIN semestres
           ON semestres.id=semestres_niveaus.semestre INNER JOIN domaines
           ON domaines.id=semestres_parcours.domaine INNER JOIN grades ON grades.id=parcours.grade
           INNER JOIN specialites ON specialites.id=parcours.specialite WHERE semestres_parcours.id=$id";
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
     public function getList(){
       try {
           $sql = "SELECT ues.id AS ueId,dispensees.id,concat(annees_universitaires.debut,'-',annees_universitaires.fin) AS annees_universitaire,
           semestres_parcours.nom AS semestres_parcour,semestres_parcours.id AS semp,semestres_parcours.parcour AS parc FROM dispensees INNER JOIN annees_universitaires ON
           annees_universitaires.id=dispensees.annees_universitaire INNER JOIN ues ON ues.id=dispensees.ue INNER JOIN
           semestres_parcours ON semestres_parcours.id=dispensees.semestres_parcour GROUP BY semestres_parcours.nom ORDER BY semestres_parcours.id DESC";
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

     public function getSemestreOf(int $parcour){
       try {
         $sql = "SELECT grade AS id FROM parcours WHERE id=$parcour" ;
         $statement = $this->db->query($sql) ;
         $grade = $statement->fetch(\PDO::FETCH_ASSOC) ;
         $sql = 'SELECT semestres.nom,semestres_niveaus.id FROM semestres_niveaus INNER JOIN
                 semestres ON semestres_niveaus.semestre=semestres.id INNER JOIN grades_niveaus ON
                 grades_niveaus.id=semestres_niveaus.grades_niveau WHERE grades_niveaus.id IN(SELECT grades_niveaus.id
                 FROM grades_niveaus WHERE grades_niveaus.grade=:grade)' ;
         $statement = $this->db->prepare($sql) ;
         $statement->bindValue(':grade',$grade['id'],\PDO::PARAM_INT) ;
         $statement->execute() ;
         $data = [] ;
         while($resultat = $statement->fetch(\PDO::FETCH_ASSOC)){
            $data[] = array('id' => $resultat['id'] ,
                            'nom' => $resultat['nom']);
         }
         return $data;
       } catch (\PDOException $e) {
         return $e ;
       }

     }
     public function getListForCustomForm(){
       try {
         $sql = 'SELECT id,nom FROM semestres_parcours' ;
         $statement = $this->db->query($sql) ;
         $resultat = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
         return $resultat ;
       } catch (\PDOException $e) {
         return $e ;
       }
     }

     public function search(string $keyword){
       try {
         $sql = "SELECT ues.id AS ueId,dispensees.id,concat(annees_universitaires.debut,'-',annees_universitaires.fin) AS annees_universitaire,
         semestres_parcours.nom AS semestres_parcour,semestres_parcours.id AS semp,ues.nom AS ue FROM dispensees INNER JOIN annees_universitaires ON
         annees_universitaires.id=dispensees.annees_universitaire INNER JOIN ues ON ues.id=dispensees.ue INNER JOIN
         semestres_parcours ON semestres_parcours.id=dispensees.semestres_parcour WHERE semestres_parcours.nom LIKE :key GROUP BY semestres_parcours.nom" ;
         $statement = $this->db->prepare($sql) ;
         $statement->bindValue(':key',$keyword.'%',\PDO::PARAM_STR) ;
         $statement->execute() ;
         return $statement ;
       } catch (\PDOException $e) {
         $_SESSION['MYSQL_ERROR'] = serialize($e) ;
       }
     }

     /**SELECT ues.code,ues.nom,ecues.code_ecue,ecues.nom,ecues.cm,ecues.td,ecues.tp,ecues.projet, ecues.cm+ecues.td+ecues.tp+ecues.projet as Heures,ecues.credits,
        concat(professeurs.nom,'</br>',professeurs.prenoms) as professeur from ecues inner join ues on ecues.ue = ues.id inner join
        enseigner on ecues.id = enseigner.ecue inner join professeurs on professeurs.id = enseigner.professeur WHERE ues.id IN (SELECT dispensees.ue FROM dispensees
        WHERE dispensees.semestres_parcour=6)
     **/

   }
?>
