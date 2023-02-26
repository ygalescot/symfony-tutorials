<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="index")
 */
class DefaultController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('base.html.twig');
    }
}
