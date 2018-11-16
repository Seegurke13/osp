<?php
/**
 * Created by PhpStorm.
 * User: Seegurke
 * Date: 14.11.2018
 * Time: 11:50
 */

namespace App\Controller;


use App\Repository\ProtocolRepository;
use App\Repository\TagRepository;
use Doctrine\Common\Collections\Collection;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class TagController extends Controller
{
    /**
     * @var TagRepository
     */
    private $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @Route("/tag/list")
     * @param UserInterface $user
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function listAction(\Symfony\Component\HttpFoundation\Request $request, UserInterface $user)
    {
        $uid = $user->getUsername();

        $qb = $this->tagRepository->createQueryBuilder('t');
        $names = [];
        $searchterm = $request->query->get('term');
        $result = $qb->where('t.name LIKE :name')
            ->setParameter('name', '%'.$searchterm.'%')
            ->getQuery()
            ->getResult();

        foreach ($result as $entry) {
            $names[] = $entry->getName();
        }

        return $this->json($names);
    }
}