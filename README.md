EdpUserTwitter
==============
Version 0.0.1 Created by Evan Coury

Introduction
------------

This is a quick and dirty proof-of-concept on how one could extend my 
[EdpUser](https://github.com/EvanDotPro/EdpUser) ZF2 module.

Requirements
------------

* Zend Framework 2
* [EdpUser](https://github.com/EvanDotPro/EdpUser) (latest master **using
  Zend\Db, not doctrine**).

Installation
------------

Extend the UserBase entity and add the following:

        <?php

        namespace Application\EdpUser\Model;

        use Doctrine\ORM\Mapping as ORM,
            EdpUser\ModelBase\UserBase;

        /**
         * @ORM\Entity
         */
        class User extends UserBase
        {
            /**
             * @ORM\OneToOne(targetEntity="EdpUserTwitter\Model\UserTwitter", mappedBy="user")
             */
            private $twitter;
         
            /**
             * Get twitter.
             *
             * @return twitter
             */
            public function getTwitter()
            {
                return $this->twitter;
            }
         
            /**
             * Set twitter.
             *
             * @param $twitter the value to be set
             */
            public function setTwitter($twitter)
            {
                $this->twitter = $twitter;
                $this->ext('EdpUserTwitter', $twitter);
                return $this;
            }
        }


Also add the following to your Application/configs/module.config.php:

        'doctrine' => array(
            'parameters' => array(
                'config' => array(
                    'metadata_driver_impl' => array(
                        'edpuser_annotationdriver' => array(
                            'namespace'       => 'Application\EdpUser\Model',
                            'paths'           => array(__DIR__ . '/../src/Application/EdpUser/Model'),
                        ),
                    ),
                ),
            ),
        ),
