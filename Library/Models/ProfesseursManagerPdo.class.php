<?php
   namespace Library\Models ;

   use \Library\Entities\Professeurs ;

   class ProfesseursManagerPdo extends ProfesseursManager
   {
       public function add(Professeurs $professeurs, array $ecues, string $now)
       {
           $sql = 'INSERT INTO professeurs(nom,prenoms,date_naissance,genre,grade_enseignant,domicile,matricule,email,contacts)
               VALUES(:nom,:prenoms,:date_naiss,:genre,:grade,:domicile,:mat,:email,:contacts)' ;
           $statement = $this->db->prepare($sql);
           $statement->bindValue(':nom', $professeurs->nom(), \PDO::PARAM_STR) ;
           $statement->bindValue(':prenoms', $professeurs->prenoms(), \PDO::PARAM_STR) ;
           $statement->bindValue(':genre', $professeurs->genre(), \PDO::PARAM_STR) ;
           $statement->bindValue(':grade', $professeurs->grade_enseignant(), \PDO::PARAM_STR) ;
           $statement->bindValue(':domicile', $professeurs->domicile(), \PDO::PARAM_STR) ;
           $statement->bindValue(':email', $professeurs->email(), \PDO::PARAM_STR) ;
           $statement->bindValue(':contacts', $professeurs->contacts(), \PDO::PARAM_STR) ;
           $statement->bindValue(':date_naiss', $professeurs->date_naissance(), \PDO::PARAM_STR) ;
           $statement->bindValue(':mat', $professeurs->matricule(), \PDO::PARAM_STR) ;
           $statement->execute() ;
           $id = $this->db->lastInsertId() ;
           $this->addEnseigner($id,$ecues,$now) ;
       }

       public function update(Professeurs $professeurs)
       {
           $sql = 'UPDATE professeurs SET nom=:nom,prenoms=:prenoms,date_naissance=:date_naiss,genre=:genre,domicile=:domicile,
           matricule=:mat,email=:email,contacts=:contacts,grade_enseignant=:grade WHERE id=:id' ;
           $statement = $this->db->prepare($sql);
           $statement->bindValue(':nom', $professeurs->nom(), \PDO::PARAM_STR) ;
           $statement->bindValue(':prenoms', $professeurs->prenoms(), \PDO::PARAM_STR) ;
           $statement->bindValue(':genre', $professeurs->genre(), \PDO::PARAM_STR) ;
           $statement->bindValue(':grade', $professeurs->grade_enseignant(), \PDO::PARAM_STR) ;
           $statement->bindValue(':domicile', $professeurs->domicile(), \PDO::PARAM_STR) ;
           $statement->bindValue(':email', $professeurs->email(), \PDO::PARAM_STR) ;
           $statement->bindValue(':contacts', $professeurs->contacts(), \PDO::PARAM_STR) ;
           $statement->bindValue(':date_naiss', $professeurs->date_naissance(), \PDO::PARAM_STR) ;
           $statement->bindValue(':mat', $professeurs->matricule(), \PDO::PARAM_STR) ;
           $statement->bindValue(':id', $professeurs->id(), \PDO::PARAM_INT) ;
           $statement->execute() ;
       }
       public function getUnique(int $id)
       {
           try {
               $sql = "SELECT * FROM professeurs WHERE id=$id";
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
               $sql = 'SELECT * FROM professeurs';
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
       public function getList()
       {
           try {
               $sql = 'SELECT * FROM professeurs ORDER BY id DESC';
               $statement = $this->db->query($sql);
               $array = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
               return $array ;
           } catch (\PDOException $e) {
               return $e ;
           }
       }
       public function count()
       {
           $sql = 'SELECT COUNT(*) AS professeurs FROM professeurs' ;
           $statement = $this->db->query($sql) ;
           $resultat = $statement->fetch(\PDO::FETCH_ASSOC) ;
           return $resultat['professeurs'] ;
       }
       public function delete(int $id)
       {
           $sql = 'DELETE FROM professeurs WHERE id='.$id ;
           $statement = $this->db->query($sql) ;
       }

       public function search(string $keyword)
       {
           try {
               $sql = 'SELECT * FROM professeurs WHERE nom LIKE :key' ;
               $statement = $this->db->prepare($sql) ;
               $statement->bindValue(':key', $keyword.'%', \PDO::PARAM_STR) ;
               $statement->execute() ;
               $resultat = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
               return $resultat ;
           } catch (\PDOException $e) {
               $_SESSION['MYSQL_ERROR'] = serialize($e) ;
           }
       }

       public function getEcuesOf(int $id)
       {
           try
           {
             $sql = "SELECT enseigner.id,enseigner.ecue,concat(ecues.nom,' ',ecues.code_ecue) AS nom FROM enseigner
                     INNER JOIN ecues ON ecues.id=enseigner.ecue WHERE enseigner.professeur=$id" ;
             $statement = $this->db->query($sql) ;
             $resultat = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
             return $resultat ;
           } catch (\PDOException $e){
             $_SESSION['MYSQL_ERROR'] = serialize($e) ;
           }
       }

       public function deleteUnique(int $id){
         $sql = 'DELETE FROM enseigner WHERE professeur='.$id ;
         $statement = $this->db->query($sql) ;
       }

       public function addEnseigner(int $professeur,array $ecues,string $now){
         try {
           $sql = 'INSERT INTO enseigner(professeur,annee_universitaire,ecue) VALUES(:prof,:annee,:ecue)' ;
           $statement = $this->db->prepare($sql);
           $statement->bindValue(':prof', $professeur, \PDO::PARAM_INT);
           $statement->bindValue(':annee', $now, \PDO::PARAM_INT) ;
           $max = count($ecues) ;
           for ($i=0; $i < $max ; $i++) {
               $statement->bindValue(':ecue', $ecues[$i], \PDO::PARAM_INT) ;
               $statement->execute() ;
            }
         } catch (\PDOException $e) {
          $_SESSION['MYSQL_ERROR'] = serialize($e) ;
         }
      }

      // public function getToShowIt(int $id){
      //   try {
      //     $sql = 'SELECT * FROM professeur' ;
      //     $statement = $this->db->query($sql) ;
      //     $resultat = $statement->fetch(\PDO::FETCH_ASSOC) ;
      //     return $resultat ;
      //   }catch (\PDOException $e){
      //     $_SESSION['MYSQL_ERROR'] = serialize($e) ;
      //   }
      //
      // }
   }
