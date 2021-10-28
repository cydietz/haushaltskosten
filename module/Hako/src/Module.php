<?php

namespace Hako;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface 
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\SpendingTable::class => function($container) {
                    $tableGateway = $container->get(Model\SpendingTableGateway::class);
                    return new Model\SpendingTable($tableGateway);
                },
                Model\SpendingTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Spending());
                    return new TableGateway('spending', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\HakoController::class => function($container) {
                    return new Controller\HakoController(
                        $container->get(Model\SpendingTable::class)
                    );
                },
            ],
        ];
    }
}
