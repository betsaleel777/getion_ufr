<?php
 namespace Library;

class Error extends ApplicationComponent
{
    private $pdoError ;

    public function __construct($value)
    {
        $this->setPdoError($value) ;
    }

    public function pdoError()
    {
        return $this->pdoError ;
    }

    public function setPdoError($error)
    {
        if ($error instanceof \PDOException) {
            $this->pdoError = $error ;
        }
    }

    public function errorRedirect($exception)
    {
        if ($exception instanceof \PDOException and !empty($exception)) {
         $_SESSION['error'] = $exception ;
         header('Location:/met_les_gazs/web/error.html') ;
        }
    }
}
