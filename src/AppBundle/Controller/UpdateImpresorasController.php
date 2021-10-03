<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ChromaType;
use AppBundle\Entity\FormatType;
use AppBundle\Entity\FunctionalityType;
use AppBundle\Entity\Maker;
use AppBundle\Services\RecomendedPrinter;
use AppBundle\Services\TransformMachineArray;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class UpdateImpresorasController
 * @package AppBundle\Controller
 * @Route("/impresoras", name="impresoras")
 */
class UpdateImpresorasController extends Controller
{

    /**
     * @Route("/update/{format}/{chroma}/{functionality}/{maker}", name="impresoras_update")
     * @param FormatType $format
     * @param ChromaType $chroma
     * @param FunctionalityType $functionality
     * @param Maker $maker
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function updateAction(FormatType $format, ChromaType $chroma, FunctionalityType $functionality, Maker $maker)
    {
        $machineList = $this->get('app.services.param_printer_list')->getParamPrinterList(null, $format, $chroma, $functionality, $maker);
        if (!$machineList) {

            return new JsonResponse([]);
        }
        $recomended = RecomendedPrinter::getPrinter($machineList);
        return new JsonResponse([
            'machineList' => TransformMachineArray::transform($machineList),
            'recomended' => $recomended->__toArray(),
            'pdfroute' => $this->getParameter('app.path.sheet_files').'/'
        ]);
    }

}
