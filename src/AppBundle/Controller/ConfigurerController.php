<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Machine;
use AppBundle\Services\DefaultValues;
use AppBundle\Services\RecomendedPrinter;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ConfigurerController
 * @package AppBundle\Controller
 */
class ConfigurerController extends Controller
{
    /**
     * @Route("/configurer/{machine}", name="configurer")
     * @param Machine|null $machine
     *
     * @return Response
     * @throws Exception
     */
    public function configurerAction(Machine $machine = null)
    {
        $machineList = $this->get('app.services.param_printer_list')->getParamPrinterList($machine);
        $duration = DefaultValues::getDefault($this->getDoctrine()->getRepository('AppBundle:ContractTime'))->getDurationInMonths();
        $pages = ($machine && $machine->getPageRange()->getStart() !== 0) ? $machine->getPageRange()->getStart() : $this->getParameter('default_count_pages');

        return $this->render('configurer/configurador.html.twig',
            [
                'formatList'            => $this->getDoctrine()->getRepository('AppBundle:FormatType')->findAll(),
                'formatSelected'        => DefaultValues::getDefault($this->getDoctrine()->getRepository('AppBundle:FormatType')),
                'chromaList'            => $this->getDoctrine()->getRepository('AppBundle:ChromaType')->findAll(),
                'chromaSelected'        => DefaultValues::getDefault($this->getDoctrine()->getRepository('AppBundle:ChromaType')),
                'rangeSelected'         => $pages,
                'functionalityList'     => $this->getDoctrine()->getRepository('AppBundle:FunctionalityType')->findAll(),
                'functionalitySelected' => DefaultValues::getDefault($this->getDoctrine()->getRepository('AppBundle:FunctionalityType')),
                'durationList'          => $this->getDoctrine()->getRepository('AppBundle:ContractTime')->findAll(),
                'durationSelected'      => DefaultValues::getDefault($this->getDoctrine()->getRepository('AppBundle:ContractTime')),
                'colorPercent'          => $this->getColorPercent($machine),

                'machineList'           => $machineList,
                'recomendedMachine'     => RecomendedPrinter::getPrinter($machineList, $machine),
                'prices'                => $this->get('app.services.calculate_prices_list')->getPricesList(
                    $machineList, $duration,
                    $pages, $this->getColorPercent($machine)
                ),
                'pdfroute' => $this->getParameter('app.path.sheet_files').'/'
            ]);
    }

    /**
     * @param Machine $machine
     * @return int|mixed
     */
    private function getColorPercent($machine)
    {
        if ($machine && $machine->isColor()) {
            return $this->getParameter('default_color_percent');
        }

        return 0;
    }

}
