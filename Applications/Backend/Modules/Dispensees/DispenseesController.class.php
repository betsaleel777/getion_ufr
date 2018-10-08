<?php
  namespace Applications\Backend\Modules\Dispensees ;

  class DispenseesController extends \Library\BackController
  {
    public function executeIndex(\Library\HTTPRequest $request){
      $this->page->addVar('title', 'Dispensees');
      $this->setView('index');
      $manager = $this->managers->getManagerOf($this->module()) ;
      $pagination = new \Library\Pagination($manager->count(),$request->getData('page'));
      $list = $manager->getList((int)$pagination->firstEntry(),(int)$pagination->objectPerPage()) ;
      $displayer = new \Library\Models\Displayer($this->module(),
      $this->managers->dao(),
      \Library\PdoFactory::getDatabaseName()) ;
      $indesirables = ['ue'] ;
      $board = $pagination->board(lcfirst($this->module()).'.html') ;
      $tableau = $displayer->displayWithShow($list,$board,$this->module(),$indesirables,80) ;
      $this->page->addVar('titre', 'Maquette actuelle') ;
      $this->page->addVar('tableau', $tableau) ;
    }

    public function executeAdd(\Library\HTTPRequest $request){
      $this->page->addVar('title', 'ajouter des UES dans un semestre parcour');
      $this->setView('add');
      $uniqid = md5(random_bytes(16));
      $this->page->addVar('uniqid', $uniqid);
      $annees = $this->managers->getManagerOf('Annees_universitaires')->getListForCustomForm();
      $this->page->addVar('annees_universitaires', $annees) ;
      $semestres_parcours = $this->managers->getManagerOf('Semestres_parcours')->getListForCustomForm();
      $this->page->addVar('semestres_parcours', $semestres_parcours);
      $ues = $this->managers->getManagerOf('Ues')->getListForCustomForm();
      $this->page->addVar('ues', $ues);
    }

    public function executeEnregistrer(\Library\HTTPRequest $request){

      $json = json_decode($request->postData('json'),true);
      $data = array('semestres_parcour' => $request->postData('semestre') ,
                    'annees_universitaire' => $request->postData('annee') ,
                   );
      $dispensee = new \Library\Entities\Dispensees($data);
      $dispensee->setUe($json) ;
      if($dispensee->isValid1())
      {
        $this->managers->getManagerOf($this->module())->save($dispensee) ;
        $message = 'valeures enregistrées avec succès' ;
        $this->app->user()->setFlash($this->textNotify('success', $message)) ;
        echo 'success' ;
        exit;
      }
      else {
        echo 'echec' ;
        $message = 'les données enregistrées ne sont pas valides' ;
        $this->app->user()->setFlash($this->textNotify('danger', $message)) ;
        exit;
      }
    }

    public function executeShow(\Library\HTTPRequest $request){
      $list = $this->managers->getManagerOf($this->module())->getListShow($request->getData('id')) ;
      $this->page->addVar('lignes', $list);
      $this->setView('show');
    }

    public function executeUpdateShow(\Library\HTTPRequest $request){
      $uniqid = md5(random_bytes(16));
      $this->page->addVar('uniqid', $uniqid);
      $list = $this->managers->getManagerOf('Ues')->getListForCustomForm() ;
      $this->page->addVar('ues', $list);
      $oldInfos = $this->managers->getManagerOf('Ues')->getUnique($request->getData('ue')) ;
      $this->page->addVar('old', $oldInfos);
        $this->setView('updateShow');

      if($request->postExists('uniqid')) {
        if(!empty($request->postData('ue'))){
          $this->managers->getManagerOf($this->module())->uniqUpdate($request->getData('id'),$request->postData('ue')) ;
          $this->app->httpResponse()->redirect('/met_les_gazs/web/dispenseesShow-'.$request->getData('semp').'.html');
        }else{
          $this->page->addVar('message', 'aucune UE sélectionnée') ;
        }
      }
    }
  }
?>
