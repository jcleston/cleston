<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\Time;

class IndexController extends AbstractActionController {

    protected $_objectManager;

    public function indexAction() {
        $times = $this->getObjectManager()->getRepository('\Application\Entity\Time')->findAll();

        return new ViewModel(array('times' => $times));
    }

    public function addAction() {
        if ($this->request->isPost()) {
            $time = new Time();
            $time->setNome($this->getRequest()->getPost('nome'));
            $time->setEstado($this->getRequest()->getPost('estado'));

            $this->getObjectManager()->persist($time);
            $this->getObjectManager()->flush();
            $newId = $time->getId();

            return $this->redirect()->toRoute('home');
        }
        return new ViewModel();
    }

    public function editAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        $time = $this->getObjectManager()->find('\Application\Entity\Time', $id);

        if ($this->request->isPost()) {
            $time->setNome($this->getRequest()->getPost('nome'));
            $time->setEstado($this->getRequest()->getPost('estado'));

            $this->getObjectManager()->persist($time);
            $this->getObjectManager()->flush();

            return $this->redirect()->toRoute('home');
        }

        return new ViewModel(array('time' => $time));
    }

    public function deleteAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        $time = $this->getObjectManager()->find('\Application\Entity\Time', $id);

        if ($this->request->isPost()) {
            $this->getObjectManager()->remove($time);
            $this->getObjectManager()->flush();

            return $this->redirect()->toRoute('home');
        }

        return new ViewModel(array('time' => $time));
    }

    protected function getObjectManager() {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }

}
