<?php

namespace App\Controller;

use App\Entity\ProtocolVersion;
use App\Form\ProtocolVersionType;
use App\Repository\ProtocolVersionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/protocol/version")
 */
class ProtocolVersionController extends Controller
{
    /**
     * @Route("/", name="protocol_version_index", methods="GET")
     * @param ProtocolVersionRepository $protocolVersionRepository
     * @return Response
     */
    public function index(ProtocolVersionRepository $protocolVersionRepository): Response
    {
        return $this->render('protocol_version/index.html.twig', ['protocol_versions' => $protocolVersionRepository->findAll()]);
    }

    /**
     * @Route("/new", name="protocol_version_new", methods="GET|POST")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $protocolVersion = new ProtocolVersion();
        $form = $this->createForm(ProtocolVersionType::class, $protocolVersion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($protocolVersion);
            $em->flush();

            return $this->redirectToRoute('protocol_version_index');
        }

        return $this->render('protocol_version/new.html.twig', [
            'protocol_version' => $protocolVersion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="protocol_version_show", methods="GET")
     * @param ProtocolVersion $protocolVersion
     * @return Response
     */
    public function show(ProtocolVersion $protocolVersion): Response
    {
        return $this->render('protocol_version/show.html.twig', ['protocol_version' => $protocolVersion]);
    }

    /**
     * @Route("/{id}/edit", name="protocol_version_edit", methods="GET|POST")
     * @param Request $request
     * @param ProtocolVersion $protocolVersion
     * @return Response
     */
    public function edit(Request $request, ProtocolVersion $protocolVersion): Response
    {
        $form = $this->createForm(ProtocolVersionType::class, $protocolVersion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('protocol_version_index', ['id' => $protocolVersion->getId()]);
        }

        return $this->render('protocol_version/edit.html.twig', [
            'protocol_version' => $protocolVersion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="protocol_version_delete", methods="DELETE")
     * @param Request $request
     * @param ProtocolVersion $protocolVersion
     * @return Response
     */
    public function delete(Request $request, ProtocolVersion $protocolVersion): Response
    {
        if ($this->isCsrfTokenValid('delete'.$protocolVersion->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($protocolVersion);
            $em->flush();
        }

        return $this->redirectToRoute('protocol_version_index');
    }
}
