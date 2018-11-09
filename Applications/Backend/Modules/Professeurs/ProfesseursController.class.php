<?php
  namespace Applications\Backend\Modules\Professeurs ;

  use \Library\Models\FormsBuilder ;
  use \Library\PdoFactory ;
  use \Library\Pagination ;
  use \Library\Models\Displayer ;
  use \Library\Entities\Professeurs ;

  class ProfesseursController extends \Library\BackController
  {
      public function executeIndex(\Library\HTTPRequest $request)
      {
          $this->page->addVar('title', 'Professeurs');
          $this->setView('index');
          $manager = $this->managers->getManagerOf($this->module()) ;
          $list = $manager->getList() ;
          $displayer = new Displayer($this->module(), $this->managers->dao(), PdoFactory::getDatabaseName());
          $indesirables = ['genre','email','date_naissance'] ;
          $tableau = $displayer->displayWithShowUpdate($list, $this->module(), 90, $indesirables) ;
          $this->page->addVar('titre', 'Liste Professeurs') ;
          $this->page->addVar('tableau', $tableau) ;
      }

      public function executeAdd(\Library\HTTPRequest $request)
      {
          if ($request->postExists('json')) {
              $ecueList = json_decode($request->postData('json'), true) ;
              $professeur = new Professeurs(filter_input_array(INPUT_POST)) ;
              if($professeur->isValid()){
                $annee=$this->managers->getManagerOf('Annees_universitaires')->nowId() ;
                if(empty($annee)){
                  $annee = $request->sessionTemp('now') ;
                }
                $this->managers->getManagerOf($this->module())->save($professeur,$annee,$ecueList) ;
                if($this->radar($request)){
                  $this->app->user()->setFlash($this->textNotify('danger', 'une erreure est survenue')) ;
                  echo 'fail' ;
                  exit;
                }
                $this->app->user()->setFlash($this->textNotify('success', 'enseignant '.$professeur->nom().' enregistré avec success')) ;
                echo 'success';
                exit ;
              }else {
                $this->app->user()->setFlash($this->textNotify('danger', 'le formulaire de données de l\'enseignant a été mal remplis,veuillez le remplir correctement')) ;
                echo 'fail';
                exit ;
              }
          }

          $this->page->addVar('title', 'ajout Professeurs');
          $this->setView('add');
          $formBuilder = new FormsBuilder($this->module(), $this->managers(), $this->managers->dao(), PdoFactory::getDatabaseName());
          $form = $formBuilder->generateWithoutSubmit() ;
          $_SESSION['token'] = $formBuilder->form()->uniqid() ;
          $this->page->addVar('form', $form);
          $ecues = $this->managers->getManagerOf('Ecues')->getListAll() ;
          $this->page->addVar('ecues', $ecues);
      }

      public function executeUpdate(\Library\HTTPRequest $request)
      {

         if ($request->postExists('json')) {
            $manager = $this->managers->getManagerOf($this->module()) ;
            $ecueList = json_decode($request->postData('json'), true) ;
            if(empty($ecueList)){
              $this->app->user()->setFlash($this->textNotify('danger', 'vous devez spécifier les ecues enseignées')) ;
              echo 'fail' ;
              exit;
            }
            $professeur = new Professeurs(filter_input_array(INPUT_POST)) ;
            $professeur->setId($request->getData('id')) ;
            if($professeur->isValid()){
              $annee=$this->managers->getManagerOf('Annees_universitaires')->nowId() ;
              if(empty($annee)){
                $annee = $request->sessionTemp('now') ;
              }
              $manager->save($professeur) ;
              $manager->deleteUnique($professeur->id()) ;
              $manager->addEnseigner($professeur->id(),$ecueList,$annee) ;
              $this->app->user()->setFlash($this->textNotify('success', 'enseignant '.$professeur->nom().' a été modifié avec success')) ;
              echo 'success';
              exit ;
            }else {
              $this->app->user()->setFlash($this->textNotify('danger', 'le formulaire de données de l\'enseignant a été mal remplis,veuillez le remplir correctement')) ;
              echo 'fail';
              exit ;
            }
          }

          $this->page->addVar('title', 'modifier Professeurs');
          $this->setView('update');
          $this->page->addVar('id',$request->getData('id')) ;
          $formBuilder = new FormsBuilder($this->module(), $this->managers(), $this->managers->dao(), PdoFactory::getDatabaseName());

          if ($request->postExists('uniqid')) {
              $retour = $this->processForm($request, 'Professeurs') ;
              if (!empty($retour)) {
                  $form = $formBuilder->generateWithoutSubmit($request->getData('id')) ;
                  $_SESSION['token'] = $formBuilder->form()->uniqid() ;
                  $this->page->addVar('form', $form);
                  $ecues = $this->managers->getManagerOf('Ecues')->getListAll() ;
                  $this->page->addVar('ecues', $ecues);
                  $oldEcues = $this->managers->getManagerOf($this->module())->getEcuesOf($request->getData('id')) ;
                  $this->page->addVar('oldEcues', $oldEcues);
              }
          } else {
              $form = $formBuilder->generateWithoutSubmit($request->getData('id')) ;
              $_SESSION['token']= $formBuilder->form()->uniqid() ;
              $this->page->addVar('form', $form);
              $ecues = $this->managers->getManagerOf('Ecues')->getListAll() ;
              $this->page->addVar('ecues', $ecues);
              $oldEcues = $this->managers->getManagerOf($this->module())->getEcuesOf($request->getData('id')) ;
              $this->page->addVar('oldEcues', $oldEcues);
          }
      }

      public function executeDelete(\Library\HTTPRequest $request)
      {
          $retour = $this->managers->getManagerOf($this->module())->delete($request->getData('id')) ;
          $link = lcfirst($this->module()).'.html' ;
          $this->app->httpResponse()->redirect($link) ;
      }

      public function executeShow(\Library\HTTPRequest $request){
        $this->page->addVar('title', 'fiche Enseignant');
        $this->setView('show');
        $professeur = $this->managers->getManagerOf($this->module())->getUnique($request->getData('id')) ;
        $this->page->addVar('professeur',$professeur) ;
        $ecues = $this->managers->getManagerOf($this->module())->getEcuesOf($request->getData('id')) ;
        $this->page->addVar('ecues', $ecues);
      }
  }
