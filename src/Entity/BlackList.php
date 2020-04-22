<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlackListRepository")
 */
class BlackList
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $dni;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ListaControl", inversedBy="blackLists")
     * @ORM\JoinColumn(nullable=false)
     */
    private $listaControl;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Controlado", inversedBy="blackList")
     */
    private $controlado;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDni(): ?int
    {
        return $this->dni;
    }

    public function setDni(int $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getListaControl(): ?ListaControl
    {
        return $this->listaControl;
    }

    public function setListaControl(?ListaControl $listaControl): self
    {
        $this->listaControl = $listaControl;

        return $this;
    }

    public function getControlado(): ?Controlado
    {
        return $this->controlado;
    }

    public function setControlado(?Controlado $controlado): self
    {
        $this->controlado = $controlado;

        return $this;
    }
}
