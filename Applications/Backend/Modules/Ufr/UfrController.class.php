<?php
  namespace Applications\Backend\Modules\Ufr ;
  use \Library\Models\Displayer ;
  use \Library\PdoFactory ;

  class UfrController extends \Library\BackController
  {
    public function executeIndex(\Library\HTTPRequest $request){
      $this->page->addVar('title', 'Ufr');
      $this->setView('index');
      $manager = $this->managers->getManagerOf($this->module()) ;
      $list = $manager->getList() ;
      $displayer = new Displayer($this->module(),$this->managers->dao(),PdoFactory::getDatabaseName()) ;
      $tableau = $displayer->displayWithoutDelete($list,$this->module()) ;
      $this->page->addVar('titre', 'zone ufr') ;
      $this->page->addVar('tableau', $tableau) ;
    }

    public function executeAdd(\Library\HTTPRequest $request){
      $this->page->addVar('title', 'ajout Ufr');
      $this->setView('add');
      if ($request->postExists('uniqid')) {
        $retour = $this->processForm($request, 'Ufr') ;
          if(!empty($retour)){
            $formBuilder = new \Library\Models\FormsBuilder(
            $this->module(),
            $this->managers(),
            $this->managers->dao(),
            \Library\PdoFactory::getDatabaseName(),$retour->erreurs()
            );
            $form = $formBuilder->generate() ;
            $_SESSION['token'] = $formBuilder->form()->uniqid() ;
            $this->page->addVar('form', $form);
          }
      } else {
        $formBuilder = new \Library\Models\FormsBuilder(
        $this->module(),
        $this->managers(),
        $this->managers->dao(),
        \Library\PdoFactory::getDatabaseName()
        );
          $form = $formBuilder->generate() ;
          $_SESSION['token']= $formBuilder->form()->uniqid() ;
          $this->page->addVar('form', $form);
      }
    }

    public function executeUpdate(\Library\HTTPRequest $request){
      $this->page->addVar('title', 'modifier Ufr');
      $this->setView('update');
      if ($request->postExists('uniqid')) {
        $retour = $this->processForm($request, 'Ufr') ;
          if(!empty($retour)){
            $formBuilder = new \Library\Models\FormsBuilder(
            $this->module(),
            $this->managers(),
            $this->managers->dao(),
            \Library\PdoFactory::getDatabaseName(),$retour->erreurs()
            );
            $form = $formBuilder->generate($request->getData('id')) ;
            $_SESSION['token'] = $formBuilder->form()->uniqid() ;
            $this->page->addVar('form', $form);
          }
      } else {
          $formBuilder = new \Library\Models\FormsBuilder(
          $this->module(),
          $this->managers(),
          $this->managers->dao(),
          \Library\PdoFactory::getDatabaseName()
      ) ;
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
