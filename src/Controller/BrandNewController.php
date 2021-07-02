<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class BrandNewController extends Controller
{
    /**
     * @Route("/brand/new", name="brand_new")
     */
    public function index()
    {
        return $this->render('brand_new/index.html.twig', [
            'controller_name' => 'BrandNewController',
        ]);
    }
}
