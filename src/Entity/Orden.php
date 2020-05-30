<?php

namespace App\Entity;

use App\Repository\OrdenRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrdenRepository::class)
 */
class Orden
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="json")
     */
    private $productos = [];

    /**
     * @ORM\Column(type="integer")
     */
    private $totalOrden;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $estado;

    /**
     * @ORM\ManyToOne(targetEntity=Empleado::class, inversedBy="ordenes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idEmpleado;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductos(): ?array
    {
        return $this->productos;
    }

    public function setProductos(array $productos): self
    {
        $this->productos = $productos;

        return $this;
    }

    public function getTotalOrden(): ?int
    {
        return $this->totalOrden;
    }

    public function setTotalOrden(int $totalOrden): self
    {
        $this->totalOrden = $totalOrden;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

}
