<?php
 namespace Library;

class Error extends ApplicationComponent
{
    private $pdoError ;

    const ERROR_CARD_MYSQL = array('23000' => 'Aucun doublon n\'est accepté veuillez renseigner à nouveau les champs');
    const ERROR_CARD_POSTGRES = [] ;

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

    public function errorsRapport(){
      preg_match('#SQLSTATE\[([0-9]+)\]#',$this->pdoError()->getMessage(), $matches);
      //verifier si le match appartient au tableau d'erreur d'abord avant de retourner
      return self::ERROR_CARD_MYSQL[$matches[1]] ;
    }

    public function errorRedirect($exception)
    {
        if ($exception instanceof \PDOException and !empty($exception)) {
         $_SESSION['error'] = $exception ;
         header('Location:/met_les_gazs/web/error.html') ;
        }
    }
}
