<?php
namespace Aluno\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    protected $alunoTable;
    
    public function indexAction()
    {
        return new ViewModel(array(
            'alunos' => $this->getAlunoTable()->fetchAll(),
        ));
    }
    
    public function getAlunoTable()
    {
    	if (!$this->alunoTable) {
    		$sm = $this->getServiceLocator();
    		$this->alunoTable = $sm->get('Aluno\Model\AlunoTable');
    	}
    	return $this->alunoTable;
    }
}
