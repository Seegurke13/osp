<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Entity\Protocol;
use App\Entity\ProtocolContent;
use App\Entity\Tag;
use App\Form\ProtocolType;
use App\Repository\ProtocolRepository;
use App\Service\ParticipantService;
use App\Service\ProtocolService;
use App\Service\TagService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/protocol")
 */
class ProtocolController extends Controller
{
    /**
     * @var ParticipantService
     */
    private $participantService;
    /**
     * @var TagService
     */
    private $tagService;

    public function __construct(ParticipantService $participantService, TagService $tagService)
    {
        $this->participantService = $participantService;
        $this->tagService = $tagService;
    }

    /**
     * @Route("/", name="protocol_index", methods="GET")
     * @param ProtocolRepository $protocolRepository
     * @return Response
     */
    public function index(ProtocolService $protocolRepository): Response
    {
        $protocols = $protocolRepository->getProtocols();
        return $this->render('protocol/index.html.twig', ['protocols' => $protocols]);
    }

    /**
     * @Route("/new", name="protocol_new", methods="GET|POST")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $protocol = new Protocol();
        $form = $this->createForm(ProtocolType::class, $protocol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $protocol->setCreateAt(new \DateTime());
            $protocol->setCreator($this->participantService->getActualParticipant());
            $tags = $protocol->getTags();
            $tags->map(function (Tag $tag) {
                return $this->tagService->findTag($tag);
            });
            $protocol->setTags($tags);
            $participants = $protocol->getParticipants();
            $participants->map(function (Participant $participant) {
                return $this->participantService->findParticipant($participant);
            });
            $protocol->setParticipants($participants);
            $protocolContent = $protocol->getProtocolContent();
            $em = $this->getDoctrine()->getManager();
            $em->persist($protocol);
            $em->flush();
            foreach ($protocolContent as $item) {
                $item->setProtocol($protocol);
                $em->persist($item);
            }
            $em->flush();

            return $this->redirectToRoute('protocol_index');
        }

        return $this->render('protocol/new.html.twig', [
            'protocol' => $protocol,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="protocol_show", methods="GET")
     * @param Protocol $protocol
     * @return Response
     */
    public function show(ParticipantService $participantService, int $id): Response
    {
        $participant = $participantService->getActualParticipant();
        $protocol = $this->getDoctrine()->getRepository(Protocol::class)->find($id);
        if ($protocol->getCreator() !== $participant || !$protocol->hasParticipant($participant)) {
            $this->createAccessDeniedException();
        }

        return $this->render('protocol/show.html.twig', ['protocol' => $protocol]);

    }

    /**
     * @Route("/{id}/edit", name="protocol_edit", methods="GET|POST")
     * @param Request $request
     * @param Protocol $protocol
     * @return Response
     */
    public function edit(ProtocolRepository $protocolRepository, Request $request, int $id): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $protocol = $protocolRepository->find($id);

        $form = $this->createForm(ProtocolType::class, $protocol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('protocol_index', ['id' => $protocol->getId()]);
        }

        return $this->render('protocol/edit.html.twig', [
            'protocol' => $protocol,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="protocol_delete", methods="DELETE")
     * @param Request $request
     * @param Protocol $protocol
     * @return Response
     */
    public function delete(ProtocolRepository $protocolRepository, Request $request, int $id): Response
    {
        $protocol = $protocolRepository->find($id);

        if ($this->isCsrfTokenValid('delete'.$protocol->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($protocol);
            $em->flush();
        }

        return $this->redirectToRoute('protocol_index');
    }
}
