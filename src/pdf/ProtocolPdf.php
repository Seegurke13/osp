<?php
/**
 * Created by PhpStorm.
 * User: Seegurke
 * Date: 13.11.2018
 * Time: 13:06
 */

namespace App\Pdf;

use Fpdf\FPDF;

class ProtocolPdf extends FPDF
{
    public function __construct(string $orientation = 'P', string $unit = 'mm', string $size = 'A4')
    {
        parent::__construct($orientation, $unit, $size);
    }
}