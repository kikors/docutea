<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HomeController
 * @package AppBundle\Controller
 */
class HomeController extends Controller
{

    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function homeAction()
    {
        return $this->render('statics/home.html.twig');
    }

    /**
     * @Route("/invoice", name="invoice")
     * @return Response
     */
    public function invoiceAction()
    {
        return $this->render(':documents:invoice.html.twig');
    }
}
