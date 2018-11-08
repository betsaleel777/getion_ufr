<?php
  namespace Applications\Backend\Modules\Ecues ;

  class EcuesController extends \Library\BackController
  {
    public function executeIndex(\Library\HTTPRequest $request){
      $this->page->addVar('title', 'Ecues');
      $this->page->addVar('activate_search', true);
      $this->page->addVar('titre','Liste Ecues') ;
      $this->setView('index');
      $manager = $this->managers->getManagerOf($this->module()) ;
      $displayer = new \Library\Models\Displayer($this->module(),
      $this->managers->dao(),
      \Library\PdoFactory::getDatabaseName()) ;
      $pagination = new \Library\Pagination($manager->count(),$request->getData('page'));
      $board = $pagination->board(lcfirst($this->module()).'html') ;
      $indesirables = [] ;

      if(!empty($request->postData('search'))){
        $statement = $manager->search($request->postData('search')) ;
        $list = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
        if(empty($list)){
          $this->app->user()->setFlash($this->textNotify('info','Aucune ECUE retrouvée lors de la recherche')) ;
          $this->app->httpResponse()->redirect('/met_les_gazs/web/ecues.html');
        }
        $this->app->user()->setFlash($this->textNotify('info',$statement->rowCount().' retrouvé(s) lors de la recherche')) ;
      }else {
        $list = $manager->getList((int)$pagination->firstEntry(),(int)$pagination->objectPerPage()) ;
      }

      $tableau = $displayer->displayWithoutDelete($list,$board,$this->module(),$indesirables,80) ;
      $this->page->addVar('tableau', $tableau) ;
    }

    public function executeAdd(\Library\HTTPRequest $request){
      $this->page->addVar('title', 'ajout Ecues');
      $this->setView('add');
      if ($request->postExists('uniqid')) {
        $retour = $this->processForm($request, 'Ecues') ;
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
      $this->page->addVar('title', 'modifier Ecues');
      $this->setView('update');
      if ($request->postExists('uniqid')) {
        $retour = $this->processForm($request, 'Ecues') ;
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
