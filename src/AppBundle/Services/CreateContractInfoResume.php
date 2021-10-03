<?php
/**
 * Created by PhpStorm.
 * User: Javi
 * Date: 26/02/2018
 * Time: 21:48
 */

namespace AppBundle\Services;


use AppBundle\Entity\Manager\MachineManager;
use AppBundle\Entity\Manager\SalesOrderManager;
use AppBundle\Entity\Manager\TonerManager;
use AppBundle\StaticsClass\Serials;
use AppBundle\StaticsClass\TonerColors;
use Doctrine\ORM\EntityManager;

class CreateContractInfoResume {

    private $machineRepository;

    private $profitDurationRepository;

    private $salesOrderManager;

    private $machineManager;

    private $tonerManager;

    /**
     * createContractInfoResume constructor.
     *
     * @param EntityManager $em
     * @param SalesOrderManager $salesOrderManager
     * @param MachineManager $machineManager
     * @param TonerManager $tonerManager
     */
    public function __construct(EntityManager $em,
                                SalesOrderManager $salesOrderManager,
                                MachineManager $machineManager,
                                TonerManager $tonerManager
    ) {

        $this->machineRepository = $em->getRepository('AppBundle:Machine');
        $this->profitDurationRepository = $em->getRepository('AppBundle:CarePackProfit');
        $this->salesOrderManager = $salesOrderManager;
        $this->machineManager = $machineManager;
        $this->tonerManager = $tonerManager;
    }

    /**
     * @param $idMachine
     * @param $colorPercent
     * @param $pages
     * @param $duration
     *
     * @return array
     * @throws \Exception
     */
    public function contractInfoToArray($idMachine, $colorPercent, $pages, $duration) {

        $machine = $this->machineRepository->findOrFail($idMachine);
        $now = new \DateTime();

        $fixedPrice = $this->machineManager->claculateFixedPrice(
            $machine,
            $this->profitDurationRepository->getProfitByDuration($duration)
        );
        $variablePrice = $this->salesOrderManager->calculateVariablePrice(
            $machine,
            $pages,
            $colorPercent
        );
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
            ],
        ];
        $tonerBlack = $machine->getTonerBlack();
        $result['consumibles']['toner'][] = [
            [
                'title' => TonerColors::BLACK,
                'name' => $tonerBlack->getCode(),
                'pvp' => $machine->getBlackPageCost() * $tonerBlack->getRecomendedVolume(),
                'amount' => $this->tonerManager->calculateTonerYearAmount($pages, $tonerBlack->getRecomendedVolume()),
                'pages' => $tonerBlack->getRecomendedVolume(),
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
                        'pvp' => $toner->getPrice(),
                        'amount' => $this->tonerManager->calculateTonerYearAmount($pages, $toner->getRecomendedVolume()),
                        'pages' => $toner->getRecomendedVolume(),
                    ],
                ];
            }

        }

        return $result;
    }
}