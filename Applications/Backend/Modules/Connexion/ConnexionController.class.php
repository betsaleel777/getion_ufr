<?php

 namespace Applications\Backend\Modules\Connexion;

 class ConnexionController extends \Library\BackController
 {
     public function executeIndex(\Library\HTTPRequest $request)
     {
         $this->page->addVar('title', 'Connexion');
         $this->setView('index');
         //$manager = $this->managers->getManagerOf('Utilisateurs') ;
         if ($request->postData('login')=='kilo@gmail.com' and $request->postData('password')=='kilo777') {
             // $userData = array('login' => $request->postData('login'),
             //                   'password' => $request->postData('password')
             //                  ) ;
             // $utilisateur = new Utilisateurs($userData) ;
             //
             // if ($manager->allReadySigned($utilisateur, $user)) {
             //     $manager = $this->managers->getManagerOf('Groupes') ;
             //     $this->app->user()->setAuthenticated(true);
             //     $_SESSION['user'] = serialize($user) ;
             //     $dataPermissions = $manager->getPermissions($user->groupe()) ;
             //     $_SESSION['permissions'] = $dataPermissions ;
             //     $this->app->httpResponse()->redirect('/mets_les_gazs/web/dashboard.html');
             // } else {
             //     $message = 'Le pseudo ou le mot de passe est incorrect.' ;
             //     $this->app->user()->setFlash($this->textNotify('danger',$message));
             // }
             $this->app->user()->setAuthenticated(true);
             $this->app->httpResponse()->redirect('/met_les_gazs/web/dashboard.html');
         }
     }

     public function executeDisconnect()
     {
     }
 }
