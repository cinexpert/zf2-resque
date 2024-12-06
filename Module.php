<?php

namespace Zf2Resque;

class Module
{

    public function onBootstrap(\Laminas\Mvc\MvcEvent $e)
    {
        
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Laminas\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Zf2Resque\Service\ResqueWorker' => function ($sm)
                {
                    $QUEUE = getenv('QUEUE');
                    $queues = explode(',', $QUEUE);
                    return new \Zf2Resque\Service\ResqueWorker($queues, $sm);
                }
            ),
        );
    }

}