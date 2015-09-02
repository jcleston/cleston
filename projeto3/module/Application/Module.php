<?php

namespace Application;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Application\Model\Usuario;
use Application\Model\UsuarioTable;
use Application\Model\Perfil;
use Application\Model\PerfilTable;

class Module {

    public function onBootstrap(MvcEvent $e) {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        //Garante a rota autenticada
        $application = $e->getApplication();
        $sm = $application->getServiceManager();
        
        //var_dump($application);exit;
        
        $GLOBALS['sm'] = $application->getServiceManager();
        
        if (!$sm->get('AuthService')->hasIdentity()) {
            $e->getApplication()
                    ->getEventManager()
                    ->attach('route', array(
                        $this,
                        'verificaRota'
            ));
        }
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                //Usuário
                'Application\Model\UsuarioTable' => function($sm) {
                    $tableGateway = $sm->get('UsuarioTableGateway');
                    $table = new UsuarioTable($tableGateway);
                    return $table;
                },
                'UsuarioTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Usuario());
                    return new TableGateway('usuario', $dbAdapter, null, $resultSetPrototype);
                },
                //Perfil
                'Application\Model\PerfilTable' => function($sm) {
                    $tableGateway = $sm->get('PerfilTableGateway');
                    $table = new PerfilTable($tableGateway);
                    return $table;
                },
                'PerfilTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Perfil());
                    return new TableGateway('perfil', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

    public function verificaRota(MvcEvent $e) {
        $route = $e->getRouteMatch()->getMatchedRouteName();
        if ($route != "autenticar") {
            $response = $e->getResponse();
            $response->getHeaders()->addHeaderLine('Location', $e->getRequest()->getBaseUrl() . '/autenticar/');
            $response->setStatusCode(404);
            $response->sendHeaders();
            exit;
        }
    }

}
