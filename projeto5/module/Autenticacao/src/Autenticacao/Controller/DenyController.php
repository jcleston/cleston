<?php

namespace Autenticacao\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DenyController extends AbstractActionController {

    public function denyAction(){
        return new ViewModel(array(
        ));
    }

}
