<?php
namespace EdpUserTwitter\Doctrine;
use Doctrine\Common\EventSubscriber,
    Doctrine\Common\EventArgs,
    Doctrine\ORM\Event\LifecycleEventArgs;

class Listener implements EventSubscriber
{
    public static $twitter;
    
    public function getSubscribedEvents()
    {
        return array('loadClassMetadata');
    }
    
    public function loadClassMetadata(EventArgs $e)
    {
        $mdata = &$e->getClassMetadata();
        if ($mdata->name == 'EdpUser\Model\User') {
            $reflProp = new \ReflectionProperty($this, 'twitter');

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
