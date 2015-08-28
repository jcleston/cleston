<?php

namespace Application\Controller;

use Application\Form\UsuarioForm;
use Application\Model\Usuario;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UsuarioController extends AbstractActionController {

    private $usuarioTable;

    public function indexAction() {
        return new ViewModel(
                array(
            "usuarios" => $this->getUsuarioTable()->fetchAll()
                )
        );
    }

    public function addAction() {
        $form = new UsuarioForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $usuario = new Usuario();
            $form->setInputFilter($usuario->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $usuario->exchangeArray($form->getData());
                $this->getUsuarioTable()->salvarUsuario($usuario);

                return $this->redirect()->toRoute('application');
            }
        }
        return array('form' => $form);
    }

    public function getUsuarioTable() {
        if (!$this->usuarioTable) {
            $sm = $this->getServiceLocator();
            $this->usuarioTable = $sm->get('Application\Model\UsuarioTable');
        }
        return $this->usuarioTable;
    }

}
