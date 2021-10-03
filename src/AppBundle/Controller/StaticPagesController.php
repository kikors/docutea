<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class StaticPagesController
 * @package AppBundle\Controller
 * @Route("site", name="static_pages")
 */
class StaticPagesController extends Controller
{
    /**
     * @Route("/{nombrePagina}/", name="static_pages")
     * @param $nombrePagina
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function paginaAction($nombrePagina)
    {
        return $this->render('statics/'.$nombrePagina.'.html.twig');
    }
}
