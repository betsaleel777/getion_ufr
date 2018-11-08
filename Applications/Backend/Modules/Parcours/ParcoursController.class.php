<?php
  namespace Applications\Backend\Modules\Parcours ;

  class ParcoursController extends \Library\BackController
  {
    public function executeIndex(\Library\HTTPRequest $request){
      $this->page->addVar('title', 'Parcours');
      $this->page->addVar('titre', 'Liste des Parcours') ;
      $this->page->addVar('activate_search', true);
      $this->setView('index');
      $manager = $this->managers->getManagerOf($this->module()) ;
      $pagination = new \Library\Pagination($manager->count(),$request->getData('page'));
      $board = $pagination->board(lcfirst($this->module()).'.html') ;
      $list = $manager->getList((int)$pagination->firstEntry(),(int)$pagination->objectPerPage()) ;
      $displayer = new \Library\Models\Displayer($this->module(),
      $this->managers->dao(),
      \Library\PdoFactory::getDatabaseName()) ;
      $indesirables = [] ;

      if(!empty($request->postData('search'))){
        $statement = $manager->search($request->postData('search')) ;
        $list = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
        if(empty($list)){
          $this->app->user()->setFlash($this->textNotify('info','Aucun parcours retrouvé lors de la recherche')) ;
          $this->app->httpResponse()->redirect('/met_les_gazs/web/parcours.html');
        }
        $this->app->user()->setFlash($this->textNotify('info',$statement->rowCount().'élément(s) retrouvé(s) lors de la recherche')) ;
      }else {
        $list = $manager->getList((int)$pagination->firstEntry(),(int)$pagination->objectPerPage()) ;
      }
      $tableau = $displayer->displayWithoutDelete($list,$board,$this->module(),$indesirables,80) ;
      $this->page->addVar('tableau', $tableau) ;
    }

    public function executeAdd(\Library\HTTPRequest $request){
      $this->page->addVar('title', 'ajout Parcours');
      $this->setView('add');
      if ($request->postExists('uniqid')) {
        $retour = $this->processForm($request, 'Parcours') ;
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
      $this->page->addVar('title', 'modifier Parcours');
      $this->setView('update');
      if ($request->postExists('uniqid')) {
        $retour = $this->processForm($request, 'Parcours') ;
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
