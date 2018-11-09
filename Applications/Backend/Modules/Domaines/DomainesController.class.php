<?php
  namespace Applications\Backend\Modules\Domaines ;
  use \Library\Models\FormsBuilder ;
  use \Library\PdoFactory ;
  use \Library\Pagination ;
  use \Library\Models\Displayer ;

  class DomainesController extends \Library\BackController
  {
    public function executeIndex(\Library\HTTPRequest $request){
      $this->page->addVar('title', 'Domaines');
      $this->setView('index');
      $manager = $this->managers->getManagerOf($this->module()) ;
      $list = $manager->getList() ;
      $displayer = new Displayer($this->module(),$this->managers->dao(),PdoFactory::getDatabaseName()) ;
      $tableau = $displayer->displayWithoutDelete($list,$this->module(),90) ;
      $this->page->addVar('titre', 'Liste Domaines') ;
      $this->page->addVar('tableau', $tableau) ;
    }

    public function executeAdd(\Library\HTTPRequest $request){
      $this->page->addVar('title', 'ajout Domaines');
      $this->setView('add');
      $formBuilder = new FormsBuilder($this->module(),$this->managers(),$this->managers->dao(),PdoFactory::getDatabaseName());

      if ($request->postExists('uniqid')) {
        $retour = $this->processForm($request, 'Domaines') ;
          if(!empty($retour)){
            $form = $formBuilder->generate() ;
            $_SESSION['token'] = $formBuilder->form()->uniqid() ;
            $this->page->addVar('form', $form);
          }
      } else {
          $form = $formBuilder->generate() ;
          $_SESSION['token'] = $formBuilder->form()->uniqid() ;
          $this->page->addVar('form', $form);
      }
    }

    public function executeUpdate(\Library\HTTPRequest $request){
      $this->page->addVar('title', 'modifier Domaines');
      $this->setView('update');
      $formBuilder = new FormsBuilder($this->module(),$this->managers(),$this->managers->dao(),PdoFactory::getDatabaseName());

      if ($request->postExists('uniqid')) {
        $retour = $this->processForm($request, 'Domaines') ;
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
