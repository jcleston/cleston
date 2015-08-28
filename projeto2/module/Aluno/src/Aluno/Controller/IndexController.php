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

}
