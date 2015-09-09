<?php

namespace Curso\Controller;

use Curso\Form\CursoForm;
use Curso\Model\Curso;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    protected $cursoTable;

    public function indexAction() {
        return new ViewModel(array(
            'cursos' => $this->getCursoTable()->fetchAll(),
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
            $curso = $this->getCursoTable()->getCurso($id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('curso', array(
                        'action' => 'index'
            ));
        }
        $form = new CursoForm();
        $form->bind($curso);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($curso->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getCursoTable()->salvarCurso($form->getData());
                return $this->redirect()->toUrl("../index/index");
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function addAction() {
        $form = new CursoForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $curso = new Curso();
            $form->setInputFilter($curso->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $curso->exchangeArray($form->getData());
                $this->getCursoTable()->salvarCurso($curso);
                return $this->redirect()->toUrl("../index/index");
            }
        }
        return array('form' => $form);
    }

    public function getCursoTable() {
        if (!$this->cursoTable) {
            $sm = $this->getServiceLocator();
            $this->cursoTable = $sm->get('Curso\Model\CursoTable');
        }
        return $this->cursoTable;
    }

    public function deleteAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('curso');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Nao');

            if ($del == 'Sim') {
                $id = (int) $request->getPost('id');
                $this->getCursoTable()->deletarCurso($id);
            }

            return $this->redirect()->toUrl("../index");
        }

        return array(
            'id' => $id,
            'curso' => $this->getCursoTable()->getCurso($id)
        );
    }

}
