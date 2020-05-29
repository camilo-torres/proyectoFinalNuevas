<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductoRepository::class)
 */
class Producto
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nombreProducto;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $descripcionProducto;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $urlImagen;

    /**
     * @ORM\Column(type="integer")
     */
    private $puntosProducto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreProducto(): ?string
    {
        return $this->nombreProducto;
    }

    public function setNombreProducto(string $nombreProducto): self
    {
        $this->nombreProducto = $nombreProducto;

        return $this;
    }

    public function getDescripcionProducto(): ?string
    {
        return $this->descripcionProducto;
    }

    public function setDescripcionProducto(string $descripcionProducto): self
    {
        $this->descripcionProducto = $descripcionProducto;

        return $this;
    }

    public function getUrlImagen(): ?string
    {
        return $this->urlImagen;
    }

    public function setUrlImagen(string $urlImagen): self
    {
        $this->urlImagen = $urlImagen;

        return $this;
    }

    public function getPuntosProducto(): ?int
    {
        return $this->puntosProducto;
    }

    public function setPuntosProducto(int $puntosProducto): self
    {
        $this->puntosProducto = $puntosProducto;

        return $this;
    }
}
