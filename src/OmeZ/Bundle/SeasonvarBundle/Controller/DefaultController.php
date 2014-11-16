<?php

namespace OmeZ\Bundle\SeasonvarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('OmeZSeasonvarBundle:Default:index.html.twig', array('name' => $name));
    }
}
