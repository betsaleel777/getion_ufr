<?php
   namespace Library\Models ;

class ParcoursManagerPdo extends ParcoursManager
{
    public function add(\Library\Entities\Parcours $parcours)
    {
        try {
            $sql = 'INSERT INTO parcours(grade,specialite) VALUES(:grade,:specialite)' ;
            $statement = $this->db->prepare($sql) ;
            $statement->bindValue(':grade', $parcours->grade(), \PDO::PARAM_INT) ;
            $statement->bindValue(':specialite', $parcours->specialite(), \PDO::PARAM_INT) ;
            $statement->execute() ;
            $_SESSION['parcours'] = $this->db->lastInsertId() ;
        } catch (\PDOException $e) {
            $_SESSION['MYSQL_ERROR'] = serialize($e) ;
        }
    }
    public function update(\Library\Entities\Parcours $parcours)
    {
      try {
          $sql = 'UPDATE parcours SET grade=:grade,specialite=:specialite WHERE id=:id' ;
          $statement = $this->db->prepare($sql) ;
          $statement->bindValue(':grade', $parcours->grade(), \PDO::PARAM_INT) ;
          $statement->bindValue(':specialite', $parcours->specialite(), \PDO::PARAM_INT) ;
          $statement->bindValue(':id', $parcours->id(), \PDO::PARAM_INT) ;
          $statement->execute() ;
      } catch (\PDOException $e) {
          $_SESSION['MYSQL_ERROR'] = serialize($e) ;
      }
    }
    public function getUnique(int $id)
    {
        try {
            $sql = "SELECT * FROM parcours WHERE id=$id";
            $statement = $this->db->query($sql);
            $array = $statement->fetch(\PDO::FETCH_ASSOC) ;
            return $array ;
        } catch (\PDOException $e) {
            $_SESSION['MYSQL_ERROR'] = serialize($e) ;
        }
    }
    public function getListAll()
    {
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
                    $resultat[$key]=array_merge($resultat[$key], $data) ;
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

    public function getListForCustomForm()
    {
        try {
            $sql = 'SELECT grades.nom AS grade,specialites.nom AS specialite,parcours.id AS parcours FROM parcours INNER JOIN grades
                 ON grades.id=parcours.grade INNER JOIN specialites ON specialites.id=parcours.specialite';
            $statement = $this->db->query($sql);
            $data = [] ;
            while ($resultat = $statement->fetch(\PDO::FETCH_ASSOC)) {
                $data[] = array('parcour' => $resultat['parcours'],
                          'nom' => $resultat['grade'].'-'.$resultat['specialite']) ;
            }
            return $data ;
        } catch (\PDOException $e) {
            return $e ;
        }
    }
    public function getList()
    {
        try {
            $sql = "SELECT grades.nom AS grade,specialites.nom AS specialite,parcours.id FROM parcours INNER JOIN grades
           ON grades.id=parcours.grade INNER JOIN specialites ON specialites.id=parcours.specialite ORDER BY id DESC";
            $statement = $this->db->query($sql);
            $array = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
            return $array ;
        } catch (\PDOException $e) {
            return $e ;
        }
    }
    public function count()
    {
        $sql = 'SELECT COUNT(*) AS parcours FROM parcours' ;
        $statement = $this->db->query($sql) ;
        $resultat = $statement->fetch(\PDO::FETCH_ASSOC) ;
        return $resultat['parcours'] ;
    }
    public function delete(int $id)
    {
        $sql = 'DELETE FROM parcours WHERE id='.$id ;
        $statement = $this->db->query($sql) ;
    }
    // public function search(string $keyword)
    // {
    //     try {
    //         $sql = 'SELECT parcours.id,grades.nom AS grade,specialites.nom AS specialite FROM parcours INNER JOIN
    //      grades ON grades.id=parcours.grade INNER JOIN specialites ON specialites.id=parcours.specialite
    //      WHERE concat(grades.nom," ",specialites.nom) LIKE :key' ;
    //         $statement = $this->db->prepare($sql) ;
    //         $statement->bindValue(':key', $keyword.'%', \PDO::PARAM_STR) ;
    //         $statement->execute() ;
    //         return $statement ;
    //     } catch (\PDOException $e) {
    //         $_SESSION['MYSQL_ERROR'] = serialize($e) ;
    //     }
    // }

    public function getMaquette(int $id){
      try {
        $sql = "SELECT ues.code,ues.nom,ecues.code_ecue,ecues.nom,ecues.cm,ecues.td,ecues.tp,ecues.projet,
                ecues.cm+ecues.td+ecues.tp+ecues.projet AS Heures,ecues.credits,concat(professeurs.nom,' ',
                professeurs.prenoms) AS professeur FROM ecues INNER JOIN ues ON ecues.ue = ues.id
                INNER JOIN enseigner ON ecues.id = enseigner.ecue INNER JOIN professeurs ON
                professeurs.id = enseigner.professeur WHERE ues.id IN (SELECT dispensees.ue FROM dispensees
                WHERE dispensees.semestres_parcour=$id)" ;
        $statement = $this->db->query($sql) ;
        $resultat = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
        return $resultat ;
      }catch (\PDOException $e){
        $_SESSION['MYSQL_ERROR'] = serialize($e) ;
      }
    }
}
