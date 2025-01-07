<?php

namespace App\Controller;

use App\Entity\Asociado;
use App\Entity\Imagen;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProyectoController extends AbstractController
{
    #[Route('/', name: 'sym_index')]
    public function index()
    {
        $imagenesHome = [];
        for ($i = 1; $i <= 12; $i++) {
            $imagen = new Imagen();
            $imagen->setNombre("$i.jpg")
                ->setDescripcion("descripción imagen $i")
                ->setCategoria(1)
                ->setNumVisualizaciones(rand(1, 500))
                ->setNumLikes(rand(1, 700))
                ->setNumDownloads(rand(100, 200));
            
            $imagenesHome[] = $imagen;
        }

        $asociados = [
            new Asociado("Asociado 1", "log1.jpg", "Descripción del asociado 1"),
            new Asociado("Asociado 2", "log2.jpg", "Descripción del asociado 2"),
            new Asociado("Asociado 3", "log3.jpg", "Descripción del asociado 3")
        ];

        return $this->render('index.html.twig', [
            'imagenes' => $imagenesHome,
            'asociados' => $asociados
        ]);
    }

    #[Route('/galeria', name: 'sym_galeria')]
    public function galeria()
    {
        $imagenesHome = [];
        for ($i = 1; $i <= 12; $i++) {
            $imagen = new Imagen();
            $imagen->setNombre("$i.jpg")
                ->setDescripcion("descripción imagen $i")
                ->setCategoria(1)
                ->setNumVisualizaciones(rand(1, 500))
                ->setNumLikes(rand(1, 700))
                ->setNumDownloads(rand(100, 200));
            
            $imagenesHome[] = $imagen;
        }

        return $this->render('galeria.html.twig', [
            'imagenes' => $imagenesHome
        ]);
    }

    #[Route('/about', name: 'sym_about')]
    public function about()
    {
        $imagenesClientes = [];
        
        $cliente1 = new Imagen();
        $cliente1->setNombre('client1.jpg')->setDescripcion('MISS BELLA');
        $imagenesClientes[] = $cliente1;

        $cliente2 = new Imagen();
        $cliente2->setNombre('client2.jpg')->setDescripcion('DON PENO');
        $imagenesClientes[] = $cliente2;

        $cliente3 = new Imagen();
        $cliente3->setNombre('client3.jpg')->setDescripcion('SWEETY');
        $imagenesClientes[] = $cliente3;

        $cliente4 = new Imagen();
        $cliente4->setNombre('client4.jpg')->setDescripcion('LADY');
        $imagenesClientes[] = $cliente4;

        return $this->render('about.html.twig', [
            'imagenesClientes' => $imagenesClientes,
        ]);
    }

    #[Route('/contact', name: 'sym_contact')]
    public function contact()
    {
        return $this->render('contact.html.twig');
    }

    #[Route('/blog', name: 'sym_blog')]
    public function blog()
    {
        return $this->render('blog.html.twig');
    }

    #[Route('/imagen/{id}', name: 'sym_imagen_show')]
    public function show(Imagen $imagen)
    {
        return $this->render('imagen/show.html.twig', [
            'imagen' => $imagen
        ]);
    }

}
