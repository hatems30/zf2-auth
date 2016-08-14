<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent,
    Zend\Validator\AbstractValidator;

class Module {

    public function onBootstrap(MvcEvent $e) {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $sm = $e->getApplication()->getServiceManager();
        $translator = $sm->get('translator');
        AbstractValidator::setDefaultTranslator($translator);
    }

    public function init(\Zend\ModuleManager\ModuleManager $moduleManager) {
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        $sharedEvents->attach(__NAMESPACE__, 'dispatch', function($e) {

                    $controller = $e->getTarget();
                    $response = $e->getResponse();
                    $routeMatch = $e->getRouteMatch();
                    $controllerName = $routeMatch->getParam('controller');
                    $actionName = $routeMatch->getParam('action');
                    $statusCode = $response->getStatusCode();

                    $controller->layout()->controller = $controllerName;
                    $controller->layout()->action = $actionName;


                    if ($controllerName == "Application\Controller\Index") {
                        if (is_readable(__DIR__ . '/view/layout/layout.phtml')) {
                            $controller->layout('layout/layout');
                        }
                    }  else {
                        if (is_readable(__DIR__ . '/view/layout/layout.phtml')) {
                            $controller->layout('layout/layout');
                        }
                    }
                }, 2);
    }

    public function getConfig() {
        
        
        return  include __DIR__ . '/config/module.config.php';
    
     
                   
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
                'mail.transport' => function (\Zend\ServiceManager\ServiceManager $serviceManager) {
                    $config = $serviceManager->get('Config');
                    $transport = new \Zend\Mail\Transport\Smtp();
                    $transport->setOptions(new \Zend\Mail\Transport\SmtpOptions($config['mail']['transport']['options']));

                    return $transport;
                },
                'Sessions' => function($sm) {
                    $tableGateway = $sm->get('SessionsGateway');
                    $table = new SessionsTable($tableGateway);
                    return $table;
                },
                'SessionsGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Sessions());
                    return new TableGateway('sessions', $dbAdapter, null, $resultSetPrototype);
                },
               
            ),
        );
    }

    public function getViewHelperConfig() {
        return array(
            'factories' => array(
                'email' => function($sm) {
                    $emailHelper = new \Application\View\Helper\Email($sm);
                    return $emailHelper;
                },
                'user' => function($sm) {
                    $userHelper = new \Application\View\Helper\User($sm);
                    return $userHelper;
                },
                'navigation' => function($sm) {
                    $navigationHelper = new \Application\View\Helper\Navigation($sm);
                    return $navigationHelper;
                },
                'companyImages' => function($sm) {
                    $companyModel = $sm->getServiceLocator()->get('Company');
                    $navigationHelper = new \Application\View\Helper\CompanyImages($companyModel);
                    return $navigationHelper;
                },
                'cleanUrl' => function($sm) {
                    $navigationHelper = new \Application\View\Helper\cleanUrl($sm);
                    return $navigationHelper;
                },
                'flashMessage' => function($sm) {
                    $flashmessenger = $sm->getServiceLocator()
                            ->get('ControllerPluginManager')
                            ->get('flashmessenger');

                    $message = new \Application\View\Helper\FlashMessages( );
                    $message->setFlashMessenger($flashmessenger);

                    return $message;
                },
                'reasons' => function($sm) {
                    $reasonsHelper = new \Application\View\Helper\RejectedReasons();
                    return $reasonsHelper;
                },
            ),
        );
    }

}
