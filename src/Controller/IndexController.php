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

class IndexController extends Controller
{
    public function __construct()
    {
    }

    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->json('test');
    }
}