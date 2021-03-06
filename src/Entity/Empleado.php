<?php

namespace App\Entity;

use App\Repository\EmpleadoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmpleadoRepository::class)
 */
class Empleado
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
    private $nombre;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $apellido;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha_nacimiento;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $rol;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $usuario;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $contrasena;

    /**
     * @ORM\Column(type="integer")
     */
    private $idJefe;

    /**
     * @ORM\OneToMany(targetEntity=Orden::class, mappedBy="idEmpleado")
     */
    private $ordenes;

    public function __construct()
    {
        $this->ordenes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fecha_nacimiento;
    }

    public function setFechaNacimiento(\DateTimeInterface $fecha_nacimiento): self
    {
        $this->fecha_nacimiento = $fecha_nacimiento;

        return $this;
    }

    public function getRol(): ?string
    {
        return $this->rol;
    }

    public function setRol(string $rol): self
    {
        $this->rol = $rol;

        return $this;
    }

    public function getUsuario(): ?string
    {
        return $this->usuario;
    }

    public function setUsuario(string $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getContrasena(): ?string
    {
        return $this->contrasena;
    }

    public function setContrasena(string $contrasena): self
    {
        $this->contrasena = $contrasena;

        return $this;
    }

    public function getIdJefe(): ?int
    {
        return $this->idJefe;
    }

    public function setIdJefe(int $idJefe): self
    {
        $this->idJefe = $idJefe;

        return $this;
    }

    /**
     * @return Collection|Orden[]
     */
    public function getOrdenes(): Collection
    {
        return $this->ordenes;
    }

    public function addOrdene(Orden $ordene): self
    {
        if (!$this->ordenes->contains($ordene)) {
            $this->ordenes[] = $ordene;
            $ordene->setIdEmpleado($this);
        }

        return $this;
    }

    public function removeOrdene(Orden $ordene): self
    {
        if ($this->ordenes->contains($ordene)) {
            $this->ordenes->removeElement($ordene);
            // set the owning side to null (unless already changed)
            if ($ordene->getIdEmpleado() === $this) {
                $ordene->setIdEmpleado(null);
            }
        }

        return $this;
    }

}
