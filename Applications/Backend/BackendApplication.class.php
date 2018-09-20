<?php

 namespace Applications\Backend;

class BackendApplication extends \Library\Application
{
    public function __construct()
    {
        parent::__construct();
        $this->name = 'Backend' ;
    }

    public function run()
    {
        $_SESSION['functions']=[] ;
        if ($this->user->isAuthenticated()) {
            $controller = $this->getControllers();
        } else {
            $controller = new Modules\Connexion\ConnexionController($this, 'Connexion', 'index');
        }
        $controller->execute();
        $this->httpResponse->setPage($controller->page());

        if ($controller->module() == 'Connexion') {
            $this->httpResponse->sendCon();
        } else {
            $this->httpResponse->send();
        }
    }
}
