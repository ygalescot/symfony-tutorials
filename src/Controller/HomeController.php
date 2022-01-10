<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("", name="homepage")
     */
    public function index()
    {
        return $this->render('homepage.html.twig');
    }

    /**
     * @Route("/form", name="form_page")
     */
    public function formPage()
    {
        return $this->render('form_example_page.html.twig');
    }

    /**
     * @Route("/cms-content", name="cms_content_page")
     */
    public function cmsContent()
    {
        return $this->render('cms_content_example_page.html.twig');
    }
}