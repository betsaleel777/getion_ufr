#!/bin/bash
if [[ -n "$1" && -n "$2" ]]; then
  #utilser un regex pour faire une commande de type -m variable
  cd /var/www/html/$1
  mkdir -p Applications/Backend/Modules/$2/Views
  touch Applications/Backend/Modules/$2/Views/{index.php,update.php,add.php}
  touch Applications/Backend/Modules/$2/$2Controller.class.php
  touch Library/Entities/$2.class.php
  touch Library/Models/$2Manager.class.php
  touch Library/Models/$2ManagerPdo.class.php

  cat >Applications/Backend/Modules/$2/$2Controller.class.php<<EOF
<?php
  namespace Applications\Backend\Modules\variable ;

  class variableController extends \Library\BackController
  {
    public function executeIndex(\Library\HTTPRequest \$request){
      \$this->page->addVar('title', 'variable');
      \$this->setView('index');
      \$manager = \$this->managers->getManagerOf(\$this->module()) ;
      \$pagination = new \Library\Pagination(\$manager->count(),\$request->getData('page'));
      \$list = \$manager->getList((int)\$pagination->firstEntry(),(int)\$pagination->objectPerPage()) ;
      \$displayer = new \Library\Models\Displayer(\$this->module(),
      \$this->managers->dao(),
      \Library\PdoFactory::getDatabaseName()) ;
      \$indesirables = [] ;
      \$board = \$pagination->board(lcfirst(\$this->module()).'html') ;
      \$tableau = \$displayer->display(\$list,\$indesirables,\$board,\$this->module()) ;
      \$this->page->addVar('titre', 'Liste variable') ;
      \$this->page->addVar('tableau', \$tableau) ;
    }

    public function executeAdd(\Library\HTTPRequest \$request){
      \$this->page->addVar('title', 'ajout variable');
      \$this->setView('add');
      if (\$request->postExists('uniqid')) {
        \$retour = \$this->processForm(\$request, 'variable') ;
          if(!empty(\$retour)){
            \$formBuilder = new \Library\Models\FormsBuilder(
            \$this->module(),
            \$this->managers(),
            \$this->managers->dao(),
            \Library\PdoFactory::getDatabaseName(),\$retour->erreurs()
            );
            \$form = \$formBuilder->generate() ;
            \$_SESSION['token'] = \$formBuilder->form()->uniqid() ;
            \$this->page->addVar('form', \$form);
          }
      } else {
        \$formBuilder = new \Library\Models\FormsBuilder(
        \$this->module(),
        \$this->managers(),
        \$this->managers->dao(),
        \Library\PdoFactory::getDatabaseName()
        );
          \$form = \$formBuilder->generate() ;
          \$_SESSION['token']= \$formBuilder->form()->uniqid() ;
          \$this->page->addVar('form', \$form);
      }
    }

    public function executeUpdate(\Library\HTTPRequest \$request){
      \$this->page->addVar('title', 'modifier variable');
      \$this->setView('update');
      if (\$request->postExists('uniqid')) {
        \$retour = \$this->processForm(\$request, 'variable') ;
          if(!empty(\$retour)){
            \$formBuilder = new \Library\Models\FormsBuilder(
            \$this->module(),
            \$this->managers(),
            \$this->managers->dao(),
            \Library\PdoFactory::getDatabaseName(),\$retour->erreurs()
            );
            \$form = \$formBuilder->generate(\$request->getData('id')) ;
            \$_SESSION['token'] = \$formBuilder->form()->uniqid() ;
            \$this->page->addVar('form', \$form);
          }
      } else {
          \$formBuilder = new \Library\Models\FormsBuilder(
          \$this->module(),
          \$this->managers(),
          \$this->managers->dao(),
          \Library\PdoFactory::getDatabaseName()
      ) ;
          \$form = \$formBuilder->generate(\$request->getData('id')) ;
          \$_SESSION['token']= \$formBuilder->form()->uniqid() ;
          \$this->page->addVar('form', \$form);
      }
    }

    public function executeDelete(\Library\HTTPRequest \$request){
     \$retour = \$this->managers->getManagerOf(\$this->module())->delete(\$request->getData('id')) ;
     \$link = lcfirst(\$this->module()).'.html' ;
     \$this->app->httpResponse()->redirect(\$link) ;
    }
  }
