<?php

namespace Applications\Backend\Modules\Dashboard;

class DashboardController extends \Library\BackController
{
  public function executeIndex(\Library\HTTPRequest $request)
  {
    $this->page->addVar('title','Dashboard');
    $this->setView('index');
    /* recuperer en base de donnée les différente entité qui apparaissent dans le dashboard*/
  }
}
?>
