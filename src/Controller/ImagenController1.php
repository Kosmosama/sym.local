<?php

namespace App\Controller;

use App\Entity\Imagen;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;

class ImagenController1 extends AbstractController
{
    #[Route('/imagen', name: 'sym_imagen')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $imagenes = $doctrine->getRepository(Imagen::class)->findAll();
        return $this->render('imagen/index.html.twig', [
            'imagens' => $imagenes
        ]);
    }
}
