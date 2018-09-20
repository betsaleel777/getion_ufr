<?php
   //pear notation respected
   namespace Library ;

   class HTTPResponse extends ApplicationComponent
   {
     protected $page ;

     //getter
     public function page():Page
     {
       return $page ;
     }
     //setter
     public function setPage(Page $page)
     {
       $this->page = $page ;
     }


     public function redirect($location)
     {
       header("Location:$location") ;
       exit ;
     }

     public function redirect404()
     {
       $this->page = new Page($this->app);
       $this->page->setContentFile(__DIR__.'/../Errors/404.html');
       $this->addHeader('HTTP/1.0 404 Not Found');
       $this->send();
     }

     public function addHeader($header)
     {
      header($header) ;
     }

     public function sendCon()
     {
       exit($this->page->getConPage()) ;
     }

     public function send()
     {
       exit($this->page->getGeneratedPage()) ;
     }

     public function setCookie($name,$value='',$expire = 0,$path = null,$dommain =null,$secure = false,$httpOnly = true):void
     {
       setcookie($name,$value,$expire,$domain,$secure,$httpOnly) ;
     }

   }


?>
