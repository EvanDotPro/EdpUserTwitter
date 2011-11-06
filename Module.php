<?php

namespace EdpUserTwitter;

use Zend\Module\Manager,
    Zend\EventManager\StaticEventManager;

class Module
{
    public function init(Manager $moduleManager)
    {
        $this->initAutoloader();
        $events = StaticEventManager::getInstance();
        $events->attach('EdpUser\Mapper\UserZendDb', 'findByEmail.post', array($this, 'addTwitterToUserModel'));
        $events->attach('EdpUser\Mapper\UserZendDb', 'findByUsername.post', array($this, 'addTwitterToUserModel'));
        $events->attach('EdpUser\Mapper\UserZendDb', 'persist.pre', array($this, 'persistTwitterUsername'));
        $events->attach('EdpUser\Service\User', 'createFromForm', array($this, 'addTwitterFromForm'));
        $events->attach('EdpUser\Form\Register', 'init', array($this, 'addTwitterToUserForm'));
    }

    public function initAutoloader()
    {
        require __DIR__ . '/autoload_register.php';
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/configs/module.config.php';
    }
    
    public function addTwitterToUserModel($e)
    {
        $row = $e->getParam('row');
        $user = $e->getParam('user');
        $user->ext('twitter', $row['twitter']);
    }

    public function addTwitterToUserForm($e)
    {
        $form = $e->getTarget();
        $form->addElement('text', 'twitter', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 128))
            ),
            'required'   => true,
            'label'      => 'Twitter Username',
            'order'      => 305,
        ));
    }

    public function addTwitterFromForm($e)
    {
        $form = $e->getParam('form');
        $user = $e->getParam('user');
        $user->ext('twitter', $form->getValue('twitter'));
    }

    public function persistTwitterUsername($e)
    {
        $data = $e->getParam('data');
        $user = $e->getParam('user');
        $data['twitter'] = $user->ext('twitter');
    }
}
