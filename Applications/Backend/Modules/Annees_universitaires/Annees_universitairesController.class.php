<?php
  namespace Applications\Backend\Modules\Annees_universitaires ;
  use \Library\Models\FormsBuilder ;
  use \Library\PdoFactory ;
  use \Library\Pagination ;
  use \Library\Models\Displayer ;

  class Annees_universitairesController extends \Library\BackController
  {
    public function executeIndex(\Library\HTTPRequest $request){
      $this->page->addVar('title', 'Annees_universitaires');
      $this->setView('index');
      $manager = $this->managers->getManagerOf($this->module()) ;
      $list = $manager->getList() ;
      $displayer = new Displayer($this->module(),$this->managers->dao(),PdoFactory::getDatabaseName()) ;
      $tableau = $displayer->displayWithoutDelete($list,$this->module(),80) ;
      $this->page->addVar('titre', 'Liste Annees_universitaires') ;
      $this->page->addVar('tableau', $tableau) ;
    }

    public function executeAdd(\Library\HTTPRequest $request){
      $this->page->addVar('title', 'ajout Annees_universitaires');
      $this->setView('add');
      $formBuilder = new FormsBuilder($this->module(),$this->managers(),$this->managers->dao(),PdoFactory::getDatabaseName());

      if ($request->postExists('uniqid')) {
        $retour = $this->processForm($request, 'Annees_universitaires') ;
          if(!empty($retour)){
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
      $this->page->addVar('title', 'modifier Annees_universitaires');
      $this->setView('update');
      $formBuilder = new FormsBuilder($this->module(),$this->managers(),$this->managers->dao(),PdoFactory::getDatabaseName());

      if ($request->postExists('uniqid')) {
        $retour = $this->processForm($request, 'Annees_universitaires') ;
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
