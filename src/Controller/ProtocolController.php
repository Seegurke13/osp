<?php
/**
 * Created by PhpStorm.
 * User: Seegurke
 * Date: 12.11.2018
 * Time: 16:06
 */

namespace App\Controller;


use App\Entity\Protocol;
use App\Repository\ProtocolRepository;
use App\Service\ProtocolService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ProtocolController extends Controller
{
    /**
     * @var ProtocolService
     */
    private $protocolService;

    public function __construct(ProtocolService $protocolService)
    {
        $this->protocolService = $protocolService;
    }

    /**
     * @Route("/protocol/{id}")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function showAction(int $id)
    {


        return $this->json(["test"]);
    }

    public function updateAction()
    {
        $id = 1;
        $protocol = new Protocol();
        $this->protocolService->getProtocolById($id);
        $this->protocolService->updateProtocol($protocol);
    }

    public function createAction()
    {

    }
}