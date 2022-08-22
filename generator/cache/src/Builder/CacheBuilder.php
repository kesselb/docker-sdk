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
        $deploymentDir = '/data/deployment';
        $namespace = $projectData['namespace'];
        $projectPath = $projectData['_spryker_project_path'];

        $sharedServiceData = array_fill_keys(array_keys($projectData['services']), $namespace);
        $projectCacheData = [
            'namespace' => $namespace,
            'path' => $projectPath,
            'enabled' => true,
        ];

        file_put_contents(
            $deploymentDir . DS . '.docker-sdk' . DS . $namespace . '.json',
            json_encode($projectCacheData, JSON_PRETTY_PRINT)
        );
        file_put_contents(
            $deploymentDir . DS . '.docker-sdk' . DS . 'shared-services.json',
            json_encode($sharedServiceData, JSON_PRETTY_PRINT)
        );
//        $cacheData = [];

//
//        var_dump(md5($namespace . $projectPath)); die();
//
//        $endpointMap = $projectData['endpointMap'];
//        $endpointDebugMap = $projectData['_endpointDebugMap'];
//        $applications = $projectData['_applications'];
//        $storageData = $projectData['storageData']['hosts'];
//        $services = $projectData['services'];
//        var_dump($sharedServiceData, $projectCacheData);die();
    }
}
