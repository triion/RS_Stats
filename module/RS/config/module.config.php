<?php
//module/RS/config/module.config.php
return array(
    'doctrine' => array(
        'driver' => array(
            'RS_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/RS/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                     'RS\Entity' =>  'RS_driver'
                ),
            ),
        ),
    ),                 
);