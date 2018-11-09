<?php
  namespace Applications\Backend\Modules\Parcours ;

use \Library\Models\FormsBuilder ;
use \Library\PdoFactory ;
use \Library\HTTPRequest ;
use \Library\Entities\Parcours ;
use \Library\Error ;

class ParcoursController extends \Library\BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Parcours');
        $this->page->addVar('titre', 'Liste des Parcours') ;
        $this->setView('index');
        $manager = $this->managers->getManagerOf('Semestres_parcours') ;
        $list = $manager->getList() ;
        $this->page->addVar('tableau', $list) ;
    }

    public function executeAdd(HTTPRequest $request)
    {
        $this->page->addVar('title', 'ajout Parcours');
        $this->setView('add');
        $this->page->addVar('uniqid', md5(random_bytes(16)));

        $domaines = $this->managers->getManagerOf('Domaines')->getListForCustomForm();
        $this->page->addVar('domaines', $domaines);
        $formBuilder = new FormsBuilder($this->module(), $this->managers(), $this->managers->dao(), PdoFactory::getDatabaseName());
        $form = $formBuilder->generateWithoutSubmit() ;
        $_SESSION['token'] = $formBuilder->form()->uniqid() ;
        $this->page->addVar('form', $form);

        if ($request->postExists('uniqid')) {
            $post = filter_input_array(INPUT_POST) ;
            $semestres_parcours = new \Library\Entities\Semestres_parcours($post) ;

            if ($semestres_parcours->isValid1()) {
                $this->managers->getManagerOf('Semestres_parcours')->save($semestres_parcours) ;
                $this->app->user()->setFlash($this->textNotify('success', 'assignation du semestre au parcours éffectué avec succès')) ;
                $this->app->httpResponse()->redirect('/met_les_gazs/web/parcours.html');
            } else {
                $message ='une erreur est survenue lors de l\'assignation du semestre au parcours' ;
                $this->app->user()->setFlash($this->textNotify('danger', $message)) ;
                $this->managers->getManagerOf($this->module())->delete($request->sessionTemp('parcours')) ;
            }
        }
    }

    public function executeInsert(HTTPRequest $request)
    {
        $infos = array('grade'  => $request->postData('grade') ,
                     'specialite' => $request->postData('specialite')
                    );
        $parcours = new Parcours($infos) ;
        if ($parcours->isValid()) {
            $this->managers->getManagerOf($this->module())->save($parcours);
            if ($this->radar($request)) {
                echo 'warning' ;
                exit;
            }
            $texte = '<option value="%d">%s</option>' ;
            echo sprintf($texte, $_SESSION['parcours'], $request->postData('nom')) ;
            exit;
        } else {
            $message = 'le parcours n\'est pas valide,veuillez enregistrez des informations correctes' ;
            $this->app->user()->setFlash($this->textNotify('danger', $message)) ;
            echo 'fail' ;
            exit;
        }
    }

    public function executeUpdate(HTTPRequest $request)
    {
        $domaines = $this->managers->getManagerOf('Domaines')->getListForCustomForm();
        $this->page->addVar('domaines', $domaines);
        $this->page->addVar('title', 'modifier Parcours');
        $this->setView('update');
        $formBuilder = new FormsBuilder($this->module(), $this->managers(), $this->managers->dao(), PdoFactory::getDatabaseName());
        $form = $formBuilder->generateWithoutSubmit($request->getData('id')) ;
        $_SESSION['token'] = $formBuilder->form()->uniqid() ;
        $this->page->addVar('form', $form);
        $this->page->addVar('idParcours', $request->getData('id'));
        $this->page->addVar('idSempar', $request->getData('sempar'));

        if ($request->postExists('uniqid')) {
            $post = filter_input_array(INPUT_POST) ;
            $semestres_parcours = new \Library\Entities\Semestres_parcours($post) ;

            if ($semestres_parcours->isValid1()){
                $this->managers->getManagerOf('Semestres_parcours')->save($semestres_parcours) ;
                $this->app->user()->setFlash($this->textNotify('success', 'la modification du parcours a été éffectuée avec succès')) ;
                $this->app->httpResponse()->redirect('/met_les_gazs/web/parcours.html');
            } else {
                $message ='une erreur est survenue lors de l\'assignation du semestre au parcours' ;
                $this->app->user()->setFlash($this->textNotify('danger', $message)) ;
                // $this->managers->getManagerOf($this->module())->delete($request->sessionTemp('parcours')) ;
            }
        }
    }

    public function executeModifier(HTTPRequest $request)
    {
        $infos = array('grade'  => $request->postData('grade') ,
                     'specialite' => $request->postData('specialite'),
                     'id'  => $request->getData('id')
                    );
        $parcours = new Parcours($infos) ;
        if ($parcours->isValid()) {
            $this->managers->getManagerOf($this->module())->save($parcours);
            if ($this->radar($request)) {
                echo 'warning' ;
                exit;
            }
            $texte = '<option value="%d">%s</option>' ;
            echo sprintf($texte, $request->getData('id'), $request->postData('nom')) ;
            exit;
        } else {
            $message = 'le parcours n\'est pas valide,veuillez enregistrez des informations correctes' ;
            $this->app->user()->setFlash($this->textNotify('danger', $message)) ;
            echo 'fail' ;
            exit;
        }
    }

    public function executeDelete(HTTPRequest $request)
    {
        $retour = $this->managers->getManagerOf($this->module())->delete($request->getData('id')) ;
        $link = lcfirst($this->module()).'.html' ;
        $this->app->httpResponse()->redirect($link) ;
    }

    public function executeMaquette(HTTPRequest $request)
    {
      $maquette = $this->managers->getManagerOf($this->module())->getMaquette($request->getData('sempar'));
      $this->page->addVar('maquette', $maquette);
      $this->page->addVar('title', 'maquette du parcours');
      $this->setView('maquette');
    }
}
