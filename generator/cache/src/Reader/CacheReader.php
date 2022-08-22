<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */
namespace Cache\Reader;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class CacheReader
{
    public function getCache(): array
    {
        if (file_exists('/data/deployment/.docker-sdk/shared-services.json')) {
            $data = file_get_contents('/data/deployment/.docker-sdk/shared-services.json');
//            var_dump(json_decode($data, true));die();
            return json_decode($data, true);
        }
    }
}
