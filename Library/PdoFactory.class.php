<?php
namespace Library ;

class PdoFactory
{
    public static function parseConfig():array
    {
        $xml = new \DOMDocument ;
        $xml->load(__DIR__.'/../Applications/Backend/Config/databases.xml') ;
        $databaseXml = $xml->getElementsByTagName('database')[0] ;
        $configs = array('dsn' => $databaseXml->getAttribute('dsn') ,
                         'user' => $databaseXml->getAttribute('user') ,
                         'password' => $databaseXml->getAttribute('password'),
                         'dbname' => $databaseXml->getAttribute('dbname')
                      );
        return $configs ;
    }

    public static function getConnexion()
    {
        $configs=self::parseConfig() ;
        $dsn = explode(':', $configs['dsn']) ;
        $staticfonction = 'get'.ucfirst($dsn[0]).'Connexion' ;
        return self::$staticfonction($configs) ;
    }

    public static function getDatabaseName()
    {
        $configs=self::parseConfig() ;
        return $configs['dbname'] ;
    }

    public static function getMysqlConnexion(array $configs)
    {
        try {
            $db = new \PDO($configs['dsn'], $configs['user'], $configs['password']);
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (\PDOException $e) {
            $texte = 'Erreur:'.$e->getMessage().'à la ligne:'.$e->getLine().'Concernant le fichier:'.$e->getFile() ;
            return $texte ;
        }
    }
    public static function getPgsqlConnexion(array $configs)
    {
        try {
            $db = new \PDO($configs['dsn'], $configs['user'], $configs['password']);
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (\PDOException $e) {
            $texte = 'Erreur:'.$e->getMessage().'à la ligne:'.$e->getLine().'Concernant le fichier:'.$e->getFile() ;
            return $texte ;
        }
    }
}
