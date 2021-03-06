<?php

/*
 * This file is part of Monofony.
 *
 * (c) Monofony
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entity\OAuth;

use FOS\OAuthServerBundle\Entity\ClientManager as BaseClientManager;
use FOS\OAuthServerBundle\Model\ClientInterface;

class ClientManager extends BaseClientManager
{
    /**
     * {@inheritdoc}
     */
    public function findClientByPublicId($publicId): ?ClientInterface
    {
        return $this->findClientBy(['randomId' => $publicId]);
    }
}
