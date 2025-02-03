<?php
namespace App\BLL;

use App\Entity\Categoria;
use App\Entity\Imagen;
use App\Entity\User;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Repository\ImagenRepository;
use BaseBLL;
use DateTime;
use Symfony\Bundle\SecurityBundle\Security;

class ImagenBLL extends BaseBLL
{
    public function getImagenesConOrdenacion(?string $ordenacion)
    {
        if (!is_null($ordenacion)) { // Cuando se establece un tipo de ordenación específico
            $tipoOrdenacion = 'asc'; // Por defecto si no se había guardado antes en la variable de sesión
            $session = $this->requestStack->getSession(); // Abrir la sesión
            $imagenesOrdenacion = $session->get('imagenesOrdenacion');
            if (!is_null($imagenesOrdenacion)) { // Comprobamos si ya se había establecido un orden
                if ($imagenesOrdenacion['ordenacion'] === $ordenacion) // Por si se ha cambiado de campo a ordenar
                {
                    if ($imagenesOrdenacion['tipoOrdenacion'] === 'asc')
                        $tipoOrdenacion = 'desc';
                }
            }
            $session->set('imagenesOrdenacion', [ // Se guarda la ordenación actual
                'ordenacion' => $ordenacion,
                'tipoOrdenacion' => $tipoOrdenacion
            ]);
        } else { // La primera vez que se entra se establece por defecto la ordenación por id ascendente
            $ordenacion = 'id';
            $tipoOrdenacion = 'asc';
        }
        $usuarioLogueado = $this->security->getUser();
        return $this->imagenRepository->findImagenesConCategoria($ordenacion, $tipoOrdenacion, $usuarioLogueado);
    }

    public function nueva(array $data)
    {
        $imagen = new Imagen();
        $imagen->setNombre($data['nombre']);
        $imagen->setDescripcion($data['descripcion']);
        $imagen->setNumVisualizaciones($data['numVisualizaciones']);
        $imagen->setNumLikes($data['numLikes']);
        $imagen->setNumDownloads($data['numDownloads']);
        // El id de la categoria, la tenemos que busar en su BBDD
        $categoria = $this->em->getRepository(Categoria::class)->find($data['categoria']);
        $imagen->setCategoria($categoria);
        $fecha = DateTime::createFromFormat('d/m/Y', $data['fecha']);
        $imagen->setFecha($fecha);
        $usuario = $this->em->getRepository(User::class)->find($data['usuario']);
        $imagen->setUsuario($usuario);
        return $this->guardaValidando($imagen);
    }

    public function setRequestStack(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }
    public function setSecurity(Security $security)
    {
        $this->security = $security;
    }

    public function toArray(Imagen $imagen)
    {
        if (is_null($imagen))
            return null;
        return [
            'id' => $imagen->getId(),
            'nombre' => $imagen->getNombre(),
            'descripcion' => $imagen->getDescripcion(),
            'categoria' => $imagen->getCategoria()->getNombre(),
            'numLikes' => $imagen->getNumLikes(),
            'numVisualizaciones' => $imagen->getNumVisualizaciones(),
            'numDownloads' => $imagen->getNumDownloads(),
            'fecha' => is_null($imagen->getFecha()) ? '' : $imagen->getFecha()->format('d/m/Y'),
            'usuario' => $imagen->getUsuario()->getId()
        ];
    }

    public function getImagenes(
        ?string $order,
        ?string $descripcion,
        ?string $fechaInicial,
        ?string $fechaFinal
    ) {
        $imagenes = $this->em->getRepository(Imagen::class)->findImagenes(
            $order,
            $descripcion,
            $fechaInicial,
            $fechaFinal,
            $usuario = null
        );
        return $this->entitiesToArray($imagenes);
    }
}