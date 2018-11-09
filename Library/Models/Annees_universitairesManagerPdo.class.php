<?php
   namespace Library\Models ;

class Annees_universitairesManagerPdo extends Annees_universitairesManager
{
    public function add(\Library\Entities\Annees_universitaires $annees_universitaires)
    {
        try {
            $sql = 'INSERT INTO annees_universitaires(debut,fin) VALUES(:debut,:fin)' ;
            $statement = $this->db->prepare($sql) ;
            $statement->bindValue(':debut', $annees_universitaires->debut(), \PDO::PARAM_STR) ;
            $statement->bindValue(':fin', $annees_universitaires->fin(), \PDO::PARAM_STR) ;
            $statement->execute() ;
            $_SESSION['now'] = $this->db->lastInsertId() ;
        } catch (\PDOException $e) {
             $_SESSION['MYSQL_ERROR'] = serialize($e) ;
        }
    }

    public function nowId(){
      try {
        $sql = 'SELECT annees_universitaire AS id FROM ufr INNER JOIN annees_universitaires
                WHERE annees_universitaires.fin LIKE "'.date("Y").'"' ;
        $statement = $this->db->query($sql);
        $array = $statement->fetch(\PDO::FETCH_ASSOC) ;
        return $array['id'] ;
      } catch (\PDOException $e) {
        $_SESSION['MYSQL_ERROR'] = serialize($e) ;
      }

    }

    public function update(\Library\Entities\Annees_universitaires $annees_universitaires)
    {
        try {
            $sql = 'INSERT annees_universitaires SET debut=:debut,fin=:fin WHERE id=:id' ;
            $statement = $this->db->prepare($sql) ;
            $statement->bindValue(':debut', $annees_universitaires->debut(), \PDO::PARAM_STR) ;
            $statement->bindValue(':fin', $annees_universitaires->fin(), \PDO::PARAM_STR) ;
            $statement->bindValue(':id', $annees_universitaires->id(), \PDO::PARAM_INT) ;
            $statement->execute() ;
        } catch (\PDOException $e) {
             $_SESSION['MYSQL_ERROR'] = serialize($e) ;
        }
    }
    public function getUnique(int $id)
    {
        try {
            $sql = "SELECT * FROM annees_universitaires WHERE id=$id";
            $statement = $this->db->query($sql);
            $array = $statement->fetch(\PDO::FETCH_ASSOC) ;
            return $array ;
        } catch (\PDOException $e) {
            return $e ;
        }
    }
    public function getListAll()
    {
        try {
            $sql = "SELECT id,concat(debut,'-',fin) AS nom FROM annees_universitaires";
            $statement = $this->db->query($sql);
            $data = [] ;
            while ($resultat = $statement->fetch(\PDO::FETCH_ASSOC)) {
                $data = $data+array($resultat['id'] => $resultat['nom']);
            }
            $data = $data+array('choix' => 'choix....') ;
            return $data ;
        } catch (\PDOException $e) {
            return $e ;
        }
    }

    public function getListForCustomForm()
    {
        $sql = "SELECT id,concat(debut,'-',fin) AS nom FROM annees_universitaires";
        $statement = $this->db->query($sql);
        $resultat = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
        return $resultat ;
    }

    public function getList()
    {
        try {
            $sql = 'SELECT * FROM annees_universitaires ORDER BY id DESC';
            $statement = $this->db->query($sql);
            $array = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
            return $array ;
        } catch (\PDOException $e) {
            return $e ;
        }
    }
    public function count()
    {
        $sql = 'SELECT COUNT(*) AS annees_universitaires FROM annees_universitaires' ;
        $statement = $this->db->query($sql) ;
        $resultat = $statement->fetch(\PDO::FETCH_ASSOC) ;
        return $resultat['annees_universitaires'] ;
    }
    public function delete(int $id)
    {
        $sql = 'DELETE FROM annees_universitaires WHERE id='.$id ;
        $statement = $this->db->query($sql) ;
    }
}
