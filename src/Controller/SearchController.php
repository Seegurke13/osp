<?php
/**
 * Created by PhpStorm.
 * User: Seegurke
 * Date: 13.11.2018
 * Time: 02:49
 */

namespace App\Controller;


use App\Form\SearchType;
use App\Service\ProtocolService;
use App\Service\TagService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class SearchController extends Controller
{
    /**
     * @var Security
     */
    private $security;
    /**
     * @var TagService
     */
    private $tagService;
    /**
     * @var ProtocolService
     */
    private $protocolService;

    public function __construct(ProtocolService $protocolService, TagService $tagService)
    {
        $this->tagService = $tagService;
        $this->protocolService = $protocolService;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/search", name="search")
     */
    public function searchAction(Request $request)
    {
        $searchterm = $request->query->get('search', '');

        $form = $this->createForm(SearchType::class);
        $form->setData(['searchterm' => $searchterm]);
        $form->handleRequest($request);
        $view = $form->createView();

        if ($form->isSubmitted() && $form->isValid()) {
            $searchterm = $form->getData()['searchterm'];
        }

        $protcols = $this->protocolService->getProtocolsBySearchTerm($searchterm);

        return $this->render('search/search.html.twig', ['searchform' => $view, 'protocols' => $protcols]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/search/{tag}", name="search_tag", methods={"GET"})
     */
    public function searchTagAction(string $tag)
    {
        $tagE = $this->tagService->getTagFromTagName($tag);
        $protocols = [];
        if ($tagE !== null)
        {
            $protocols = $this->protocolService->getProtocolsForTag($tagE);
        }

        return $this->render('index/index.html.twig', ['protocols' => $protocols]);
    }
}