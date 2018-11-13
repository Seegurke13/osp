<?php
/**
 * Created by PhpStorm.
 * User: Seegurke
 * Date: 12.11.2018
 * Time: 14:46
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class IndexController extends Controller
{
    public function __construct()
    {
    }

    /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        return $this->render('index/index.html.twig', []);
    }
}