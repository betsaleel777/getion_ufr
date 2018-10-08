<?php
  namespace Applications\Backend\Modules\Annees_universitaires ;

  class Annees_universitairesController extends \Library\BackController
  {
    public function executeIndex(\Library\HTTPRequest $request){
      $this->page->addVar('title', 'Annees_universitaires');
      $this->setView('index');
      $manager = $this->managers->getManagerOf($this->module()) ;
      $pagination = new \Library\Pagination($manager->count(),$request->getData('page'));
      $list = $manager->getList((int)$pagination->firstEntry(),(int)$pagination->objectPerPage()) ;
      $displayer = new \Library\Models\Displayer($this->module(),
      $this->managers->dao(),
      \Library\PdoFactory::getDatabaseName()) ;
      $indesirables = [] ;
      $board = $pagination->board(lcfirst($this->module()).'html') ;
      $tableau = $displayer->displayWithoutDelete($list,$board,$this->module(),$indesirables,50) ;
      $this->page->addVar('titre', 'Liste Annees_universitaires') ;
      $this->page->addVar('tableau', $tableau) ;
    }

    public function executeAdd(\Library\HTTPRequest $request){
      $this->page->addVar('title', 'ajout Annees_universitaires');
      $this->setView('add');
      if ($request->postExists('uniqid')) {
        $retour = $this->processForm($request, 'Annees_universitaires') ;
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
      $this->page->addVar('title', 'modifier Annees_universitaires');
      $this->setView('update');
      if ($request->postExists('uniqid')) {
        $retour = $this->processForm($request, 'Annees_universitaires') ;
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
