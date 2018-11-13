<?php
/**
 * Created by PhpStorm.
 * User: Seegurke
 * Date: 13.11.2018
 * Time: 02:49
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SearchController extends Controller
{
    public function searchAction()
    {
        return $this->render('search/search.html.twig', []);
    }
}