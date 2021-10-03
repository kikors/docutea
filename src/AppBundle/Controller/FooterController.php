<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class FooterController
 * @package AppBundle\Controller
 *
 * @Route("footer")
 */
class FooterController extends Controller
{
    /**
     * @Route("/{name}", name="static_pages")
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function simpleStaticAction($name)
    {
        $content = $this->getDoctrine()->getRepository('AppBundle:StaticPages')->findOrEmpty($name);

        return $this->render('statics/simple_static.html.twig', [
            'title' => $content->getTitle(),
            'content' => $content->getContent(),
        ]);
    }

    /**
     * @Route("/contacto", name="contacto")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contactoAction()
    {
        return $this->render('statics/contacto.html.twig');
    }

    /**
     * @Route("/mapa_site", name="mapa_site")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mapaSiteAction()
    {
        $content = $this->getDoctrine()->getRepository('AppBundle:StaticPages')->findOneBy(['name'=> 'mapa']);

        return $this->render('statics/mapa_site.html.twig', [
            'title' => $content->getTitle(),
            'content' => $content->getContent(),
        ]);
    }
}
