<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */
namespace Cache\Builder;

class CacheBuilder
{
    public function build(array $projectData): void
    {
        $deploymentDir = '/data/deployment' . DS . '.docker-sdk';
        $namespace = $projectData['namespace'];
        $projectPath = $projectData['_spryker_project_path'];

        $projectCacheData = [
            'namespace' => $namespace,
            'path' => $projectPath,
            'enabled' => true,
        ];
        $sharedServiceData = $this->getSharedServiceData($projectData);

        $this->buildGateway($projectData);
        file_put_contents(
            $deploymentDir  . DS . $namespace . '.json',
            json_encode($projectCacheData, JSON_PRETTY_PRINT)
        );

        file_put_contents(
            $deploymentDir . DS . 'shared-services.json',
            json_encode($sharedServiceData, JSON_PRETTY_PRINT)
        );
    }

    private function getSharedServiceData(array $projectData): array
    {
        $deploymentDir = '/data/deployment' . DS . '.docker-sdk';
        $namespace = $projectData['namespace'];
        $sharedServiceData = array_fill_keys(array_keys($projectData['services']), $namespace);

        if (!file_exists($deploymentDir . DS . 'shared-services.json')) {
            return $sharedServiceData;
        }

        $sharedServiceDataFromFile = file_get_contents($deploymentDir . DS . 'shared-services.json');
        $sharedServiceDataFromFile = json_decode($sharedServiceDataFromFile, true);

        foreach ($sharedServiceData as $serviceName => $projectNamespace) {
            if (array_key_exists($serviceName, $sharedServiceDataFromFile)) {
                $sharedServiceData[$serviceName] = $sharedServiceDataFromFile[$serviceName];
            }
        }

        return $sharedServiceData;
    }

    private function buildGateway(array $projectData)
    {
        $deploymentDir = '/data/deployment' . DS . '.docker-sdk';
        $namespace = $projectData['namespace'];
        $gatewayData = [];

        if (!file_exists($deploymentDir . DS . 'shared-services.json')) {
            $gatewayData = json_decode(file_get_contents($deploymentDir . DS . 'shared-services.json'), true);
        }

        $hosts = array_unique(array_merge($gatewayData[$namespace] ?? [], array_values($projectData['_hosts'])));
        $gatewayData[$namespace] = $hosts;

        file_put_contents(
            $deploymentDir  . DS . 'gateway-data.json',
            json_encode($gatewayData, JSON_PRETTY_PRINT)
        );
    }
}
