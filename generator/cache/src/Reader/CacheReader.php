<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */
namespace Cache\Reader;


class CacheReader
{
    public function getCache(): array
    {
        if (file_exists('/data/deployment/.docker-sdk/shared-services.json')) {
            $data = file_get_contents('/data/deployment/.docker-sdk/shared-services.json');
            return json_decode($data, true);
        }

        return [];
    }

    public function getGatewayData(): array
    {
        if (file_exists('/data/deployment/.docker-sdk/gateway-data.json')) {
            $data = file_get_contents('/data/deployment/.docker-sdk/gateway-data.json');
            return json_decode($data, true);
        }

        return [];
    }
}
