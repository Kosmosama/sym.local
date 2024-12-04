<?php

namespace App\Controller;

use App\Entity\Imagen;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProyectoController extends AbstractController
{
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

    public function index1()
    {
        return $this->render('prueba1.html.twig');
    }

    public function index2()
    {
        $nombre = 'Juan';
        $saludo = 'Buenos días a todos';
        $nombres = ['Ana', 'Enrique', 'Laura', 'Pablo'];
        return $this->render('prueba2.html.twig', [
            'nombre' => $nombre,
            'saludo' => $saludo,
            'nombres' => $nombres,
            'fecha' => new \DateTime()
        ]);
    }

}
