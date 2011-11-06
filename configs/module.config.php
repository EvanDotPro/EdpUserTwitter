<?php
return array(
    'di' => array(
        'instance' => array(
            'doctrine' => array(
                'parameters' => array(
                    'evm' => array(
                        'subscribers' => array(
                            'EdpUserTwitter' => 'EdpUserTwitter\Doctrine\Listener'
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
);
