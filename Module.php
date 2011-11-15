<?php

namespace EdpUserTwitter;

use Zend\Module\Manager,
    Zend\Module\Consumer\AutoloaderProvider,
    Zend\EventManager\StaticEventManager;

class Module implements AutoloaderProvider
{
    public function init(Manager $moduleManager)
    {
        $events = StaticEventManager::getInstance();
        $events->attach('EdpUser\Form\Register', 'init', array($this, 'addTwitterToUserForm'));
        $events->attach('EdpUser\Service\User', 'createFromForm', array($this, 'addTwitterFromForm'));
        $events->attach('EdpUser\Mapper\UserDoctrine', 'persist.post', array($this, 'persistUserDoctrine'));
        $events->attach('EdpUser\Mapper\UserDoctrine', 'findByEmail', array($this, 'addTwitterToUser'));
        $events->attach('EdpUser\Mapper\UserDoctrine', 'findByUsername', array($this, 'addTwitterToUser'));
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig($env = null)
    {
        return include __DIR__ . '/configs/module.config.php';
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

    public function addTwitterToUser($e)
    {
        $user = $e->getParam('user');
        if (null !== $user) {
            $user->ext('EdpUserTwitter', $user->getTwitter());
        }
    }

    public function addTwitterFromForm($e)
    {
        $form = $e->getParam('form');
        $user = $e->getParam('user');
        $userTwitter = new Model\UserTwitter($user, $form->getValue('twitter'));
        $user->ext('EdpUserTwitter', $userTwitter); // @TODO: Clean this up
    }
    
    public function persistUserDoctrine($e)
    {
        $user = $e->getParam('user');
        $em = $e->getParam('em');
        $em->flush();// @TODO: Clean this up
        $user->setTwitter($user->ext('EdpUserTwitter')); // @TODO: Clean this up
        $em->persist($user->getTwitter()); // @TODO: Clean this up
    }
}
