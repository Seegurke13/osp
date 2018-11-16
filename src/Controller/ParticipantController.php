<?php
/**
 * Created by PhpStorm.
 * User: Seegurke
 * Date: 16.11.2018
 * Time: 13:26
 */

namespace App\Controller;


use App\Entity\Participant;
use App\Repository\ParticipantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ParticipantController extends Controller
{
    /**
     * @var ParticipantRepository
     */
    private $participantRepository;

    public function __construct(ParticipantRepository $participantRepository)
    {
        $this->participantRepository = $participantRepository;
    }

    /**
     * @Route("/participant/list/")
     */
    public function listAction(Request $request)
    {
        $names = [];
        $searchterm = $request->query->get('term');
        $qb = $this->participantRepository->createQueryBuilder('participant');
        $result = $qb->where('participant.name LIKE :name')
            ->setParameter('name', '%'.$searchterm.'%')
            ->getQuery()
            ->getResult();
        foreach ($result as $entry) {
            $names[] = $entry->getName();
        }

        return $this->json($names);
    }
}