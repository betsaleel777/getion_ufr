<?php
   namespace Library\Models ;

   class ProfesseursManagerPdo extends ProfesseursManager
   {
     public function add(\Library\Entities\Professeurs $professeurs){
       $sql = 'INSERT INTO professeurs(nom,prenoms,date_naissance,genre,domicile,matricule,email,contacts)
               VALUES(:nom,:prenoms,:date_naiss,:genre,:domicile,:mat,:email,:contacts)' ;
       $statement = $this->db->prepare($sql);
       $statement->bindValue(':nom',$professeurs->nom(),\PDO::PARAM_STR) ;
       $statement->bindValue(':prenoms',$professeurs->prenoms(),\PDO::PARAM_STR) ;
       $statement->bindValue(':genre',$professeurs->genre(),\PDO::PARAM_STR) ;
       $statement->bindValue(':domicile',$professeurs->domicile(),\PDO::PARAM_STR) ;
       $statement->bindValue(':email',$professeurs->email(),\PDO::PARAM_STR) ;
       $statement->bindValue(':contacts',$professeurs->contacts(),\PDO::PARAM_STR) ;
       $statement->bindValue(':date_naiss',$professeurs->date_naissance(),\PDO::PARAM_STR) ;
       $statement->bindValue(':mat',$professeurs->matricule(),\PDO::PARAM_STR) ;
       $statement->execute() ;
     }
     public function update(\Library\Entities\Professeurs $professeurs){
       $sql = 'UPDATE professeurs SET nom=:nom,prenoms=:prenoms,date_naissance=:date_naiss,genre=:genre,domicile=:domicile,
       matricule=:mat,email=:email,contacts=:contacts WHERE id=:id' ;
       $statement = $this->db->prepare($sql);
       $statement->bindValue(':nom',$professeurs->nom(),\PDO::PARAM_STR) ;
       $statement->bindValue(':prenoms',$professeurs->prenoms(),\PDO::PARAM_STR) ;
       $statement->bindValue(':genre',$professeurs->genre(),\PDO::PARAM_STR) ;
       $statement->bindValue(':domicile',$professeurs->domicile(),\PDO::PARAM_STR) ;
       $statement->bindValue(':email',$professeurs->email(),\PDO::PARAM_STR) ;
       $statement->bindValue(':contacts',$professeurs->contacts(),\PDO::PARAM_STR) ;
       $statement->bindValue(':date_naiss',$professeurs->date_naissance(),\PDO::PARAM_STR) ;
       $statement->bindValue(':mat',$professeurs->matricule(),\PDO::PARAM_STR) ;
       $statement->bindValue(':id',$professeurs->id(),\PDO::PARAM_INT) ;
       $statement->execute() ;

     }
     public function getUnique(int $id){
       try {
           $sql = "SELECT * FROM professeurs WHERE id=$id";
           $statement = $this->db->query($sql);
           $array = $statement->fetch(\PDO::FETCH_ASSOC) ;
           return $array ;
       } catch (\PDOException $e) {
           return $e ;
       }
     }
     public function getListAll(){
       try {
           $sql = "SELECT * FROM professeurs";
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
           $sql = "SELECT * FROM professeurs LIMIT $debut,$offset";
           $statement = $this->db->query($sql);
           $array = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
           return $array ;
       } catch (\PDOException $e) {
           return $e ;
       }
     }
     public function count(){
       $sql = 'SELECT COUNT(*) AS professeurs FROM professeurs' ;
       $statement = $this->db->query($sql) ;
       $resultat = $statement->fetch(\PDO::FETCH_ASSOC) ;
       return $resultat['professeurs'] ;
     }
     public function delete(int $id){
       $sql = 'DELETE FROM professeurs WHERE id='.$id ;
       $statement = $this->db->query($sql) ;
     }

     public function search(string $keyword){
       try {
         $sql = "SELECT * FROM professeurs WHERE nom LIKE :key" ;
         $statement = $this->db->prepare($sql) ;
         $statement->bindValue(':key',$keyword.'%',\PDO::PARAM_STR) ;
         $statement->execute() ;
         $resultat = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
         return $resultat ;
       } catch (\PDOException $e) {
         $_SESSION['MYSQL_ERROR'] = serialize($e) ;
       }
     }
   }
