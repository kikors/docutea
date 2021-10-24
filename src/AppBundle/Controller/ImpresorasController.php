<?php

namespace AppBundle\Controller;

use AppBundle\Services\DefaultValues;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class ImpresorasController
 * @package AppBundle\Controller
 */
class ImpresorasController extends Controller
{

    /**
     * @Route("/impresoras", name="impresoras")
     * @return \Symfony\Component\HttpFoundation\Response|null
     * @throws Exception
     */
    public function impresorasAction()
    {
        $machineList = $this->get('app.services.param_printer_list')->getParamPrinterList();

        return $this->render('impresoras/impresoras.html.twig',
            [
                'formatList' => $this->getDoctrine()->getRepository('AppBundle:FormatType')->findAll(),
                'formatSelected' => DefaultValues::getDefault($this->getDoctrine()->getRepository('AppBundle:FormatType')),
                'chromaList' => $this->getDoctrine()->getRepository('AppBundle:ChromaType')->findAll(),
                'chromaSelected' => DefaultValues::getDefault($this->getDoctrine()->getRepository('AppBundle:ChromaType')),
                'functionalityList' => $this->getDoctrine()->getRepository('AppBundle:FunctionalityType')->findAll(),
                'functionalitySelected' => DefaultValues::getDefault($this->getDoctrine()->getRepository('AppBundle:FunctionalityType')),
                'makerList' => $this->getDoctrine()->getRepository('AppBundle:Maker')->findAll(),
                'makerSelected' => DefaultValues::getDefault($this->getDoctrine()->getRepository('AppBundle:Maker')),

                'machineList' => $machineList,
                'pdfroute' => $this->getParameter('app.path.sheet_files').'/'
            ]);
    }

}
