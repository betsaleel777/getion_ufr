<?php
   namespace Library\Models ;

class DispenseesManagerPdo extends DispenseesManager
{
    public function add(\Library\Entities\Dispensees $dispensees)
    {
        try {
            $sql = 'INSERT INTO dispensees(semestres_parcour,annees_universitaire,ue) VALUES(:sempar,:annee,:ue)' ;
            $statement = $this->db->prepare($sql);
            $statement->bindValue(':sempar', $dispensees->semestres_parcour(), \PDO::PARAM_INT) ;
            $statement->bindValue(':annee', $dispensees->annees_universitaire(), \PDO::PARAM_INT) ;
            $calebasse = $dispensees->ue() ;
            $max = count($calebasse) ;
            for ($i=0; $i <$max ; $i++) {
                $statement->bindValue(':ue', $calebasse[$i], \PDO::PARAM_INT) ;
                $statement->execute() ;
            }
        } catch (\PDOException $e) {
            return $e ;
        }
    }

    public function uniqUpdate(int $id,int $newUeId)
    {
      try {
        $sql = 'UPDATE dispensees SET ue=:ue WHERE id=:id' ;
        $statement = $this->db->prepare($sql) ;
        $statement->bindValue(':ue',$newUeId,\PDO::PARAM_INT) ;
        $statement->bindValue(':id',$id,\PDO::PARAM_INT) ;
        $statement->execute() ;
      } catch (\PDOException $e) {
        return $e ;
      }
    }

    public function getUnique(int $id)
    {
        try {
            $sql = "SELECT * FROM dispensees WHERE id=$id";
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
            $sql = "SELECT * FROM dispensees";
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

    public function getList($debut=0, $offset=1){
      try {
        $sql = "SELECT semestres_parcours.id,concat(annees_universitaires.debut,'-',annees_universitaires.fin) AS annees_universitaire,
        semestres_parcours.nom AS semestres_parcour FROM dispensees INNER JOIN annees_universitaires ON
        annees_universitaires.id=dispensees.annees_universitaire INNER JOIN semestres_parcours ON
        semestres_parcours.id=dispensees.semestres_parcour GROUP BY semestres_parcours.nom LIMIT $debut,$offset" ;
        $statement = $this->db->query($sql);
        $array = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
        return $array ;
      } catch (\PDOException $e) {
        return $e ;
      }
    }

    public function getListshow(int $id)
    {
        try {
            $sql = "SELECT ues.id AS ueId,dispensees.id,concat(annees_universitaires.debut,'-',annees_universitaires.fin) AS annees_universitaire,
            semestres_parcours.nom AS semestres_parcour,semestres_parcours.id AS semp,ues.nom AS ue FROM dispensees INNER JOIN annees_universitaires ON
            annees_universitaires.id=dispensees.annees_universitaire INNER JOIN ues ON ues.id=dispensees.ue INNER JOIN
            semestres_parcours ON semestres_parcours.id=dispensees.semestres_parcour WHERE semestres_parcours.id=$id";
            $statement = $this->db->query($sql);
            $array = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
            return $array ;
        } catch (\PDOException $e) {
            return $e ;
        }
    }

    public function count()
    {
        $sql = 'SELECT COUNT(*) AS dispensees FROM dispensees' ;
        $statement = $this->db->query($sql) ;
        $resultat = $statement->fetch(\PDO::FETCH_ASSOC) ;
        return $resultat['dispensees'] ;
    }
    public function delete(int $id)
    {
        $sql = 'DELETE FROM dispensees WHERE id='.$id ;
        $statement = $this->db->query($sql) ;
    }
}
