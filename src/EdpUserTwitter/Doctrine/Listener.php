<?php
namespace EdpUserTwitter\Doctrine;

use Doctrine\Common\EventSubscriber,
    Doctrine\Common\EventArgs,
    Doctrine\ORM\Event\LifecycleEventArgs;

class Listener implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return array('loadClassMetadata', 'postLoad');
    }
    
    public function postLoad(EventArgs $e)
    {
        //var_dump(\EdpUserTwitter\Model\UserTwitter::$twitter);
        //var_dump($this->userTwitter);die();
        $entity = $e->getEntity();
        if (get_class($entity) === 'EdpUser\Model\User') {
            $twitterObject = \EdpUserTwitter\Model\UserTwitter;
            $twitterObject->setTwitter($entity->twitter);
            $entity->ext('twitter', $twitterObject);
        }
        print_r($entity->ext('twitter')->getTwitter());
        die();
    }

    public function loadClassMetadata(EventArgs $e)
    {
        $mdata = $e->getClassMetadata();
        if ($mdata->name == 'EdpUser\Model\User') {
            $reflProp = new \ReflectionProperty('StdObject', 'twitter');

            $mdata->reflFields['twitter'] = $reflProp;
            $mdata->fieldMappings['twitter'] = array(
                'fieldName'  => 'twitter',
                'type'       => 'string',
                'length'     => null,
                'precision'  => 0,
                'scale'      => 0,
                'nullable'   => false,
                'unique'     => false,
                'columnName' => 'twitter',
                'id'         => false
            );
            $mdata->fieldNames['twitter'] = 'twitter';
            $mdata->columnNames['twitter'] = 'twitter';
        }
    }
}
