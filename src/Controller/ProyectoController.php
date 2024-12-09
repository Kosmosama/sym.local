<?php

namespace App\Controller;

use App\Entity\Imagen;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProyectoController extends AbstractController
{

    #[Route('/', name: 'sym_index')]
    public function index()
    {
        for ($i = 1; $i <= 12; $i++) {
            $imagenesHome[] = new Imagen(
                "$i.jpg",
                "descripción imagen $i",
                1,
                rand(1, 500),
                rand(1, 700),
                rand(100, 200)
            );
        }

        return $this->render('imagenes.html.twig', [
            'imagenes' => $imagenesHome
        ]);
    }

    #[Route('/about', name: 'sym_about')]
    public function about() {
        return $this->render('prueba1.html.twig');
    }

}
