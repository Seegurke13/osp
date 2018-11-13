<?php

namespace App\Controller;

use App\Pdf\ProtocolPdf;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

class PdfController extends Controller
{
    /**
     * @Route("/pdf", name="pdf")
     */
    public function index()
    {
        return $this->render('pdf/index.html.twig', [
            'controller_name' => 'PdfController',
        ]);
    }

    /**
     * @Route("/pdf/create")
     */
    public function createPdf()
    {
        $filename = 'protocols.pdf';

        $pdf = new ProtocolPdf('P','mm','A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,'Hallo Welt!');
        $fileContent = $pdf->Output('S');

        $response = new Response($fileContent);

        // Create the disposition of the file
        $disposition = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $filename
        );

        // Set the content disposition
        $response->headers->set('Content-Disposition', $disposition);

        return $response;
    }
}
