<?php

 namespace Applications\Backend\Modules\Error ;

 class ErrorController extends \Library\BackController
 {
     public function executeIndex(\Library\HTTPRequest $request)
     {
         $this->page->addVar('title','Erreur');
         $this->setView('index');
         $this->page->addVar('pdoError', $request->sessionData('error'));
         //si le besoin se presente vous pouvez inserer les erreurs dans la base de données
     }
 }

 ?>
