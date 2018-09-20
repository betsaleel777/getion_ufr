<?php
/*
Ahoussou Jean-Chris Arnaud

*/
//respect pear notation
 namespace Library;

 class Page extends ApplicationComponent
 {
   protected $contentFile;
   protected $vars = array();

   public function addVar($var, $value)
   {
     if (!is_string($var) || is_numeric($var) || empty($var))
     {
       throw new \InvalidArgumentException('Le nom de la variable doit être une chaine de caractère non nulle');
     }
    $this->vars[$var] = $value;
   }

   public function getGeneratedPage()
   {
     if (!file_exists($this->contentFile))
     {
       throw new \RuntimeException('La vue spécifiée n\'existe pas');
     }
     $user = $this->app->user() ;
     if($user->sessionExists('permissions'))
     {
       $permissionsObject = new Permissions($user->sessionData('permissions')) ;
     }
     extract($this->vars);
     ob_start();
     require $this->contentFile;
     $content = ob_get_clean();
     ob_start();
     require __DIR__.'/../Applications/'.$this->app->name().'/Templates/style.php';
     ob_start();
     require __DIR__.'/../Applications/'.$this->app->name().'/Templates/Layout.php';
     return ob_get_clean();
   }

   public function getConPage()
   {
     if (!file_exists($this->contentFile))
     {
       throw new \RuntimeException('La page de connexion spécifiée n\'existe pas');
     }
     $user = $this->app->user() ;
     extract($this->vars);
     ob_start();
     require $this->contentFile;
     $content = ob_get_clean();
     ob_start();
     require __DIR__.'/../Applications/'.$this->app->name().'/Templates/style.php';
     ob_start();
     require __DIR__.'/../Applications/'.$this->app->name().'/Templates/ConnexionLayout.php';
     return ob_get_clean();

   }

   public function setContentFile($contentFile)
   {
     if (!is_string($contentFile) || empty($contentFile))
     {
       throw new \InvalidArgumentException('La vue spécifiée est invalide');
     }
     $this->contentFile = $contentFile;
   }

}

 ?>
