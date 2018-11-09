<?php
namespace Library\Models ;

class Displayer extends OldManager
{
    public function __construct(string $module, $dao, $dbname)
    {
        parent::__constructor(lcfirst($module), $dao, $dbname) ;
    }


    public function display(array $data,string $module,string $width='100',array $indesirables = [],string $board=null):string
    {
        $html = "" ;
        if (!empty($data)):
        $champs = $this->champUtiles($indesirables) ;
        $entete = "<tr>" ;
        foreach ($champs as $ch):
            $entete .= "<th scope='col'>".strtoupper($ch)."</th>" ;
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
            $texte ='<td><a href="%s"><i class="fas fa-edit fa-lg"></i><a/>&nbsp<a href="%s">supprimer<a/></td></tr>' ;
            $body .= sprintf($texte,$linkUpdate,$linkDelete) ;
        endforeach;
        $html = <<<TABLES
       <center>
       <table id='indexTable' class='table table-striped' style='width:{$width}%;'>
        <thead class='thead-dark'>{$entete}</thead>
        <tbody>{$body}</tbody>
       </table>
        {$board}
       </center>
TABLES;
        endif;
        return $html ;
    }

    public function displayWithoutDelete(array $data,string $module,string $width='100',array $indesirables = [],string $board=null):string
    {
        $html = "" ;
        if (!empty($data)):
        $champs = $this->champUtiles($indesirables) ;
        $entete = "<tr>" ;
        foreach ($champs as $ch):
            $entete .= "<th scope='col'>".strtoupper($ch)."</th>" ;
        endforeach;
        $entete .= "<th>Options</th></tr>" ;
        $body = "" ;
        foreach ($data as $item):
            $body .= "<tr>" ;
        foreach ($champs as $ch):
            $body .= "<td> $item[$ch]</td>" ;
        endforeach;
            $linkUpdate = lcfirst($module).'Update-'.$item['id'].'.html' ;
            $texte ='<td><a href="%s"><i class="fas fa-edit fa-lg"></i><a/></td></tr>' ;
            $body .= sprintf($texte,$linkUpdate) ;
        endforeach;
        $html = <<<TABLES
       <center>
       <table id='indexTable' class='table table-striped' style='width:{$width}%;'>
        <thead class='thead-dark'>{$entete}</thead>
        <tbody>{$body}</tbody>
       </table>
        {$board}
       </center>
TABLES;
        endif;
        return $html ;
    }

    public function displayWithShow(array $data,string $module,string $width='100',array $indesirables = [],string $board=null):string{
      $html = "" ;
      if (!empty($data)):
      $champs = $this->champUtiles($indesirables) ;
      $entete = "<tr>" ;
      foreach ($champs as $ch):
          $entete .= "<th scope='col'>".strtoupper($ch)."</th>" ;
      endforeach;
      $entete .= "<th>Options</th></tr>" ;
      $body = "" ;
      foreach ($data as $item):
          $body .= "<tr>" ;
      foreach ($champs as $ch):
          $body .= "<td> $item[$ch]</td>" ;
      endforeach;
          $linkShow = lcfirst($module).'Show-'.$item['id'].'.html' ;
          $texte ='<td><a href="%s">voir<a/></td></tr>' ;
          $body .= sprintf($texte,$linkShow) ;
      endforeach;
      $html = <<<TABLES
     <center>
     <table id='indexTable' class='table table-striped' style='width:{$width}%;'>
      <thead class='thead-dark'>{$entete}</thead>
      <tbody>{$body}</tbody>
     </table>
      {$board}
     </center>
TABLES;
      endif;
      return $html ;
    }

    public function displayWithShowUpdate(array $data,string $module,string $width='100',array $indesirables = [],string $board=null):string
    {
        $html = "" ;
        if (!empty($data)):
        $champs = $this->champUtiles($indesirables) ;
        $entete = "<tr>" ;
        foreach ($champs as $ch):
            $entete .= "<th scope='col'>".strtoupper($ch)."</th>" ;
        endforeach;
        $entete .= "<th>Options</th></tr>" ;
        $body = "" ;
        foreach ($data as $item):
            $body .= "<tr>" ;
        foreach ($champs as $ch):
            $body .= "<td> $item[$ch]</td>" ;
        endforeach;
            $linkUpdate = lcfirst($module).'Update-'.$item['id'].'.html' ;
            $linkShow = lcfirst($module).'Show-'.$item['id'].'.html' ;
            $texte ='<td>
                      <a href="%s"><i class="fas fa-edit fa-lg"></i><a/>
                      &nbsp
                      <a href="%s"><i class="fas fa-eye fa-lg"></i><a/>
                     </td>
                     </tr>' ;
            $body .= sprintf($texte,$linkUpdate,$linkShow) ;
        endforeach;
        $html = <<<TABLES
       <center>
       <table id='indexTable' class='table table-striped' style='width:{$width}%;'>
        <thead class='thead-dark'>{$entete}</thead>
        <tbody>{$body}</tbody>
       </table>
        {$board}
       </center>
TABLES;
        endif;
        return $html ;
    }
}
