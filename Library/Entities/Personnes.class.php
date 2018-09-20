<?php

namespace Library\Entities ;

abstract class Personnes extends \Library\Entity
{
    protected $nom ;
    protected $prenoms ;
    protected $date_naissance ;
    protected $genre ;
    protected $domicile ;
    protected $email  ;
    protected $contacts ;

    const MESSAGE_ERREUR_NOM ='<span style="color:red" >le champ des noms est incorrect ,veuillez renseignez une valeur</span></br>' ;
    const MESSAGE_ERREUR_PRENOM ='<span style="color:red" >le champ des prenoms est incorrect ,veuillez renseignez une valeur</span></br>' ;
    const MESSAGE_ERREUR_NAISSANCE ='<span style="color:red" >le champ date de naissance est invalide ,veuillez renseignez une date valide</span></br>' ;
    const MESSAGE_ERREUR_GENRE ='<span style="color:red" >le champ genre n\'est pas séléctionner ,veuillez selectionner une valeur</span></br>' ;
    const MESSAGE_ERREUR_DOMICILE ='<span style="color:red" >le champ domicile est incorrect ,veuillez renseignez une valeur</span></br>' ;
    const MESSAGE_ERREUR_EMAIL ='<span style="color:red" >le champ des email est incorrect ,veuillez renseignez une valeur</span></br>' ;
    const MESSAGE_ERREUR_CONTACTS ='<span style="color:red" >le champ des contacts est incorrect ,veuillez renseignez une valeur</span></br>' ;

    //accesseurs

    public function nom()
    {
        return $this->nom ;
    }

    public function prenoms()
    {
        return $this->prenoms ;
    }

    public function date_naissance()
    {
        return $this->date_naissance ;
    }

    public function genre()
    {
        return $this->genre ;
    }

    public function domicile()
    {
        return $this->domicile ;
    }

    public function email()
    {
        return $this->email ;
    }

    public function contacts()
    {
        return $this->contacts ;
    }

    //setter
    public function setId($val){
      if(ctype_digit($val))
       {
        $this->id = $val ;
       }
    }

    public function setNom($val)
    {
      if(!empty($val)){
        $this->nom = $val ;
      }else {
        $this->setErreurs(array('nom' => self::MESSAGE_ERREUR_NOM )) ;
      }
    }

    public function setPrenoms($val)
    {
      if(!empty($val)){
        $this->prenoms = $val ;
      }else {
        $this->setErreurs(array('prenoms' => self::MESSAGE_ERREUR_PRENOM )) ;
      }
    }
    public function setDate_naissance($val)
    {
      if(!empty($val)){
        $date = new \DateTime($val) ;
        $this->date_naissance = $date->format('Y-m-d') ;
      }else {
        $this->setErreurs(array('date_naissance' => self::MESSAGE_ERREUR_NAISSANCE)) ;
      }
    }
    public function setGenre($val)
    {
      if(!empty($val)){
        $this->genre = $val ;
      }else {
        $this->setErreurs(array('genre' => self::MESSAGE_ERREUR_GENRE)) ;
      }
    }
    public function setDomicile($val)
    {
      if(!empty($val)){
        $this->domicile = $val ;
      }else {
        $this->setErreurs(array('domicile' => self::MESSAGE_ERREUR_DOMICILE)) ;
      }
    }
    public function setEmail($val)
    {
      if(!empty($val)){
        $this->email = $val ;
      }else {
        $this->setErreurs(array('email' => self::MESSAGE_ERREUR_EMAIL)) ;
      }
    }
    public function setContacts($val)
    {
      if(!empty($val)){
        $this->contacts = $val ;
      }else {
        $this->setErreurs(array('contacts' => self::MESSAGE_ERREUR_CONTACTS)) ;
      }
    }
}
