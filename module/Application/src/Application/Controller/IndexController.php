<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\User;

class IndexController extends AbstractActionController {

    /**
     * landing page
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction() {


        if (!$this->isAllowed('pants', 'wear')) {
            throw new \BjyAuthorize\Exception\UnAuthorizedException('Grow a beard first!');
        }else{
            echo 'You have access ';
        }



        if ($this->zfcUserAuthentication()->hasIdentity()) {
            //get the email of the user
            echo "<b>". $this->zfcUserAuthentication()->getIdentity()->getEmail()."</b>";
            //get the user_id of the user
            echo $this->zfcUserAuthentication()->getIdentity()->getId();
            //get the username of the user
            echo $this->zfcUserAuthentication()->getIdentity()->getUsername();
            //get the display name of the user
            echo $this->zfcUserAuthentication()->getIdentity()->getDisplayname();
        }
    }

    public function testAction() {

        if (!$this->isAllowed('mah', 'mah2')) {
            throw new \BjyAuthorize\Exception\UnAuthorizedException('Grow a beard first!');
        }
    }

// public function indexAction()
}

// class IndexController extends AbstractActionController
