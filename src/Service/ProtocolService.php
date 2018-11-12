<?php
/**
 * Created by PhpStorm.
 * User: Seegurke
 * Date: 12.11.2018
 * Time: 20:27
 */

namespace App\Service;


use App\Entity\Protocol;
use App\Repository\ProtocolRepository;

class ProtocolService
{
    /**
     * @var ProtocolRepository
     */
    private $protocolRepository;

    public function __construct(ProtocolRepository $protocolRepository)
    {
        $this->protocolRepository = $protocolRepository;
    }

    public function updateProtocol(Protocol $protocol)
    {
        $this->protocolRepository->save($protocol);
    }

    public function getProtocolById(int $id)
    {
    }
}