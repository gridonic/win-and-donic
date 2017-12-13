<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class MainController extends Controller
{
    /**
     * @Route("")
     */
    public function index()
    {
        return $this->render('main/index.html.twig');
    }
}
