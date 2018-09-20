<?php
 namespace Library\Models ;

abstract class OldManager
{
    protected $tableName ;
    protected $db ;
    protected $dbname ;

    public function __constructor(string $nom,$dao,$dbname)
    {
        $this->db =$dao ;
        $this->tableName = $nom ;
        $this->dbname = $dbname ;
    }

    protected function getDriver(){
      return $this->db->getAttribute(\PDO::ATTR_DRIVER_NAME) ;
    }
    //c'est ici que les methode générale telle que recuperetable,getChampTable,champUtiles
    protected function recupereTable()
    {
        if ($this->getDriver() == 'mysql') {
            $result=[] ;
            $dbname = 'Tables_in_'.$this->dbname ;
            $sql = "SHOW TABLES";
            $req = $this->db->query($sql);
            while ($table = $req->fetch(\PDO::FETCH_ASSOC)) {
                $result[]=$table[$dbname] ;
            }
            return $result ;
        } elseif ($driver == 'pgsql') {
        }
    }
    protected function getChampTable()
    {
        if ($this->getDriver() == 'mysql') {
            if (!array_key_exists("getChampTable", $_SESSION["functions"])):
          $_SESSION["functions"]["getChampTable"] = [] ;
            endif;
            if (!array_key_exists($this->tableName, $_SESSION["functions"]["getChampTable"])):
          $lesChamps = [] ;
            $sql = "SHOW COLUMNS FROM {$this->tableName}" ;
            $req = $this->db->prepare($sql);
            $req->execute() ;
            while ($t = $req->fetch(\PDO::FETCH_ASSOC)) {
                $lesChamps[$t["Field"]] = $t;
            }
            $_SESSION["functions"]["getChampTable"][$this->tableName] = $lesChamps ;
            endif;
            return $_SESSION["functions"]["getChampTable"][$this->tableName];
        } elseif ($driver == 'pgsql') {
        }
    }

    //champs utile pourait recevoir un tableau de tri personalisé
    protected function champUtiles(array $indesirables = [])
    {
        $lesChps = $this->getChampTable($this->tableName) ;
        $champs = array_keys($lesChps) ;
        $elts = ['id'] ;
        foreach ($indesirables as $value) {
          $elts[] = $value ;
        }
        foreach ($elts as $element):
          unset($champs[array_search($element, $champs)]);
        endforeach;
        return $champs ;
    }
}
