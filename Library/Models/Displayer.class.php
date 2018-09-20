<?php
namespace Library\Models ;

class Displayer extends OldManager
{
    public function __construct(string $module, $dao, $dbname)
    {
        parent::__constructor(lcfirst($module), $dao, $dbname) ;
    }


    public function display(array $data,array $indesirables = [],string $board,string $module):string
    {
        $html = "" ;
        if (!empty($data)):
        $champs = $this->champUtiles($indesirables) ;
        $entete = "<tr>" ;
        foreach ($champs as $ch):
            $entete .= "<th scope='col'>" .strtoupper($ch). "</th>" ;
        endforeach;
        $entete .= "<th>Options</th></tr>" ;
        $body = "" ;
        foreach ($data as $item):
            $body .= "<tr>" ;
        foreach ($champs as $ch):
            $body .= "<td> $item[$ch]</td>" ;
        endforeach;
            $linkUpdate = lcfirst($module).'Update-'.$item['id'].'.html' ;
            $linkDelete = lcfirst($module).'Delete-'.$item['id'].'.html' ;
            $texte ='<td><a href="%s">modifier<a/>&nbsp<a href="%s">supprimer<a/></td></tr>' ;
            $body .= sprintf($texte,$linkUpdate,$linkDelete) ;
        endforeach;
        $html = <<<TABLES
       <table class='table'>
        <thead class='thead-dark'>{$entete}</thead>
        <tbody>{$body}</tbody>
        <tfoot>{$board}</tfoot>
       </table>
TABLES;
        endif;
        return $html ;
    }

}
