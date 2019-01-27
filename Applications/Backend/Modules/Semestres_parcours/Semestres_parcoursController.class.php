<?php
  namespace Applications\Backend\Modules\Semestres_parcours ;

class Semestres_parcoursController extends \Library\BackController
{
    public function executeIndex(\Library\HTTPRequest $request)
    {
        $this->page->addVar('title', 'Semestres_parcours');
        $this->page->addVar('activate_search', true);
        $this->setView('index');
        $manager = $this->managers->getManagerOf($this->module()) ;
        $pagination = new \Library\Pagination($manager->count(), $request->getData('page'));
        $board = $pagination->board(lcfirst($this->module()).'.html') ;
        $this->page->addVar('titre', 'Liste Semestres_parcours') ;
        $this->page->addVar('board', $board) ;

        if(!empty($request->postData('search'))){
          $statement = $manager->search($request->postData('search')) ;
          $list = $statement->fetchAll(\PDO::FETCH_ASSOC) ;
          if(empty($list)){
            $this->app->user()->setFlash($this->textNotify('info','Aucun semestre parcours retrouvé lors de la recherche')) ;
            $this->app->httpResponse()->redirect('/met_les_gazs/web/semestres_parcours.html');
          }
          $this->app->user()->setFlash($this->textNotify('info',$statement->rowCount().' élément(s) retrouvé(s) lors de la recherche')) ;
        }else {
          $list = $manager->getList((int)$pagination->firstEntry(),(int)$pagination->objectPerPage()) ;
        }
        $this->page->addVar('tableau', $list) ;

    }

    public function executeAdd(\Library\HTTPRequest $request)
    {
        $this->page->addVar('title', 'assigner semestre à un ancien parcours');
        $this->setView('add');
        $this->page->addVar('uniqid', md5(random_bytes(16)));
        $parcours = $this->managers->getManagerOf('Parcours')->getListForCustomForm();
        $this->page->addVar('parcours', $parcours) ;
        $domaines = $this->managers->getManagerOf('Domaines')->getListForCustomForm();
        $this->page->addVar('domaines', $domaines);

        if($request->postExists('uniqid')) {
          $post = filter_input_array(INPUT_POST) ;
          $semestres_parcours = new \Library\Entities\Semestres_parcours($post) ;
          if($semestres_parcours->isValid1()){
            $this->managers->getManagerOf($this->module())->save($semestres_parcours) ;
            $this->app->httpResponse()->redirect('/met_les_gazs/web/semestres_parcours.html');
          }else{
            $this->page->addVar('semestre_parcour', $semestres_parcours) ;
          }
        }
    }

    public function executeSemestreAjax(\Library\HTTPRequest $request)
    {
        $semestres = $this->managers->getManagerOf($this->module())->getSemestreOf($request->postData('idParcour')) ;
        $semestres = json_encode($semestres) ;
        print_r($semestres) ;
        exit ;
    }

    public function executeUpdate(\Library\HTTPRequest $request)
    {
        $this->page->addVar('title', 'modifier Semestres_parcours');
        $this->setView('update');
        $uniqid = md5(random_bytes(16));
        $this->page->addVar('uniqid', $uniqid);
        $old_data = $this->managers->getManagerOf($this->module())->getUnique($request->getData('id')) ;
        $this->page->addVar('old', $old_data) ;
        $parcours = $this->managers->getManagerOf('Parcours')->getListForCustomForm();
        $this->page->addVar('parcours', $parcours) ;
        $domaines = $this->managers->getManagerOf('Domaines')->getListForCustomForm();
        $this->page->addVar('domaines', $domaines);

        if ($request->postExists('uniqid')) {
          $post = filter_input_array(INPUT_POST) ;
          $semestres_parcours = new \Library\Entities\Semestres_parcours($post) ;
          $semestres_parcours->setId($request->getData('id')) ;

          if($semestres_parcours->isValid1()){
            $this->managers->getManagerOf($this->module())->save($semestres_parcours) ;
            $this->app->httpResponse()->redirect('/met_les_gazs/web/semestres_parcours.html');
          }else{
            $this->page->addVar('semestre_parcour', $semestres_parcours) ;
          }
        } else {
          $message = 'le jeton a expirer veuillez recharger la page' ;
          $this->page->addVar('tokenMessage', $message) ;
        }
    }

    public function executeDelete(\Library\HTTPRequest $request)
    {
        $retour = $this->managers->getManagerOf($this->module())->delete($request->getData('id')) ;
        $link = lcfirst($this->module()).'.html' ;
        $this->app->httpResponse()->redirect($link) ;
    }
}
?>
