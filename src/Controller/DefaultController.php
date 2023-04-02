<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="index")
 */
class DefaultController extends AbstractController
{
    public function __invoke(): Response
    {
        $client = HttpClient::create();

        $response = $client->request(
            'GET',
            'https://fakestoreapi.com/products?limit=3'
        );

        $products = $response->toArray();

        return $this->render('homepage.html.twig', [
            'products' => $products,
        ]);
    }
}
