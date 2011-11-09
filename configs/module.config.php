<?php
return array(
    'di' => array(
        'instance' => array(
            //'doctrine' => array(
            //    'parameters' => array(
            //        'evm' => array(
            //            'subscribers' => array(
            //                'EdpUserTwitter' => 'EdpUserTwitter\Doctrine\Listener'
            //            )
            //        )
            //    )
            //),
            'doctrine' => array(
                'parameters' => array(
                    'config' => array(
                        'metadata-driver-impl' => array(
                            'edpusertwitter-annotationdriver' => array(
                                'class'           => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                                'namespace'       => 'EdpUserTwitter\Model',
                                'paths'           => array(__DIR__ . '/../src/EdpUserTwitter/Model'),
                                'cache-class'     => 'Doctrine\Common\Cache\ArrayCache',
                                'cache-namespace' => 'edpuser_annotation',
                            )
                        )
                    )
                )
            ),
            'Zend\View\PhpRenderer' => array(
                'parameters' => array(
                    'options'  => array(
                        'script_paths' => array(
                            'usertwitter' => __DIR__ . '/../views',
                        ),
                    ),
                ),
            ),
        ),
    ),
    'EdpUser' => array(
        'extensions' => array(
            'EdpUserTwitter' => array(
                'class'  => 'EdpUserTwitter\Model\UserTwitter',
                'fields' => array(
                    'twitter' => array(
                        'type'       => 'string',
                        'length'     => null,
                        'precision'  => 0,
                        'scale'      => 0,
                        'nullable'   => false,
                        'unique'     => false,
                        'id'         => false
                    ), 
                ), 
            ),
        ),
    ),
);
