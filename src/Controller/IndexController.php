<?php
/**
 * Created by PhpStorm.
 * User: Seegurke
 * Date: 12.11.2018
 * Time: 14:46
 */

namespace App\Controller;


use App\Repository\ProtocolRepository;
use App\Service\ProtocolService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class IndexController extends Controller
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
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        $protocols = $this->protocolService->getProtocols();

        return $this->render('index/index.html.twig', ['protocols' => $protocols]);
    }
}