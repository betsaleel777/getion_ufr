<?php
namespace Library\Models ;

class EtudiantsManagerPdo extends EtudiantsManager
{
    public function add(\Library\Entities\Etudiants $etudiants)
    {
        $sql = 'INSERT INTO etudiants(numero_carte,numero_bac,nom,prenoms,genre,email,date_naissance,contacts,domicile)
                VALUES (:carte,:bac,:nom,:prenoms,:genre,:email,:naissance,:contacts,:domicile)' ;
        $statement = $this->db->prepare($sql) ;
        $statement->bindValue(':carte',$etudiants->numero_carte(),\PDO::PARAM_STR) ;
        $statement->bindValue(':bac',$etudiants->numero_bac(),\PDO::PARAM_STR) ;
        $statement->bindValue(':nom',$etudiants->nom(),\PDO::PARAM_STR) ;
        $statement->bindValue(':prenoms',$etudiants->prenoms(),\PDO::PARAM_STR) ;
        $statement->bindValue(':naissance',$etudiants->date_naissance(),\PDO::PARAM_STR) ;
        $statement->bindValue(':email',$etudiants->email(),\PDO::PARAM_STR) ;
        $statement->bindValue(':contacts',$etudiants->contacts(),\PDO::PARAM_STR) ;
        $statement->bindValue(':domicile',$etudiants->domicile(),\PDO::PARAM_STR) ;
        $statement->bindValue(':genre',$etudiants->genre(),\PDO::PARAM_STR) ;
        $statement->execute() ;
    }

    public function update(\Library\Entities\Etudiants $etudiants){
      $sql = 'UPDATE etudiants SET numero_carte=:carte,numero_bac=:bac,nom=:nom,prenoms=:prenoms,genre=:genre,email=:email,
              date_naissance=:naissance,contacts=:contacts,domicile=:domicile WHERE id=:id';
      $statement = $this->db->prepare($sql) ;
      $statement->bindValue(':carte',$etudiants->numero_carte(),\PDO::PARAM_STR) ;
      $statement->bindValue(':bac',$etudiants->numero_bac(),\PDO::PARAM_STR) ;
      $statement->bindValue(':nom',$etudiants->nom(),\PDO::PARAM_STR) ;
      $statement->bindValue(':prenoms',$etudiants->prenoms(),\PDO::PARAM_STR) ;
      $statement->bindValue(':naissance',$etudiants->date_naissance(),\PDO::PARAM_STR) ;
      $statement->bindValue(':email',$etudiants->email(),\PDO::PARAM_STR) ;
      $statement->bindValue(':contacts',$etudiants->contacts(),\PDO::PARAM_STR) ;
      $statement->bindValue(':domicile',$etudiants->domicile(),\PDO::PARAM_STR) ;
      $statement->bindValue(':genre',$etudiants->genre(),\PDO::PARAM_STR) ;
      $statement->bindValue(':id',$etudiants->id(),\PDO::PARAM_INT) ;
      $statement->execute() ;
    }

    public function getUnique(int $id)
    {
      try {
          $sql = "SELECT * FROM etudiants WHERE id=$id";
          $statement = $this->db->query($sql);
          $array = $statement->fetch(\PDO::FETCH_ASSOC) ;
          return $array ;
      } catch (\PDOException $e) {
          return $e ;
      }
    }

    public function getListAll()
    {
    }

    public function getList($debut = 0, $offset=1)
    {
        try {
            $sql = "SELECT numero_carte,numero_bac,nom,prenoms,date_naissance,contacts,id FROM etudiants LIMIT $debut,$offset";
            $statement = $this->db->query($sql);
            $array = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
            return $array ;
        } catch (\PDOException $e) {
            return $e ;
        }
    }

    public function count()
    {
        $sql = 'SELECT COUNT(*) AS etudiants FROM etudiants' ;
        $statement = $this->db->query($sql) ;
        $resultat = $statement->fetch(\PDO::FETCH_ASSOC) ;
        return $resultat['etudiants'] ;
    }

    public function delete(int $id)
    {
      $sql = 'DELETE FROM etudiants WHERE id='.$id ;
      $statement = $this->db->query($sql) ;
    }
}
