<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 04/02/2018
 * Time: 18:43
 */

namespace AppBundle\Services;

use Ivory\CKEditorBundle\Exception\Exception;
use WhiteOctober\TCPDFBundle\Controller\TCPDFController;

/**
 * Class PdfFormatConverter
 *
 * @package AppBundle\Services
 */
class PdfFormatConverter implements FormatConverter {

    /**
     * @var TCPDFController
     */
    private $pdf;

    /**
     * PdfFormatConverter constructor.
     *
     * @param TCPDFController $pdf
     */
    public function __construct(TCPDFController $pdf) {

        $this->pdf = $pdf->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, TRUE, 'UTF-8', FALSE);
        $this->pdf->SetAuthor('Our Code World');
    }


    /**
     * @param $html
     *
     * @return TCPDFController
     */
    protected function convert($html) {

        $this->pdf->SetTitle(('Our Code World Title'));
        $this->pdf->SetSubject('Our Code World Subject');
        $this->pdf->setFontSubsetting(TRUE);
        $this->pdf->SetFont('helvetica', '', 11, '', TRUE);
        //$pdf->SetMargins(20,20,40, true);
        $this->pdf->AddPage();

        $this->pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = TRUE, $align = '', $autopadding = TRUE);

        return $this->pdf;
    }

    /**
     * @param $name
     * @param $html
     *
     * @return mixed|void
     */
    public function export($name, $html) {
        $this->convert($html);
        $this->pdf->Output($name, 'I');
    }
}