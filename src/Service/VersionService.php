<?php
/**
 * Created by PhpStorm.
 * User: Seegurke
 * Date: 12.11.2018
 * Time: 15:18
 */

namespace App\Service;


use App\Entity\Protocol;
use App\Entity\ProtocolVersion;

class VersionService
{
    public function getLatestVersion(Protocol $protocol): ProtocolVersion
    {
        return null;
    }
}