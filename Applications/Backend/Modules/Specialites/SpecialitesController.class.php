<?php
  namespace Applications\Backend\Modules\Specialites ;
  use \Library\Models\FormsBuilder ;
  use \Library\PdoFactory ;
  use \Library\Pagination ;
  use \Library\Models\Displayer ;

  class SpecialitesController extends \Library\BackController
  {
    public function executeIndex(\Library\HTTPRequest $request){
      $this->page->addVar('title', 'Specialites');
      $this->page->addVar('titre', 'Liste Specialites') ;
      $this->setView('index');
      $manager = $this->managers->getManagerOf($this->module()) ;
      $displayer = new Displayer($this->module(),$this->managers->dao(),PdoFactory::getDatabaseName()) ;
      $list = $manager->getList() ;
      $tableau = $displayer->displayWithoutDelete($list,$this->module(),90) ;
      $this->page->addVar('tableau', $tableau) ;
    }

    public function executeAdd(\Library\HTTPRequest $request){
      $this->page->addVar('title', 'ajout Specialites');
      $this->setView('add');
      $formBuilder = new FormsBuilder($this->module(),$this->managers(),$this->managers->dao(),PdoFactory::getDatabaseName());

      if ($request->postExists('uniqid')) {
        $retour = $this->processForm($request, 'Specialites') ;
          if(!empty($retour)){
          $formBuilder = new FormsBuilder($this->module(),$this->managers(),$this->managers->dao(),PdoFactory::getDatabaseName(),$retour->erreurs());
            $form = $formBuilder->generate() ;
            $_SESSION['token'] = $formBuilder->form()->uniqid() ;
            $this->page->addVar('form', $form);
          }
      } else {
          $form = $formBuilder->generate() ;
          $_SESSION['token']= $formBuilder->form()->uniqid() ;
          $this->page->addVar('form', $form);
      }
    }

    public function executeUpdate(\Library\HTTPRequest $request){
      $this->page->addVar('title', 'modifier Specialites');
      $this->setView('update');
      $formBuilder = new FormsBuilder($this->module(),$this->managers(),$this->managers->dao(),PdoFactory::getDatabaseName());

      if ($request->postExists('uniqid')) {
        $retour = $this->processForm($request, 'Specialites') ;
          if(!empty($retour)){
            $form = $formBuilder->generate($request->getData('id')) ;
            $_SESSION['token'] = $formBuilder->form()->uniqid() ;
            $this->page->addVar('form', $form);
          }
      } else {
          $form = $formBuilder->generate($request->getData('id')) ;
          $_SESSION['token']= $formBuilder->form()->uniqid() ;
          $this->page->addVar('form', $form);
      }
    }

    public function executeDelete(\Library\HTTPRequest $request){
     $retour = $this->managers->getManagerOf($this->module())->delete($request->getData('id')) ;
     $link = lcfirst($this->module()).'.html' ;
     $this->app->httpResponse()->redirect($link) ;
    }
  }
?>
