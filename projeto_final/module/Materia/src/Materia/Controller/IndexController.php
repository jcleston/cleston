<?php

namespace Materia\Controller;

use Materia\Form\MateriaForm;
use Materia\Model\Materia;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    protected $materiaTable;

    public function indexAction() {
        return new ViewModel(array(
            'materias' => $this->getMateriaTable()->fetchAll(),
        ));
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
            $materia = $this->getMateriaTable()->getMateria($id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('materia', array(
                        'action' => 'index'
            ));
        }
        $form = new MateriaForm();
        $form->bind($materia);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($materia->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getMateriaTable()->salvarMateria($form->getData());
                return $this->redirect()->toUrl("../index/index");
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function addAction() {
        $form = new MateriaForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $materia = new Materia();
            $form->setInputFilter($materia->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $materia->exchangeArray($form->getData());
                $this->getMateriaTable()->salvarMateria($materia);
                return $this->redirect()->toUrl("../index/index");
            }
        }
        return array('form' => $form);
    }

    public function getMateriaTable() {
        if (!$this->materiaTable) {
            $sm = $this->getServiceLocator();
            $this->materiaTable = $sm->get('Materia\Model\MateriaTable');
        }
        return $this->materiaTable;
    }

    public function deleteAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('materia');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Nao');

            if ($del == 'Sim') {
                $id = (int) $request->getPost('id');
                $this->getMateriaTable()->deletarMateria($id);
            }

            return $this->redirect()->toUrl("../index");
        }

        return array(
            'id' => $id,
            'materia' => $this->getMateriaTable()->getMateria($id)
        );
    }

}
