<?php

namespace Lilworks\MessageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LilworksMessageBundle:Default:index.html.twig');
    }
}
