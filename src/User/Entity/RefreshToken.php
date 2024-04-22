<?php

namespace App\User\Entity;

use Gesdinet\JWTRefreshTokenBundle\Entity\RefreshToken as BaseRefreshToken;

/**
 * @ORM\Entity
 * @ORM\Table("refresh_tokens")
 */
class RefreshToken extends BaseRefreshToken
{
}
