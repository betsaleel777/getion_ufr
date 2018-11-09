<?php
namespace Library\Models ;

class FormsBuilder extends OldManager
{
    private $managers ;
    private $form ;
    private $request ;

    public function form(){
      return $this->form ;
    }

   // enlever $dao ici mettre $manager dans le parent et faire que le parent cause avec la bd par manager
    public function __construct(string $module, $managers, $dao, $dbname,array $message=array())
    {
        parent::__constructor(lcfirst($module), $dao, $dbname) ;
        $this->managers = $managers ;
        $token = md5(time()*rand(1, 10)) ;
        $this->form = new \Library\Forms($token, 'POST',$message) ;
    }

    //le tableau donnees doit etre un tableau du type $id => $nom
    protected function select(string $nomDuChamp, string $valeur = null, array $donnees = [])
    {
        $labelDuChamp = '<strong>'.str_replace('_',' ',$nomDuChamp).'</strong>' ;
        if (empty($valeur)) {
            $this->form->add('Select', $nomDuChamp)->label($labelDuChamp)
                                                   ->add_class('custom-select')
                                                   ->choices($donnees)
                                                   ->value('choix')  ;
        } else {
            $this->form->add('Select', $nomDuChamp)->label($labelDuChamp)
                                                   ->add_class('custom-select')
                                                   ->choices($donnees)
                                                   ->value($valeur) ;
        }
        return $this->form ;
    }

    protected function is_key(string $nomDuChamp):bool
    {
        $nomDuChamp = $nomDuChamp.'s' ;
        return in_array($nomDuChamp, $this->recupereTable());
    }

    protected function input(string $type, string $nomDuChamp, string $valeur = "")
    {
        $typeName = explode('(', $type)[0] ;
        $labelDuChamp = '<strong>'.str_replace('_',' ',$nomDuChamp).'</strong>' ;

        if ($this->is_key($nomDuChamp)):
        $donnees = $this->managers->getManagerOf(ucfirst($nomDuChamp).'s')->getListAll() ;
        return $this->select($nomDuChamp, $valeur, $donnees);
        endif;
        if ($typeName == 'varchar') {
            $this->form->add('text', $nomDuChamp)->label($labelDuChamp)
                              ->add_class('form-control')
                              ->value($valeur) ;
        } elseif ($typeName == 'text' or $typeName == 'blob') {
            $this->form->add('textarea', $nomDuChamp)->label($labelDuChamp)
                              ->add_class('form-control')
                              ->value($valeur) ;
        } elseif ($typeName == 'date' or $typeName == 'datetime') {
          $this->form->add('Date', $nomDuChamp)->label($labelDuChamp)
                            ->add_class('form-control')
                            ->format('dd/mm/yyy')
                            ->value($valeur) ;

        }elseif ($typeName == 'enum') {
          $labelRadio = explode("','",substr($type,6,-2)) ;
          $tabRadio = [] ;
          foreach ($labelRadio as $key => $value) {
            $tabRadio = array_merge($tabRadio,array($value => $value)) ;
          }
          $this->form->add('radio', $nomDuChamp)->choices($tabRadio)
                                                ->value($valeur) ;
        }
    }

    public function generate(int $id=0):string
    {
        $lesChps = $this->getChampTable() ;
        $champs = $this->champUtiles() ;
        if ($id >=1){
            $data = $this->managers->getManagerOf(ucfirst($this->tableName))->getUnique($id) ;
            foreach ($champs as $ch):
            $type = $lesChps[$ch]['Type'];
            $this->input($type, $ch, $data[$ch]) ;
            endforeach;
        } else {
            foreach ($champs as $ch):
            $type = $lesChps[$ch]['Type'];
            $this->input($type, $ch) ;
            endforeach;
        }
        $this->form->add('submit', 'submit')->value('valider')
                                            ->add_class('btn btn-primary') ;
        return $this->form ;
    }

    public function generateWithoutSubmit(int $id=0):string
    {
        $lesChps = $this->getChampTable() ;
        $champs = $this->champUtiles() ;
        if ($id >=1){
            $data = $this->managers->getManagerOf(ucfirst($this->tableName))->getUnique($id) ;
            foreach ($champs as $ch):
            $type = $lesChps[$ch]['Type'];
            $this->input($type, $ch, $data[$ch]) ;
            endforeach;
        } else {
            foreach ($champs as $ch):
            $type = $lesChps[$ch]['Type'];
            $this->input($type, $ch) ;
            endforeach;
        }
        return $this->form ;
    }

}
