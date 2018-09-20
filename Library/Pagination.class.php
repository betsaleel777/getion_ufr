<?php

  namespace Library ;

class Pagination
{
    private $totalObject;
    private $firstEntry;
    private $nowPage;
    private $page_number;
    private $objectPerPage;

    const OBJET_PAR_PAGE = 10 ;

    public function __construct($total, $pageActuelle, $objetParPage = self::OBJET_PAR_PAGE)
    {
        if (!empty((int)$total) and !empty((int)$objetParPage)) {
            $this->totalObject = $total ;
            $this->objectPerPage = $objetParPage ;

            $this->page_number = ceil((int)$this->totalObject/(int)$objetParPage) ;

            if (!empty($pageActuelle)) { // Si la variable $_GET['page'] existe...
                $this->nowPage = intval($pageActuelle);

                if ($this->nowPage > $this->page_number) { // Si la valeur de $this->nowPage (le numéro de la page) est plus grande que $nombreDePages...
                    $this->nowPage = $this->page_number;
                }
            } else { // Sinon
          $this->nowPage = 1; // La page actuelle est la n°1
            }

            if ($objetParPage == self::OBJET_PAR_PAGE) {
                $this->firstEntry = ((int)$this->nowPage-1)*(int)self::OBJET_PAR_PAGE ;
            } else {
                $this->firstEntry = ((int)$this->nowPage-1)*(int)$objetParPage ;
            }
        }
    }

    public function board(string $url):string
    {
        $board ='' ;
        if (!empty($this->page_number()) and !empty($this->nowPage())) {
            $board .= '<center><ul class="pagination pagination-sm">' ; //Pour l'affichage, on centre la liste des pages
        for ($i=1; $i<=$this->page_number(); $i++) { //On fait notre boucle
          if ($i==$this->nowPage()) { //Si il s'agit de la page actuelle...
            $board .= '<li class="active"><a href="#">'.$i.'</a></li>';
          } else { //Sinon...
              $board .= '<li><a href="'.$url.'?page='.$i.'">'.$i.'</a></li>';
          }
        }
            $board .= '</ul></center>';
        }
        return $board ;
    }

    public function firstEntry()
    {
        return $this->firstEntry ;
    }

    public function nowPage()
    {
        return $this->nowPage ;
    }

    public function objectPerPage()
    {
        return $this->objectPerPage ;
    }

    public function page_number()
    {
        return $this->page_number ;
    }
}
