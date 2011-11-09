<?php
return array(
    'di' => array(
        'instance' => array(
            'doctrine' => array(
                'parameters' => array(
                    'config' => array(
                        'metadata_driver_impl' => array(
                            'edpusertwitter_annotationdriver' => array(
                                'class'           => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                                'namespace'       => 'EdpUserTwitter\Model',
                                'paths'           => array(__DIR__ . '/../src/EdpUserTwitter/Model'),
                                'cache_class'     => 'Doctrine\Common\Cache\ArrayCache',
                            ),
                        ),
                    ),
                ),
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
);
