<?php

namespace AppBundle\Controller;

use AppBundle\Event\NewSalesOrderEvent;
use AppBundle\StaticsClass\Serials;
use AppBundle\StaticsClass\TonerColors;
use DateTime;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class UpdateContractInfoController
 *
 * @package AppBundle\Controller
 * @Route("/contract-info")
 */
class UpdateContractInfoController extends Controller {

    /**
     * @Route("/update/{idMachine}/{colorPercent}/{pages}/{duration}", name="contract_info")
     * @param $idMachine
     * @param $colorPercent
     * @param $pages
     * @param $duration
     *
     * @return JsonResponse
     * @throws Exception* @internal param $idMachine
     */
    public function createContractInfoAction($idMachine, $colorPercent, $pages, $duration) {
        return new JsonResponse([
            $this->contractInfoToArray($idMachine, $colorPercent, $pages, $duration),
        ]);
    }

    /**
     * @param $idMachine
     * @param $colorPercent
     * @param $pages
     * @param $duration
     *
     * @return array
     * @throws Exception
     */
    private function contractInfoToArray($idMachine, $colorPercent, $pages, $duration) {
        $machineRepository = $this->getDoctrine()->getRepository('AppBundle:Machine');
        $salesOrderManager = $this->get('app.services.sales_order_manager');
        $machine = $machineRepository->findOrFail($idMachine);

        $salesOrder = $salesOrderManager->createNew(new NewSalesOrderEvent($machine, $duration, $pages, $colorPercent, $this->getUser(), ''));

        $machine = $machineRepository->findOrFail($idMachine);
        $now = new DateTime();

        $fixedPrice = $salesOrder->getFixedPrice();
        $variablePrice = $salesOrder->getVariablePrice();

        $result = [
            'images' => [
                'front' => $machine->getImageFront(),
                'lateral' => $machine->getImageLateral(),
            ],
            'equipos' => [
                'title' => 'Equipos y Servicios',
                'Equipo' => [
                    'title' => 'Equipo incluido:',
                    'value' => $machine->getDescription(),
                ],
                'Servicios' => [
                    'title' => 'Servicios:',
                    'value' => Serials::SERVICES_TYPE,
                ],
            ],
            'volumen' => [
                'title' => 'Volumen de Impresión',
                'total' => [
                    'title' => 'Volumen de impresión mensual:',
                    'value' => $pages,
                ],
                'percent' => [
                    'title' => '% de páginas en color:',
                    'value' => $colorPercent,
                ],
            ],
            'duracion' => [
                'title' => 'Duración',
                'duracion' => [
                    'title' => 'Duración del Contrato:',
                    'value' => $duration . ' meses',
                ],
                'fecha' => [
                    'title' => 'Fecha de Inicio (aprox):',
                    'value' => $now->format('d-m-Y'),
                ],
            ],
            'cuota' => [
                'title' => 'Cuota/mes',
                'fijo' => [
                    'title' => 'Precio fijo (equipos/servicios):',
                    'value' => round($fixedPrice, 2),
                    'unit' => 'euros/mes',
                ],
                'variable' => [
                    'title' => 'Precio variable (consumibles):',
                    'value' => round($variablePrice, 2),
                    'unit' => 'euros/mes',
                ],
                'total' => [
                    'title' => 'Cuaota/mes:',
                    'value' => round($fixedPrice + $variablePrice, 2),
                    'unit' => 'euros/mes',
                ],
            ],
            'consumibles' => [
                'title' => 'Consumibles Incluidos',
                'pvp' => [
                    'unit' => 'euros/unidad',
                ],
                'amount' => [
                    'unit' => 'unidad/año',
                ],
            ]
        ];
        $tonerBlack = $machine->getTonerBlack();
        $result['consumibles']['toner'][] = [
            [
                'title' => TonerColors::BLACK,
                'name' => $tonerBlack->getCode(),
                'pvp' => $salesOrder->getPriceTonerBlack(),// $machine->getBlackPageCost() * $tonerBlack->getRecomendedVolume(),
                'amount' => $salesOrder->getAmountBlack(),//$tonerManager->calculateTonerYearAmount($pages, $tonerBlack->getRecomendedVolume()),
                'pages' => $salesOrder->getTonerBlackRecomendedVolume()
            ],
        ];
        if (!$machine->isColor()) {

            return $result;
        }
        foreach ($machine->getToners() as $toner) {
            if ($toner->getColorDescrition() !== TonerColors::BLACK) {
                $result['consumibles']['toner'][] = [
                    [
                        'title' => $toner->getColorDescrition(),
                        'name' => $toner->getCode(),
                        'pvp' => $salesOrder->getPriceTonerColor(),
                        'amount' => $salesOrder->getAmountColor(), //$tonerManager->calculateTonerYearAmount($pages, $toner->getRecomendedVolume()),
                        'pages' => $salesOrder->getTonerColorRecomendedVolume()
                    ],
                ];
            }

        }

        return $result;
    }
}
