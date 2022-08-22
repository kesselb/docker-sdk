<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */
namespace Cache\Reader;

use Symfony\Component\Filesystem\Filesystem;

class CacheReader
{
    public function getCache(): string
    {

//        var_dump((new Filesystem())->readlink('/data/deployment/.docker-sdk'));die();
//        var_dump(scandir('/data/deployment/.docker-sdk'));die();
    }
}
