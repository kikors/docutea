<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Invoice;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ClientAreaController
 *
 * @package AppBundle\Controller
 *
 * @Route("client-area")
 */
class ClientAreaController extends Controller {

    /**
     * @Route("/main", name="client_area")
     *
     * @return Response
     */
    public function clientAreaMainPageAction() {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render(':user_area:main_page.html.twig', [
            'user' => $user,
        ]);
    }


    /**
     * @Route("invoice-view/{invoice}", name="invoice_view")
     *
     * @param Invoice $invoice
     */
    public function viewInvoiceAction(Invoice $invoice) {
        // You can send the html as you want
        //$html = '<h1>Plain HTML</h1>';

        // but in this case we will render a symfony view !
        // We are in a controller and we can use renderView function which retrieves the html from a view
        // then we send that html to the user.
        $this->returnPDFResponseFromHTML($this->renderView(
            ':configurer:invoice.html.twig',
            [
                'someDataToView' => 'Something',
            ]
        ));
    }

    public function returnPDFResponseFromHTML($html) {
        //set_time_limit(30); uncomment this line according to your needs
        // If you are not in a controller, retrieve of some way the service container and then retrieve it
        $pdf = $this->get("white_october.tcpdf")
            ->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, TRUE, 'UTF-8', FALSE);
        $pdf->SetAuthor('Our Code World');
        $pdf->SetTitle(('Our Code World Title'));
        $pdf->SetSubject('Our Code World Subject');
        $pdf->setFontSubsetting(TRUE);
        $pdf->SetFont('helvetica', '', 11, '', TRUE);
        //$pdf->SetMargins(20,20,40, true);
        $pdf->AddPage();

        $filename = 'ourcodeworld_pdf_demo';

        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = TRUE, $align = '', $autopadding = TRUE);
        $pdf->Output($filename . ".pdf", 'I'); // This will output the PDF as a response directly
    }

}
