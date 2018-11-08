<?php
  namespace Applications\Backend\Modules\Ues ;

  use \Library\Entities\Ecues;
  use \Library\Entities\Ues;
  use \Library\Entities\Dispensees;
  use \Library\HTTPRequest ;
  use \Library\Models\Displayer ;
  use \Library\Pagination ;
  use \Library\PdoFactory ;


  class UesController extends \Library\BackController
  {
      public function executeIndex(HTTPRequest $request)
      {
          $this->page->addVar('title', 'Ues');
          $this->page->addVar('activate_search', true);
          $this->page->addVar('titre', 'Liste Ues') ;
          $this->setView('index');
          $manager = $this->managers->getManagerOf($this->module()) ;
          $pagination = new Pagination($manager->count(), $request->getData('page'));
          $board = $pagination->board(lcfirst($this->module()).'.html') ;

          if (!empty($request->postData('search'))) {
              $statement = $manager->search($request->postData('search')) ;
              $list = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
              if (empty($list)) {
                  $this->app->user()->setFlash($this->textNotify('info','Aucune UE retrouvée lors de la recherche')) ;
                  $this->app->httpResponse()->redirect('/met_les_gazs/web/ues.html');
              }
              $this->app->user()->setFlash($this->textNotify('info', $statement->rowCount().' retrouvé(s) lors de la recherche')) ;
          } else {
              $list = $manager->getList((int)$pagination->firstEntry(), (int)$pagination->objectPerPage()) ;
          }
          $this->page->addVar('tableau', $list) ;
      }

      public function executeAdd(HTTPRequest $request)
      {
          $this->page->addVar('title', 'ajout Semestres_parcours');
          $this->setView('add');
          $uniqid = md5(random_bytes(16));
          $this->page->addVar('uniqid', $uniqid);
          $semestre = $this->managers->getManagerOf('Semestres_parcours')->getListForCustomForm();
          $this->page->addVar('semestres', $semestre);
          $annee = $this->managers->getManagerOf('Annees_universitaires')->nowId();
          $this->page->addVar('annee', $annee);

          if ($request->postExists('uniqid')) {
              $data = array('credits' => $request->postData('credits1') ,
                      'td' => (int)$request->postData('td1') ,
                      'tp' => (int)$request->postData('tp1') ,
                      'cm' => $request->postData('cm1') ,
                      'nom' => $request->postData('nomEcue1') ,
                     ) ;
              $ecue1 = new Ecues($data) ;
              $data = array('credits' => $request->postData('credits2') ,
                      'td' => (int)$request->postData('td2') ,
                      'tp' => (int)$request->postData('tp2') ,
                      'cm' => $request->postData('cm2') ,
                      'nom'=> $request->postData('nomEcue2') ,
                     ) ;
              $ecue2 = new Ecues($data) ;
              $ecueTab = [$ecue1,$ecue2] ;
              $data = array('code' => $request->postData('code') ,
                      'nom' => $request->postData('nom') ,
                     ) ;
              $ue = new Ues($data) ;
              $data = array('semestres_parcour' => $request->postData('semestre_parcour'),
                      'annees_universitaire' => $request->postData('annee')
                     ) ;
              $dispensee = new Dispensees($data) ;
              $ecueCorrecte = true ;
              $max = count($ecueTab) ;
              if ($ue->isValid1() and $dispensee->isValid1()) {
                  if (!$ecueTab[0]->isValid1() and !$ecueTab[1]->isValid1()) {
                      $ecueCorrecte = false ;
                  }

                  if ($ecueCorrecte) {
                      //insertion de l'ue
                      $this->managers->getManagerOf($this->module())->save($ue) ;
                      //vérifier si erreur d'insertion de l'ue
                      if ($this->radar($request)) {
                          $this->app->httpResponse()->redirect('/met_les_gazs/web/uesAdd.html');
                      }
                      $idTab = [$request->sessionTemp('ue')] ;
                      //ajout de l'id de l'ue dans l'objet de correspondance ue et semestre_parcour
                      $dispensee->setUe($idTab) ;
                      //enregistrement des ecues de l'ue si elles sont valables
                      $max = count($ecueTab) ;
                      for ($i=0; $i <$max ; $i++) {
                          if ($ecueTab[$i]->isValid1()) {
                              $ecueTab[$i]->setUe($idTab[0]) ;
                              $this->managers->getManagerOf('Ecues')->save($ecueTab[$i]) ;
                          }
                      }
                      //enregistrement de la correspondance ue - semestre_parcour
                      $this->managers->getManagerOf('Dispensees')->save($dispensee) ;
                      //verifier si erreur d'insertion
                      if ($this->radar($request)) {
                          $this->app->httpResponse()->redirect('/met_les_gazs/web/uesAdd.html');
                      }
                      //message de reussite et redirection
                      $this->app->user()->setFlash($this->textNotify('success', 'les valeures ont été enregistrées avec succès')) ;
                      $this->app->httpResponse()->redirect('/met_les_gazs/web/ues.html');
                  } else {
                      $this->app->user()->setFlash($this->textNotify('danger', 'les ecues enregistrées ne sont pas correctes')) ;
                  }
              } else {
                  $this->app->user()->setFlash($this->textNotify('danger', 'les informations concernant l\'ue sont incorrectes ou
          le semestre parcours n\'as pas été sélectionné')) ;
                  $this->page->addVar('erreurs', $ue->customErreurs());
              }
          }
      }

      public function executeUpdate(HTTPRequest $request)
      {
          $this->page->addVar('title', 'modifier Ues');
          $this->setView('update');
          $uniqid = md5(random_bytes(16));
          $this->page->addVar('uniqid', $uniqid);
          $semestre = $this->managers->getManagerOf('Semestres_parcours')->getListForCustomForm();
          $this->page->addVar('semestres', $semestre);
          $ecues = $this->managers->getManagerOf($this->module())->getEcues($request->getData('id'));
          $this->page->addVar('ecues', $ecues);
          $needs = $this->managers->getManagerOf($this->module())->getUniqOtherWay($request->getData('id'));
          $this->page->addvar('needs', $needs) ;
          $annee = $this->managers->getManagerOf('Annees_universitaires')->nowId();
          $this->page->addVar('annee', $annee);

          if ($request->postExists('uniqid')) {
            $data = array('credits' => $request->postData('credits1') ,
                    'td' => (int)$request->postData('td1') ,
                    'tp' => (int)$request->postData('tp1') ,
                    'cm' => $request->postData('cm1') ,
                    'nom'=> $request->postData('nomEcue1') ,
                    'id' => $request->postData('id1')
                   ) ;
            $ecue1 = new Ecues($data) ;
            $data = array('credits' => $request->postData('credits2') ,
                    'td' => (int)$request->postData('td2') ,
                    'tp' => (int)$request->postData('tp2') ,
                    'cm' => $request->postData('cm2') ,
                    'nom'=> $request->postData('nomEcue2') ,
                    'id' => $request->postData('id2')
                   ) ;
            $ecue2 = new Ecues($data) ;
            $ecueTab = [$ecue1,$ecue2] ;
            $data = array('code' => $request->postData('code') ,
                    'nom' => $request->postData('nom') ,
                    'id' => $request->getData('id')
                   ) ;
            $ue = new Ues($data) ;
            $ueId = [$request->getData('id')] ;
            $data = array('semestres_parcour' => $request->postData('semestre_parcour'),
                          'annees_universitaire' => $request->postData('annee'),
                          'id' => $request->postData('dispenseeId'),
                          'ue' => $ueId,
                         ) ;
            $dispensee = new Dispensees($data) ;
            $ecueCorrecte = true ;
            $max = count($ecueTab) ;
            if ($ue->isValid1() and $dispensee->isValid1()) {
                if (!$ecueTab[0]->isValid1() and !$ecueTab[1]->isValid1()) {
                    $ecueCorrecte = false ;
                }

                if ($ecueCorrecte){
                    //insertion de l'ue
                    $this->managers->getManagerOf($this->module())->save($ue) ;
                    //vérifier si erreur d'insertion de l'ue
                    if ($this->radar($request)) {
                        $this->app->httpResponse()->redirect('/met_les_gazs/web/uesAdd.html');
                    }
                    //modification des ecues de l'ue si elles sont valables
                    $max = count($ecueTab) ;
                    for ($i=0; $i <$max ; $i++) {
                        if ($ecueTab[$i]->isValid1()) {
                            $ecueTab[$i]->setUe($ueId[0]) ;
                            $this->managers->getManagerOf('Ecues')->save($ecueTab[$i]) ;
                        }
                    }
                    //enregistrement de la correspondance ue - semestre_parcour
                    $this->managers->getManagerOf('Dispensees')->uniqUpdate($dispensee->id(),$ueId[0]) ;
                    //verifier si erreur d'insertion
                    if ($this->radar($request)){
                        $this->app->httpResponse()->redirect('/met_les_gazs/web/uesAdd.html');
                    }
                    //message de reussite et redirection
                    $this->app->user()->setFlash($this->textNotify('success', 'les valeures ont été enregistrées avec succès')) ;
                    $this->app->httpResponse()->redirect('/met_les_gazs/web/ues.html');
                } else {
                    $this->app->user()->setFlash($this->textNotify('danger', 'les ecues enregistrées ne sont pas correctes')) ;
                }
            } else {
                $this->app->user()->setFlash($this->textNotify('danger', 'les informations concernant l\'ue sont incorrectes ou
        le semestre parcours n\'as pas été sélectionné')) ;
                $this->page->addVar('erreurs', $ue->customErreurs());
            }
          }
      }
  }
