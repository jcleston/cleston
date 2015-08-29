<?php

namespace Aluno\Controller;

use Aluno\Form\AlunoForm;
use Aluno\Model\Aluno;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    protected $alunoTable;

    public function indexAction() {
        return new ViewModel(array(
            'alunos' => $this->getAlunoTable()->fetchAll(),
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
            $aluno = $this->getAlunoTable()->getAluno($id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('aluno', array(
                        'action' => 'index'
            ));
        }
        $form = new AlunoForm();
        $form->bind($aluno);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($aluno->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getAlunoTable()->salvarAluno($form->getData());
                return $this->redirect()->toRoute('aluno');
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function addAction() {
        $form = new AlunoForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $aluno = new Aluno();
            $form->setInputFilter($aluno->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $aluno->exchangeArray($form->getData());
                $this->getAlunoTable()->salvarAluno($aluno);
                return $this->redirect()->toRoute('aluno');
            }
        }
        return array('form' => $form);
    }

    public function getAlunoTable() {
        if (!$this->alunoTable) {
            $sm = $this->getServiceLocator();
            $this->alunoTable = $sm->get('Aluno\Model\AlunoTable');
        }
        return $this->alunoTable;
    }
    
    
    
    
    
    public function deleteAction()
    {
    	$id = (int) $this->params()->fromRoute('id', 0);
    	if (!$id) {
    		return $this->redirect()->toRoute('aluno');
    	}
    
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$del = $request->getPost('del', 'Nao');
    
    		if ($del == 'Sim') {
    			$id = (int) $request->getPost('id');
    			$this->getAlunoTable()->deletarAluno($id);
    		}
    
    		return $this->redirect()->toRoute('aluno');
    	}
    
    	return array(
    			'id'    => $id,
    			'aluno' => $this->getAlunoTable()->getAluno($id)
    	);
    }

}
