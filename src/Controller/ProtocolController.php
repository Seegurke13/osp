<?php

namespace App\Controller;

use App\Entity\Protocol;
use App\Form\ProtocolType;
use App\Model\User;
use App\Repository\ProtocolRepository;
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
     * @Route("/", name="protocol_index", methods="GET")
     * @param ProtocolRepository $protocolRepository
     * @return Response
     */
    public function index(User $user, ProtocolRepository $protocolRepository): Response
    {
        return $this->render('protocol/index.html.twig', ['protocols' => $protocolRepository->findAll()]);
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
            $em = $this->getDoctrine()->getManager();
            $em->persist($protocol);
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
    public function show(Protocol $protocol): Response
    {
        return $this->render('protocol/show.html.twig', ['protocol' => $protocol]);
    }

    /**
     * @Route("/{id}/edit", name="protocol_edit", methods="GET|POST")
     * @param Request $request
     * @param Protocol $protocol
     * @return Response
     */
    public function edit(Request $request, Protocol $protocol): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

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
    public function delete(Request $request, Protocol $protocol): Response
    {
        if ($this->isCsrfTokenValid('delete'.$protocol->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($protocol);
            $em->flush();
        }

        return $this->redirectToRoute('protocol_index');
    }
}
