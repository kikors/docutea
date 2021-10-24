<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 03/03/2018
 * Time: 23:33
 */

namespace AppBundle\Infraestructure\Services\CreateSalesOrderDoc;


use AppBundle\Entity\SalesOrder;
use AppBundle\Services\CreateSalesOrderDoc;
use Symfony\Bridge\Twig\TwigEngine;
use Twig\Error\Error;
use WhiteOctober\TCPDFBundle\Controller\TCPDFController;

/**
 * Class PDFCreateSalesOrderDoc
 *
 * @package AppBundle\Infraestructure\Services
 */
class PDFCreateSalesOrderDoc implements CreateSalesOrderDoc {

    /**
     * @var
     */
    private $fielPath;

    /**
     * @var
     */
    private $template;

    /**
     * @var \TCPDF
     */
    private $tcpdf;

    /**
     * @var
     */
    private $title;

    /**
     * @var
     */
    private $subject;

    private $tempalting;

    /**
     * PDFCreateSalesOrderDoc constructor.
     *
     * @param TwigEngine $templating
     * @param TCPDFController $tcpdf
     * @param $filePath
     * @param $template
     * @param $title
     * @param $subject
     */
    public function __construct(TwigEngine $templating, TCPDFController $tcpdf, $filePath, $template, $title, $subject) {
        $this->fielPath = $filePath;
        $this->template = $template;
        $this->tcpdf = $tcpdf->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);;
        $this->title = $title;
        $this->subject = $subject;
        $this->tempalting = $templating;
    }


    /**
     * @param SalesOrder $salesOrder
     *
     * @throws Error
     */
    public function create(SalesOrder $salesOrder) {
        $filename = $this->fielPath.$salesOrder->getContractNumber().'_info.pdf';
        $html = $this->tempalting->render(
            'pdf/info_sales_oreder.html.twig', [
                'salesOrder' => $salesOrder,
            ]
        );

        $this->returnPDFResponseFromHTML($html, $filename);
    }

    /**
     * @param $html
     * @param $filename
     */
    private function returnPDFResponseFromHTML($html, $filename) {
        $this->tcpdf->SetTitle($this->title);
        $this->tcpdf->SetSubject($this->subject);
        $this->tcpdf->setFontSubsetting(TRUE);
//        $this->tcpdf->SetFont('helvetica', '', 11, '', TRUE);
        //$pdf->SetMargins(20,20,40, true);
        $this->tcpdf->AddPage();
        $this->tcpdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = TRUE, $align = '', $autopadding = TRUE);
        $this->tcpdf->Output($filename, 'F'); // This will output the PDF as a response directly
    }
}