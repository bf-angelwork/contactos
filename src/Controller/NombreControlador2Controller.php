<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NombreControlador2Controller extends AbstractController
{
    #[Route('/nombre/controlador2', name: 'nombre_controlador2')]
    public function index(): Response
    {
        return $this->render('nombre_controlador2/index.html.twig', [
            'controller_name' => 'NombreControlador2Controller',
        ]);
    }
}