?>
EOF
  cat >Library/Models/$2Manager.class.php<<EOF
<?php
   namespace Library\Models ;

   abstract class variableManager extends \Library\Manager
   {
     abstract protected function getListAll() ;
     abstract protected function getUnique(int \$id) ;
     abstract protected function getList(\$debut =0,\$offset=1) ; //qui utilise pagination
     abstract protected function count() ;
     abstract protected function delete(int \$id) ;


     public function save(\Library\Entities\variable \$miniscule)
     {
        \$miniscule->isNew()?\$this->add(\$miniscule):\$this->update(\$miniscule) ;
     }
   }
?>
EOF
  cat >Library/Models/$2ManagerPdo.class.php<<EOF
<?php
   namespace Library\Models ;

   class variableManagerPdo extends variableManager
   {
     public function add(\Library\Entities\variable \$miniscule){

     }
     public function update(\Library\Entities\variable \$miniscule){

     }
     public function getUnique(int \$id){
       try {
           \$sql = "SELECT * FROM miniscule WHERE id=\$id";
           \$statement = \$this->db->query(\$sql);
           \$array = \$statement->fetch(\PDO::FETCH_ASSOC) ;
           return \$array ;
       } catch (\PDOException \$e) {
           return \$e ;
       }
     }
     public function getListAll(){
     }
     public function getList(\$debut=0,\$offset=1){
       try {
           \$sql = "SELECT * FROM miniscule LIMIT \$debut,\$offset";
           \$statement = \$this->db->query(\$sql);
           \$array = \$statement->fetchAll(\PDO::FETCH_ASSOC) ;
           return \$array ;
       } catch (\PDOException \$e) {
           return \$e ;
       }
     }
     public function count(){
       \$sql = 'SELECT COUNT(*) AS miniscule FROM miniscule' ;
       \$statement = \$this->db->query(\$sql) ;
       \$resultat = \$statement->fetch(\PDO::FETCH_ASSOC) ;
       return \$resultat['miniscule'] ;
     }
     public function delete(int \$id){
       \$sql = 'DELETE FROM miniscule WHERE id='.\$id ;
       \$statement = \$this->db->query(\$sql) ;
     }
   }
EOF

 cat >Library/Entities/$2.class.php<<EOF
<?php
 namespace Library\Entities ;

 class variable extends \Library\Entity{
 }
EOF
cat >>Applications/Backend/Config/routes.xml<<EOF
<!-- <route url='/projet/web/miniscule\.html' module='variable' action='index' />
<route url='/projet/web/miniscule\.html\?page=([0-9]+)' module='variable' action='index' vars='page' />
<route url='/projet/web/minisculeAdd\.html' module='variable' action='add' />
<route url='/projet/web/minisculeUpdate-([0-9]+)\.html' module='variable' action='update' vars='id' />
<route url='/projet/web/minisculeDelete-([0-9]+)\.html' module='variable' action='delete' vars='id' /> -->
EOF
  sed -i -e "s/variable/$2/g" "Applications/Backend/Config/routes.xml"
  sed -i -e "s/projet/$1/g" "Applications/Backend/Config/routes.xml"
  sed -i -e "s/variable/$2/g" "Applications/Backend/Modules/$2/$2Controller.class.php"
  sed -i -e "s/variable/$2/g" "Library/Models/$2Manager.class.php"
  sed -i -e "s/variable/$2/g" "Library/Models/$2ManagerPdo.class.php"
  sed -i -e "s/variable/$2/g" "Library/Entities/$2.class.php"

  var=$( echo $2 | tr [:upper:] [:lower:])

  sed -i -e "s/miniscule/$var/g" "Library/Models/$2Manager.class.php"
  sed -i -e "s/miniscule/$var/g" "Library/Models/$2ManagerPdo.class.php"
  sed -i -e "s/miniscule/$var/g" "Applications/Backend/Config/routes.xml"
  #ecrire dans tout ces fichiers un code minimal
else
  echo "paramètre érroné Ex soshiki.sh repertoire_de_projet le_nom_du_module"
fi
