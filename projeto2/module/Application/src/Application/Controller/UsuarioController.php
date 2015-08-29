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
    
    
    
    public function editAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (empty($id)) {
            $id = $this->getRequest()->getPost('id');
            if (empty($id)) {
                return $this->redirect()->toUrl('add');
            }
        }
        try {
            $usuario = $this->getUsuarioTable()->getUsuario($id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('application', array(
                        'action' => 'index'
            ));
        }
        $form = new UsuarioForm();
        $form->bind($usuario);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($usuario->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getUsuarioTable()->salvarUsuario($form->getData());
                return $this->redirect()->toRoute('application');
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
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
