<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ChromaType;
use AppBundle\Entity\ContractTime;
use AppBundle\Entity\FormatType;
use AppBundle\Entity\FunctionalityType;
use AppBundle\Entity\Machine;
use AppBundle\Services\RecomendedPrinter;
use AppBundle\Services\TransformMachineArray;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class UpdateConfigurerController
 * @package AppBundle\Controller
 * @Route("/configurer", name="configurer")
 */
class UpdateConfigurerController extends Controller
{

    /**
     * @Route("/update/{format}/{chroma}/{functionality}/{pages}/{duration}/{colorPercent}", name="configurer_selected")
     * @param FormatType $format
     * @param ChromaType $chroma
     * @param FunctionalityType $functionality
     * @param $pages
     * @param ContractTime $duration
     * @param $colorPercent
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function updateAction(FormatType $format, ChromaType $chroma, FunctionalityType $functionality, $pages, ContractTime $duration, $colorPercent)
    {
        $machineList = $this->get('app.services.param_printer_list')->getParamPrinterList(null, $format, $chroma, $functionality, null, $pages);
        if (!$machineList) {

            return new JsonResponse([]);
        }
        $recomended = RecomendedPrinter::getPrinter($machineList);
        if (strtoupper($chroma->getDescription()) !== 'COLOR') {
            $colorPercent = 0;
        }
        if (strtoupper($chroma->getDescription()) === 'COLOR') {
            $colorPercent = ($colorPercent > 15) ? $colorPercent : 15;

        }
        return new JsonResponse([

            'machineList' => TransformMachineArray::transform($machineList),
            'recomended' => $recomended->__toArray(),
            'prices' => $this->get('app.services.calculate_prices_list')->getPricesList($machineList, $duration->getDurationInMonths(), $pages, $colorPercent),
            'pdfroute' => $this->getParameter('app.path.sheet_files').'/'
        ]);
    }

    /**
     * @Route("/update-list/{format}/{chroma}/{functionality}/{pages}/{duration}/{colorPercent}/{machine}", name="configurer_update_list")
     * @param FormatType $format
     * @param ChromaType $chroma
     * @param FunctionalityType $functionality
     * @param $pages
     * @param ContractTime $duration
     * @param $colorPercent
     * @param Machine $machine
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function updateListAction(FormatType $format, ChromaType $chroma, FunctionalityType $functionality, $pages, ContractTime $duration, $colorPercent, Machine $machine)
    {

        $machineList = $this->get('app.services.param_printer_list')->getParamPrinterList($machine, $format, $chroma, $functionality, null, $pages);

        return new JsonResponse([
            'machineList' => TransformMachineArray::transform($machineList),
            'recomended' => $machine->__toArray(),
            'prices' => $this->get('app.services.calculate_prices_list')->getPricesList($machineList, $duration->getDurationInMonths(), $pages, $colorPercent),
            'pdfroute' => $this->getParameter('app.path.sheet_files').'/'
        ]);
    }
}
